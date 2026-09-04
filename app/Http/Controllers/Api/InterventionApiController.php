<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Location;
use App\Models\Notification;
use App\Models\ProfessionalRejection;
use App\Services\InterventionMatchingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionApiController extends Controller
{
    public function __construct(protected InterventionMatchingService $matcher) {}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => ['required', 'string', 'max:100'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'service_type' => ['required', 'string', 'max:100'],
            'destination' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'client_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'client_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'client_address' => ['nullable', 'string', 'max:500'],
            'destination_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'destination_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'selected_professional_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $intervention = Intervention::create([
            'client_id' => Auth::id(),
            'target_professional_id' => $validated['selected_professional_id'] ?? null,
            'vehicle_id' => $validated['vehicle_id'] ?? null,
            'service_type' => $validated['service_type'],
            'description' => $validated['description'] ?? null,
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'client_lat' => $validated['client_lat'] ?? null,
            'client_lng' => $validated['client_lng'] ?? null,
            'client_address' => $validated['client_address'] ?? null,
            'destination' => $validated['destination'],
            'destination_lat' => $validated['destination_lat'] ?? null,
            'destination_lng' => $validated['destination_lng'] ?? null,
        ]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'user_id' => Auth::id(),
        ]);

        $this->matcher->findAndNotify($intervention, $validated['selected_professional_id'] ?? null);

        return response()->json($intervention->load('statuses'), 201);
    }

    public function show(Intervention $intervention)
    {
        abort_if($intervention->client_id !== Auth::id() && $intervention->professional_id !== Auth::id(), 403);

        return response()->json($intervention->load('statuses', 'client', 'professional'));
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Intervention::query();

        if ($user->isClient()) {
            $query->where('client_id', $user->id);
        } elseif ($user->isRemorqueur() || $user->isDepanneur()) {
            $query->where('professional_id', $user->id);
        }

        return response()->json($query->with('client')->orderByDesc('created_at')->paginate(20));
    }

    public function incoming(Request $request)
    {
        $userId = $request->user()->id;

        $interventions = Intervention::with('client')
            ->where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->where('service_type', $request->user()->isDepanneur() ? 'depannage' : 'remorquage')
            ->where(function ($q) use ($userId) {
                $q->whereNull('target_professional_id')
                    ->orWhere('target_professional_id', $userId);
            })
            ->whereNotIn('id', ProfessionalRejection::where('professional_id', $userId)->pluck('intervention_id'))
            ->orderByDesc('created_at')
            ->get();

        return response()->json($interventions);
    }

    public function accept(Request $request, Intervention $intervention)
    {
        if ($intervention->status !== Intervention::STATUS_AWAITING_PROFESSIONAL) {
            return response()->json(['message' => 'Cette intervention a deja ete acceptee.'], 422);
        }

        $roleStatus = $request->user()->isDepanneur() ? 'depanneur_en_route' : 'remorqueur_en_route';

        $updated = Intervention::where('id', $intervention->id)
            ->where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->update([
                'professional_id' => Auth::id(),
                'status' => $roleStatus,
            ]);

        if (! $updated) {
            return response()->json(['message' => 'Cette intervention a deja ete acceptee.'], 409);
        }

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => $roleStatus,
            'user_id' => Auth::id(),
        ]);

        if ($request->user()->isRemorqueur()) {
            $request->user()->remorqueurProfile()->update(['is_available' => false]);
        } elseif ($request->user()->isDepanneur()) {
            $request->user()->depanneurProfile()->update(['is_available' => false]);
        }

        Notification::create([
            'user_id' => $intervention->client_id,
            'type' => 'intervention_update',
            'notifiable_type' => Intervention::class,
            'notifiable_id' => $intervention->id,
            'data' => [
                'title' => 'Intervention acceptee',
                'body' => 'Un professionnel est en route.',
                'url' => '/client/intervention/' . $intervention->id,
            ],
        ]);

        return response()->json($intervention->fresh('statuses'));
    }

    public function reject(Request $request, Intervention $intervention)
    {
        if ($intervention->status !== Intervention::STATUS_AWAITING_PROFESSIONAL) {
            return response()->json(['message' => 'Cette intervention a deja ete traitee.'], 422);
        }

        ProfessionalRejection::updateOrCreate(
            [
                'intervention_id' => $intervention->id,
                'professional_id' => $request->user()->id,
            ],
            ['reason' => $request->input('reason')]
        );

        Notification::create([
            'user_id' => $intervention->client_id,
            'type' => 'intervention_update',
            'notifiable_type' => Intervention::class,
            'notifiable_id' => $intervention->id,
            'data' => [
                'title' => 'Demande refusee',
                'body' => 'Votre demande a ete refusee par ' . $request->user()->full_name . '.',
                'url' => '/client/intervention/' . $intervention->id,
            ],
        ]);

        return response()->json(null, 204);
    }

    public function updateStatus(Request $request, Intervention $intervention)
    {
        if ($intervention->professional_id !== Auth::id()) {
            return response()->json(['message' => 'Non autorise.'], 403);
        }

        $validated = $request->validate([
            'status' => ['required', 'string'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $intervention->update(['status' => $validated['status']]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => $validated['status'],
            'note' => $validated['note'] ?? null,
            'user_id' => Auth::id(),
        ]);

        if ($validated['status'] === Intervention::STATUS_COMPLETED) {
            if ($request->user()->isRemorqueur()) {
                $request->user()->remorqueurProfile()->update(['is_available' => true]);
            } elseif ($request->user()->isDepanneur()) {
                $request->user()->depanneurProfile()->update(['is_available' => true]);
            }
        }

        return response()->json($intervention->load('statuses'));
    }

    public function toggleAvailability(Request $request)
    {
        $user = $request->user();

        if ($user->isRemorqueur()) {
            $user->remorqueurProfile()->update(['is_available' => !$user->remorqueurProfile->is_available]);
        } elseif ($user->isDepanneur()) {
            $user->depanneurProfile()->update(['is_available' => !$user->depanneurProfile->is_available]);
        }

        return response()->json(['status' => 'ok']);
    }
}
