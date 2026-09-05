<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'total_professionals' => User::whereIn('role', ['remorqueur', 'depanneur'])->count(),
            'validated_professionals' => User::whereIn('role', ['remorqueur', 'depanneur'])->where('is_validated', true)->count(),
            'total_interventions' => Intervention::count(),
            'interventions_this_month' => Intervention::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'interventions_last_month' => Intervention::whereMonth('created_at', now()->subMonthNoOverflow())->whereYear('created_at', now()->subMonthNoOverflow())->count(),
            'completed_interventions' => Intervention::where('status', Intervention::STATUS_COMPLETED)->count(),
            'cancelled_interventions' => Intervention::where('status', Intervention::STATUS_CANCELLED)->count(),
            'avg_rating' => (float) Intervention::whereNotNull('rating')->avg('rating'),
            'total_ratings' => Intervention::whereNotNull('rating')->count(),
        ];

        $statusBreakdown = Intervention::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthlyTrend = collect(range(5, 0))->map(function ($offset) {
            $date = now()->subMonthsNoOverflow($offset);
            return [
                'label' => Str::ucfirst($date->translatedFormat('M Y')),
                'year' => $date->year,
                'month' => $date->month,
                'total' => Intervention::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'completed' => Intervention::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->where('status', Intervention::STATUS_COMPLETED)
                    ->count(),
            ];
        });

        $topProfessionals = User::whereIn('role', ['remorqueur', 'depanneur'])
            ->where('is_validated', true)
            ->withCount(['interventionsAsProfessional' => function ($q) {
                $q->where('status', Intervention::STATUS_COMPLETED);
            }])
            ->orderByDesc('interventions_as_professional_count')
            ->take(10)
            ->get()
            ->each(function ($professional) {
                $ratings = Intervention::ratingsForProfessional($professional->id);
                $professional->avg_rating = $ratings['average'];
                $professional->total_ratings = $ratings['count'];
                $professional->hourly_rate = $professional->isRemorqueur()
                    ? $professional->remorqueurProfile?->hourly_rate
                    : $professional->depanneurProfile?->hourly_rate;
            });

        $revenueEstimate = Intervention::where('status', Intervention::STATUS_COMPLETED)
            ->with('professional')
            ->get()
            ->sum(function (Intervention $intervention) {
                $professional = $intervention->professional;
                if (!$professional) {
                    return 0;
                }
                $rate = $professional->isRemorqueur()
                    ? $professional->remorqueurProfile?->hourly_rate
                    : $professional->depanneurProfile?->hourly_rate;
                return (float) $rate * ((float) $intervention->estimated_duration_minutes / 60);
            });

        return view('admin.stats', compact(
            'stats',
            'statusBreakdown',
            'monthlyTrend',
            'topProfessionals',
            'revenueEstimate'
        ));
    }
}
