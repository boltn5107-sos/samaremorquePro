<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $todayInterventions = Intervention::whereDate('created_at', today())->count();
        $activeInterventions = Intervention::whereNotIn('status', ['intervention_terminee', 'annulee'])->count();
        $completedInterventions = Intervention::where('status', 'intervention_terminee')->count();
        $availableProfessionals = User::whereIn('role', ['remorqueur', 'depanneur'])
            ->where('is_validated', true)
            ->where('is_active', true)
            ->count();

        return view('admin.dashboard', compact(
            'todayInterventions',
            'activeInterventions',
            'completedInterventions',
            'availableProfessionals'
        ));
    }

    public function map()
    {
        $professionals = User::whereIn('role', ['remorqueur', 'depanneur'])
            ->where('is_validated', true)
            ->where('is_active', true)
            ->with('locations')
            ->get();

        $activeInterventions = Intervention::whereNotIn('status', ['intervention_terminee', 'annulee'])
            ->with('client', 'professional')
            ->get();

        return view('admin.map', compact('professionals', 'activeInterventions'));
    }

    public function stats()
    {
        $stats = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_remorqueurs' => User::where('role', 'remorqueur')->count(),
            'total_depanneurs' => User::where('role', 'depanneur')->count(),
            'total_interventions' => Intervention::count(),
            'interventions_this_month' => Intervention::whereMonth('created_at', now()->month)->count(),
            'interventions_last_month' => Intervention::whereMonth('created_at', now()->subMonth())->count(),
        ];

        return view('admin.stats', compact('stats'));
    }
}
