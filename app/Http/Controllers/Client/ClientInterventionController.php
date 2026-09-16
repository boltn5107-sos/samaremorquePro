<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Service;
use App\Models\Vehicle;
use App\Services\GeolocationService;
use App\Services\InterventionMatchingService;
use App\Services\NearbyProfessionalsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientInterventionController extends Controller
{
    public function __construct(
        protected GeolocationService $geo,
        protected InterventionMatchingService $matcher,
        protected NearbyProfessionalsService $nearby
    ) {}

    public function index()
    {
        $interventions = Intervention::with('professional')
            ->where('client_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('client.interventions', compact('interventions'));
    }

    public function create()
    {
        $vehicles = Auth::user()->vehicles()->get();
        $services = Service::where('is_active', true)->get();

        return view('client.intervention-create', compact('vehicles', 'services'));
    }

    public function nearbyProfessionals(Request $request)
    {
        $request->validate([
            'service_type' => ['nullable', 'string', 'max:100'],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'radius' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        $lat = (float) $request->lat;
        $lng = (float) $request->lng;
        $radiusKm = (float) ($request->radius ?? 50);
        $freshnessMinutes = (int) ($request->freshness ?? 720);
        $serviceType = $request->service_type;

        return response()->json($this->nearby->search(
            $lat,
            $lng,
            $radiusKm,
            $freshnessMinutes,
            $serviceType
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => ['required', 'string', 'max:100'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'service_type' => ['required', 'string', 'max:100'],
            'destination' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'client_name' => ['nullable', 'string', 'max:100'],
            'client_phone' => ['nullable', 'string', 'max:30'],
            'client_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'client_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'client_address' => ['nullable', 'string', 'max:500'],
            'destination_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'destination_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'manual_position' => ['nullable', 'string', 'max:500'],
            'selected_professional_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        if (! $request->filled('client_lat') || ! $request->filled('client_lng')) {
            if ($request->filled('client_address')) {
                $position = $this->geo->geocode($request->client_address);
                $validated['client_lat'] = $position['lat'] ?? null;
                $validated['client_lng'] = $position['lng'] ?? null;
            }
        }

        $intervention = Intervention::create([
            'client_id' => Auth::id(),
            'client_name' => $validated['client_name'] ?? null,
            'client_phone' => $validated['client_phone'] ?? null,
            'target_professional_id' => $validated['selected_professional_id'] ?? null,
            'vehicle_id' => $validated['vehicle_id'] ?? null,
            'service_type' => $validated['service_type'],
            'description' => $validated['description'] ?? null,
            'photo' => $this->storePhoto($request),
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'client_lat' => $validated['client_lat'] ?? null,
            'client_lng' => $validated['client_lng'] ?? null,
            'client_address' => $validated['client_address'] ?? null,
            'destination' => $validated['destination'],
            'destination_lat' => $validated['destination_lat'] ?? null,
            'destination_lng' => $validated['destination_lng'] ?? null,
            'client_manual_position' => $validated['manual_position'] ?? null,
        ]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'user_id' => Auth::id(),
        ]);

        $this->matcher->findAndNotify($intervention, $validated['selected_professional_id'] ?? null);

        if ($intervention->client_lat !== null && $intervention->client_lng !== null) {
            Auth::user()->locations()->create([
                'lat' => $intervention->client_lat,
                'lng' => $intervention->client_lng,
                'address' => $validated['client_address'] ?? null,
                'recorded_at' => now(),
            ]);
        }

        return redirect()
            ->route('client.intervention.show', $intervention)
            ->with('status', 'intervention-created');
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        Auth::user()->locations()->create([
            'lat' => $validated['lat'],
            'lng' => $validated['lng'],
            'address' => $validated['address'] ?? null,
            'recorded_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function professionalPosition(Intervention $intervention)
    {
        abort_if($intervention->client_id !== Auth::id(), 403);

        if (! $intervention->professional_id ||
            in_array($intervention->status, ['intervention_terminee', 'annulee'])) {
            return response()->json(null, 204);
        }

        $latest = $intervention->professional
            ->locations()
            ->latest('id')
            ->first();

        if (! $latest) {
            return response()->json(null, 204);
        }

        return response()->json([
            'id' => $latest->id,
            'lat' => (float) $latest->lat,
            'lng' => (float) $latest->lng,
            'recorded_at' => $latest->recorded_at,
        ]);
    }

    public function show(Intervention $intervention)
    {
        abort_if($intervention->client_id !== Auth::id(), 403);

        $intervention->load('professional', 'professional.locations', 'statuses', 'vehicle');

        return view('client.intervention-detail', compact('intervention'));
    }

    public function cancel(Intervention $intervention)
    {
        abort_if($intervention->client_id !== Auth::id(), 403);

        if (in_array($intervention->status, ['intervention_terminee', 'annulee'])) {
            return back();
        }

        $intervention->status = 'annulee';
        $intervention->save();

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => 'annulee',
            'user_id' => Auth::id(),
            'note' => 'Annulee par le client',
        ]);

        if ($intervention->professional_id) {
            $professional = $intervention->professional;
            if ($professional?->isRemorqueur()) {
                $professional->remorqueurProfile()->update(['is_available' => true]);
            } elseif ($professional?->isDepanneur()) {
                $professional->depanneurProfile()->update(['is_available' => true]);
            }
        }

        return redirect()->route('client.intervention.index')->with('status', 'intervention-cancelled');
    }

    public function rate(Request $request, Intervention $intervention)
    {
        abort_if($intervention->client_id !== Auth::id(), 403);

        if ($intervention->status !== Intervention::STATUS_COMPLETED) {
            abort(422, "L'intervention doit etre terminee pour pouvoir etre notee.");
        }

        if (! $intervention->professional_id) {
            abort(422, 'Aucun professionnel ne peut etre note.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'rating_comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $intervention->update([
            'rating' => (int) $validated['rating'],
            'rating_comment' => $validated['rating_comment'] ?? null,
            'rated_at' => now(),
        ]);

        return back()->with('status', 'intervention-rated');
    }

    protected function storePhoto(Request $request): ?string
    {
        if (! $request->hasFile('photo')) {
            return null;
        }

        return $request->file('photo')->store('interventions', 'public');
    }
}
