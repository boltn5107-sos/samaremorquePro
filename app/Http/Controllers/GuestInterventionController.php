<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Notification;
use App\Models\Service;
use App\Services\CommissionService;
use App\Services\GeolocationService;
use App\Services\InterventionMatchingService;
use App\Services\NearbyProfessionalsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GuestInterventionController extends Controller
{
    public function __construct(
        protected GeolocationService $geo,
        protected InterventionMatchingService $matcher,
        protected NearbyProfessionalsService $nearby,
        protected CommissionService $commissions
    ) {}

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $vehicles = Auth::check() ? Auth::user()->vehicles()->get() : collect();

        return view('guest.create', compact('services', 'vehicles'));
    }

    public function nearbyProfessionals(Request $request)
    {
        $request->validate([
            'service_type' => ['nullable', 'string', 'max:100'],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'radius' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        try {
            $result = $this->nearby->search(
                (float) $request->lat,
                (float) $request->lng,
                (float) ($request->radius ?? 50),
                (int) ($request->freshness ?? 720),
                $request->service_type
            );
        } catch (\Throwable $e) {
            Log::error('Nearby professionals search failed', [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'radius' => $request->radius,
                'freshness' => $request->freshness,
                'service_type' => $request->service_type,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'professionals' => [],
                'suggested_destinations' => [],
                'error' => 'search_failed',
            ], 500);
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => ['required', 'string', 'max:100'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'service_type' => ['required', 'string', 'max:100'],
            'destination' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'client_name' => ['nullable', 'string', 'max:100'],
            'client_phone' => ['nullable', 'string', 'max:30'],
            'client_lat' => ['required', 'numeric', 'between:-90,90'],
            'client_lng' => ['required', 'numeric', 'between:-180,180'],
            'client_address' => ['nullable', 'string', 'max:500'],
            'manual_position' => ['nullable', 'string', 'max:500'],
            'selected_professional_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $clientId = Auth::id();

        $intervention = Intervention::create([
            'client_id' => $clientId,
            'tracking_code' => Intervention::generateTrackingCode(),
            'client_name' => $validated['client_name'] ?? null,
            'client_phone' => $validated['client_phone'] ?? null,
            'target_professional_id' => ($validated['selected_professional_id'] ?? null) ?: null,
            'vehicle_id' => ($validated['vehicle_id'] ?? null) ?: null,
            'vehicle_type' => $validated['vehicle_type'],
            'service_type' => $validated['service_type'],
            'description' => $validated['description'] ?? null,
            'photo' => $this->storePhoto($request),
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'client_lat' => $validated['client_lat'],
            'client_lng' => $validated['client_lng'],
            'client_address' => $validated['client_address'] ?? null,
            'destination' => $validated['destination'] ?? null,
            'client_manual_position' => $validated['manual_position'] ?? null,
        ]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'user_id' => $clientId,
        ]);

        $this->matcher->findAndNotify($intervention, ($validated['selected_professional_id'] ?? null) ?: null);

        if ($clientId && $intervention->client_lat !== null && $intervention->client_lng !== null) {
            Auth::user()->locations()->create([
                'lat' => $intervention->client_lat,
                'lng' => $intervention->client_lng,
                'address' => $validated['client_address'] ?? null,
                'recorded_at' => now(),
            ]);
        }

        return redirect()
            ->route('guest.track', $intervention->tracking_code)
            ->with('status', 'intervention-created');
    }

    public function track(string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        abort_if($intervention === null, 404, 'Demande introuvable.');

        return view('guest.track', compact('intervention'));
    }

    public function statusJson(string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        if (! $intervention) {
            return response()->json(['error' => 'not_found'], 404);
        }

        $professional = $intervention->professional;

        return response()->json([
            'status' => $intervention->status,
            'status_label' => $intervention->status_label,
            'has_rated' => $intervention->hasBeenRated(),
            'is_finished' => in_array($intervention->status, ['intervention_terminee', 'annulee']),
            'professional' => $professional ? [
                'id' => $professional->id,
                'full_name' => $professional->full_name,
                'role' => $professional->role,
                'phone' => $professional->phone,
                'photo' => $professional->photo ? asset('storage/'.$professional->photo) : null,
            ] : null,
        ]);
    }

    public function proPosition(string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        if (! $intervention || ! $intervention->professional_id) {
            return response()->json(null, 204);
        }

        if (in_array($intervention->status, ['intervention_terminee', 'annulee'])) {
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

    public function cancel(Request $request, string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        abort_if($intervention === null, 404);

        if (in_array($intervention->status, ['intervention_terminee', 'annulee'])) {
            return back();
        }

        $intervention->update(['status' => Intervention::STATUS_CANCELLED]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => Intervention::STATUS_CANCELLED,
            'user_id' => null,
            'note' => 'Annulee par le client (sans compte)',
        ]);

        if ($intervention->professional_id) {
            $professional = $intervention->professional;
            if ($professional?->isRemorqueur()) {
                $professional->remorqueurProfile()->update(['is_available' => true]);
            } elseif ($professional?->isDepanneur()) {
                $professional->depanneurProfile()->update(['is_available' => true]);
            }
        }

        return back()->with('status', 'intervention-cancelled');
    }

    public function confirmPrice(string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        abort_if($intervention === null, 404);

        if ($intervention->status !== Intervention::STATUS_COMPLETED || $intervention->price === null) {
            return back()->with('error', 'Aucun prix a confirmer.');
        }

        if ($intervention->priceConfirmed()) {
            return back()->with('error', 'Le prix a deja ete confirme.');
        }

        $intervention->update([
            'price_status' => Intervention::PRICE_STATUS_VALIDATED,
            'price_confirmed_at' => now(),
        ]);

        $payment = $this->commissions->charge($intervention);

        $this->notifyProfessional(
            $intervention,
            $payment
                ? 'Prix confirme par le client. Commission de '.number_format((float) $payment->amount, 0, ',', ' ').' FCFA due.'
                : 'Prix confirme par le client.'
        );

        return back()->with('status', 'price-confirmed');
    }

    public function contestPrice(string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        abort_if($intervention === null, 404);

        if ($intervention->status !== Intervention::STATUS_COMPLETED || $intervention->price === null) {
            return back()->with('error', 'Aucun prix a contester.');
        }

        if ($intervention->priceConfirmed()) {
            return back()->with('error', 'Le prix a deja ete confirme, il ne peut plus etre conteste.');
        }

        $intervention->update([
            'price_status' => Intervention::PRICE_STATUS_CONTESTED,
            'price_confirmed_at' => null,
        ]);

        $this->notifyProfessional(
            $intervention,
            'Le client conteste le prix de '.number_format((float) $intervention->price, 0, ',', ' ').' FCFA. Corrigez le prix.'
        );

        return back()->with('status', 'price-contested');
    }

    public function rate(Request $request, string $trackingCode)
    {
        $intervention = Intervention::findByTrackingCode($trackingCode);

        abort_if($intervention === null, 404);

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

    protected function notifyProfessional(Intervention $intervention, string $body): void
    {
        if (! $intervention->professional_id) {
            return;
        }

        Notification::create([
            'user_id' => $intervention->professional_id,
            'type' => 'intervention_update',
            'notifiable_type' => Intervention::class,
            'notifiable_id' => $intervention->id,
            'data' => [
                'title' => 'Prix de l\u2019intervention',
                'body' => $body,
                'url' => '/pro/dashboard',
            ],
        ]);
    }

    protected function storePhoto(Request $request): ?string
    {
        if (! $request->hasFile('photo')) {
            return null;
        }

        return $request->file('photo')->store('interventions', 'public');
    }
}
