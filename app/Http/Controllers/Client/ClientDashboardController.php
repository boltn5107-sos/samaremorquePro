<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activeIntervention = Intervention::where('client_id', $user->id)
            ->whereNotIn('status', ['intervention_terminee', 'annulee'])
            ->latest()
            ->first();

        $recentInterventions = Intervention::where('client_id', $user->id)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('client.dashboard', compact('activeIntervention', 'recentInterventions'));
    }
}
