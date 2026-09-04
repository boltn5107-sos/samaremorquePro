<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Service;
use App\Models\Vehicle;
use App\Services\GeolocationService;
use App\Services\InterventionMatchingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientInterventionController extends Controller
{
    public function __construct(
        protected GeolocationService $geo,
        protected InterventionMatchingService $matcher
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

        $distanceSql = "(
            6371 * acos(
                cos(radians({$lat})) *
                cos(radians(locations.lat)) *
                cos(radians(locations.lng) - radians({$lng})) +
                sin(radians({$lat})) *
                sin(radians(locations.lat))
            )
        )";

        $query = DB::table('locations')
            ->join('users', 'users.id', '=', 'locations.user_id')
            ->whereIn('users.role', ['remorqueur', 'depanneur'])
            ->where('users.is_validated', true)
            ->where('users.is_active', true)
            ->where('locations.recorded_at', '>=', now()->subMinutes($freshnessMinutes))
            ->whereRaw($distanceSql . ' <= ' . $radiusKm);

        if ($serviceType) {
            $slug = strtolower($serviceType);
            $role = $slug === 'depannage' ? 'depanneur' : ($slug === 'remorquage' ? 'remorqueur' : null);

            if ($role) {
                $query->where('users.role', $role);
            }
        }

        $rows = $query
            ->join('remorqueurs', 'remorqueurs.user_id', '=', 'users.id', 'left')
            ->leftJoin('depanneurs', 'depanneurs.user_id', '=', 'users.id')
            ->whereRaw('COALESCE(remorqueurs.is_available, depanneurs.is_available) = 1')
            ->select([
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.role',
                'users.phone',
                'users.photo',
                'users.bio',
                'users.zone_intervention',
                'locations.lat',
                'locations.lng',
                'locations.recorded_at',
                'locations.address as location_address',
                'remorqueurs.hourly_rate as remorqueur_rate',
                'depanneurs.hourly_rate as depanneur_rate',
                DB::raw($distanceSql . ' as distance_km'),
            ])
            ->orderBy('distance_km', 'asc')
            ->orderByDesc('locations.recorded_at')
            ->limit(20)
            ->get();

        $professionals = $rows
            ->unique('id')
            ->values()
            ->map(function ($row) {
            $rate = $row->remorqueur_rate ?? $row->depanneur_rate;
            $suggestedDestination = $row->location_address
                ?: ($row->zone_intervention ?: null);

            return [
                'id' => (int) $row->id,
                'full_name' => trim("{$row->first_name} {$row->last_name}"),
                'role' => $row->role,
                'phone' => $row->phone,
                'photo' => $row->photo ? asset('storage/' . $row->photo) : null,
                'bio' => $row->bio,
                'zone' => $row->zone_intervention,
                'hourly_rate' => $rate ? (float) $rate : null,
                'lat' => (float) $row->lat,
                'lng' => (float) $row->lng,
                'recorded_at' => $row->recorded_at,
                'position_age_minutes' => round(max(0, now()->diffInMinutes($row->recorded_at)), 1),
                'distance_km' => round((float) $row->distance_km, 2),
                'suggested_destination' => $suggestedDestination,
            ];
        });

        $ratings = Intervention::ratingsForProfessionals($professionals->pluck('id')->all());
        $professionals = $professionals->map(function ($p) use ($ratings) {
            $p['rating_avg'] = $ratings[$p['id']]['average'] ?? null;
            $p['rating_count'] = $ratings[$p['id']]['count'] ?? 0;

            return $p;
        });

        $suggestedDestinations = $this->findNearbyDestinations($lat, $lng, $radiusKm);

        return response()->json([
            'professionals' => $professionals,
            'suggested_destinations' => $suggestedDestinations,
        ]);
    }

    protected function findNearbyDestinations(float $lat, float $lng, float $radiusKm): array
    {
        $distanceSql = "(
            6371 * acos(
                cos(radians({$lat})) *
                cos(radians(locations.lat)) *
                cos(radians(locations.lng) - radians({$lng})) +
                sin(radians({$lat})) *
                sin(radians(locations.lat))
            )
        )";

        $destinations = DB::table('locations')
            ->join('users', 'users.id', '=', 'locations.user_id')
            ->where('users.role', 'depanneur')
            ->where('users.is_validated', true)
            ->where('users.is_active', true)
            ->whereRaw($distanceSql . ' <= ' . $radiusKm)
            ->whereRaw($distanceSql . ' > 0')
            ->select([
                'locations.address',
                'locations.lat',
                'locations.lng',
                DB::raw($distanceSql . ' as distance_km'),
            ])
            ->orderBy('distance_km', 'asc')
            ->limit(5)
            ->get()
            ->filter(fn ($d) => ! empty($d->address))
            ->map(fn ($d) => [
                'address' => $d->address,
                'distance_km' => round((float) $d->distance_km, 1),
            ])
            ->values()
            ->toArray();

        return $destinations;
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
