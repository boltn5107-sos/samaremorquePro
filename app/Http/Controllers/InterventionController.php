<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Vehicle;
use App\Models\InterventionStatus;
use App\Services\GeolocationService;
use App\Services\InterventionMatchingService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InterventionController extends Controller
{
    public function __construct(
        protected GeolocationService $geo,
        protected InterventionMatchingService $matcher,
        protected NotificationService $notifications
    ) {}

    public function create(Request $request)
    {
        $vehicles = Auth::user()->vehicles()->get();
        $services = \App\Models\Service::where('is_active', true)->get();

        return view('client.intervention-create', compact('vehicles', 'services'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!$request->filled('client_lat') && !$request->filled('client_lng') && !$request->filled('manual_position')) {
                $validator->errors()->add('position', 'La position du client est requise.');
            }
        });

        $validated = $validator->validate();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('interventions', 'public');
        }

        $intervention = Intervention::create([
            'client_id' => Auth::id(),
            'vehicle_id' => $validated['vehicle_id'] ?? null,
            'service_type' => $validated['service_type'],
            'description' => $validated['description'] ?? null,
            'photo' => $validated['photo'] ?? null,
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

        $this->matcher->findAndNotify($intervention);

        return redirect()->route('client.intervention.show', $intervention)->with('status', 'intervention-created');
    }

    public function show(Request $request, Intervention $intervention)
    {
        $user = Auth::user();

        abort_if(
            $user->id !== $intervention->client_id &&
            $user->id !== $intervention->professional_id &&
            $user->role !== 'admin',
            403
        );

        $intervention->load('statuses', 'professional', 'client', 'vehicle');

        return view('client.intervention-show', compact('intervention'));
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Intervention::query();

        if ($user->isClient()) {
            $query->where('client_id', $user->id);
        } elseif ($user->isRemorqueur() || $user->isDepanneur()) {
            $query->where('professional_id', $user->id)
                ->orWhere('status', Intervention::STATUS_AWAITING_PROFESSIONAL);
        }

        $interventions = $query->orderByDesc('created_at')->paginate(20);

        return view('interventions.index', compact('interventions'));
    }
}
