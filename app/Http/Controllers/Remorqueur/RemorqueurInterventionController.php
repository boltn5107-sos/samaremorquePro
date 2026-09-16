<?php

namespace App\Http\Controllers\Remorqueur;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Notification;
use App\Models\ProfessionalRejection;
use App\Services\GeolocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemorqueurInterventionController extends Controller
{
    public function __construct(protected GeolocationService $geo) {}

    public function incoming()
    {
        $rejectedIds = ProfessionalRejection::where('professional_id', Auth::id())
            ->pluck('intervention_id');

        $userId = Auth::id();

        $interventions = Intervention::with('client')
            ->where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->where('service_type', 'remorquage')
            ->where(function ($q) use ($userId) {
                $q->whereNull('target_professional_id')
                    ->orWhere('target_professional_id', $userId);
            })
            ->whereNotIn('id', $rejectedIds)
            ->orderByDesc('created_at')
            ->get();

        return view('remorqueur.demands', compact('interventions'));
    }

    public function index()
    {
        $interventions = Intervention::with('client')
            ->where('professional_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('remorqueur.interventions', compact('interventions'));
    }

    public function show(Intervention $intervention)
    {
        abort_if($intervention->professional_id !== Auth::id(), 403);

        $intervention->load('client', 'statuses', 'vehicle');

        return view('remorqueur.intervention-detail', compact('intervention'));
    }

    public function accept(Request $request, Intervention $intervention)
    {
        if ($intervention->status !== Intervention::STATUS_AWAITING_PROFESSIONAL) {
            return back()->with('error', 'Cette demande a deja ete traitee.');
        }

        $updated = Intervention::where('id', $intervention->id)
            ->where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->update([
                'professional_id' => Auth::id(),
                'status' => 'remorqueur_en_route',
            ]);

        if (! $updated) {
            return back()->with('error', 'Cette demande a deja ete acceptee par un autre professionnel.');
        }

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => 'remorqueur_en_route',
            'user_id' => Auth::id(),
        ]);

        Auth::user()->remorqueurProfile()->update(['is_available' => false]);

        $this->notifyClient($intervention, 'Votre remorqueur est en route.');

        return back()->with('status', 'intervention-accepted');
    }

    public function reject(Request $request, Intervention $intervention)
    {
        if ($intervention->status !== Intervention::STATUS_AWAITING_PROFESSIONAL) {
            return back()->with('error', 'Cette demande a deja ete traitee.');
        }

        ProfessionalRejection::updateOrCreate(
            [
                'intervention_id' => $intervention->id,
                'professional_id' => Auth::id(),
            ],
            ['reason' => $request->input('reason')]
        );

        $this->notifyClient(
            $intervention,
            'Votre demande de remorquage a ete refusee par ' . Auth::user()->full_name . '.'
        );

        return back()->with('status', 'intervention-rejected');
    }

    public function updateStatus(Request $request, Intervention $intervention)
    {
        abort_if($intervention->professional_id !== Auth::id(), 403);

        if (in_array($intervention->status, [Intervention::STATUS_COMPLETED, Intervention::STATUS_CANCELLED])) {
            return back()->with('error', "Cette intervention est deja terminee ou annulee. Aucun changement necessaire.");
        }

        $validated = $request->validate([
            'status' => ['required', 'in:remorqueur_en_route,arrivee_sur_place,vehicule_pris_en_charge,intervention_terminee'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $intervention->canTransitionTo($validated['status'])) {
            return back()->with('error', 'Impossible de passer a ce statut (statut actuel : ' . $intervention->status_label . ').');
        }

        $intervention->update(['status' => $validated['status']]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => $validated['status'],
            'note' => $validated['note'] ?? null,
            'user_id' => Auth::id(),
        ]);

        if ($validated['status'] === Intervention::STATUS_COMPLETED) {
            Auth::user()->remorqueurProfile()->update(['is_available' => true]);
        }

        $this->notifyClient($intervention, ucfirst(str_replace('_', ' ', $validated['status'])));

        return back()->with('status', 'status-updated');
    }

    protected function notifyClient(Intervention $intervention, string $body): void
    {
        if ($intervention->client_id === null) {
            return;
        }

        Notification::create([
            'user_id' => $intervention->client_id,
            'type' => 'intervention_update',
            'notifiable_type' => Intervention::class,
            'notifiable_id' => $intervention->id,
            'data' => [
                'title' => 'Intervention mise a jour',
                'body' => $body,
                'url' => '/client/intervention/' . $intervention->id,
            ],
        ]);
    }
}
