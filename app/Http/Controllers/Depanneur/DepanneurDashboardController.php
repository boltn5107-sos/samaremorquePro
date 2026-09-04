<?php

namespace App\Http\Controllers\Depanneur;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepanneurDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activeIntervention = Intervention::where('professional_id', $user->id)
            ->whereNotIn('status', ['intervention_terminee', 'annulee'])
            ->latest()
            ->first();

        $pendingDemands = Intervention::where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->where('service_type', 'depannage')
            ->where(function ($q) use ($user) {
                $q->whereNull('target_professional_id')
                    ->orWhere('target_professional_id', $user->id);
            })
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $completedInterventions = Intervention::where('professional_id', $user->id)
            ->where('status', 'intervention_terminee')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('depanneur.dashboard', compact('activeIntervention', 'pendingDemands', 'completedInterventions'));
    }
}
