<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use Illuminate\Http\Request;

class AdminInterventionController extends Controller
{
    public function index()
    {
        $interventions = Intervention::with('client', 'professional')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.interventions', compact('interventions'));
    }

    public function show(Intervention $intervention)
    {
        $intervention->load('client', 'professional', 'statuses', 'vehicle');

        return view('admin.intervention-detail', compact('intervention'));
    }
}
