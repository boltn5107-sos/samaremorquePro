<?php

namespace App\Http\Controllers\Remorqueur;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Notification;
use App\Models\Remorque;
use App\Services\GeolocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemorqueurInterventionController extends Controller
{
    public function __construct(protected GeolocationService $geo) {}

    public function incoming()
    {
        $interventions = Intervention::with('client')
            ->where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->where('service_type', 'remorquage')
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
        abort_if($intervention->status !== Intervention::STATUS_AWAITING_PROFESSIONAL, 422);

        $updated = Intervention::where('id', $intervention->id)
            ->where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->update([
                'professional_id' => Auth::id(),
                'status' => 'remorqueur_en_route',
            ]);

        abort_if(! $updated, 409, 'Cette intervention a deja ete acceptee.');

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => 'remorqueur_en_route',
            'user_id' => Auth::id(),
        ]);

        $this->notifyClient($intervention, 'Votre remorqueur est en route.');

        return back()->with('status', 'intervention-accepted');
    }

    protected function notifyClient(Intervention $intervention, string $body): void
    {
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

    public function reject(Request $request, Intervention $intervention)
    {
        abort_if($intervention->status !== Intervention::STATUS_AWAITING_PROFESSIONAL, 422);

        return back()->with('status', 'intervention-rejected');
    }

    public function updateStatus(Request $request, Intervention $intervention)
    {
        abort_if($intervention->professional_id !== Auth::id(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:remorqueur_en_route,arrivee_sur_place,vehicule_pris_en_charge,intervention_terminee'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $intervention->update(['status' => $validated['status']]);

        InterventionStatus::create([
            'intervention_id' => $intervention->id,
            'status' => $validated['status'],
            'note' => $validated['note'] ?? null,
            'user_id' => Auth::id(),
        ]);

        $this->notifyClient($intervention, ucfirst(str_replace('_', ' ', $validated['status'])));

        return back()->with('status', 'status-updated');
    }
}
