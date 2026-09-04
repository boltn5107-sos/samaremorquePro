<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminProfessionalController extends Controller
{
    public function index()
    {
        $professionals = User::whereIn('role', ['remorqueur', 'depanneur'])
            ->with('remorqueurProfile', 'depanneurProfile')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.professionals', compact('professionals'));
    }

    public function show(User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        $professional->load('remorqueurProfile', 'depanneurProfile', 'remorque', 'services', 'interventionsAsProfessional');

        $rating = \App\Models\Intervention::ratingsForProfessional($professional->id);

        return view('admin.professional-detail', compact('professional', 'rating'));
    }

    public function validate(Request $request, User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        $professional->update(['is_validated' => true]);

        return back()->with('status', 'professional-validated');
    }

    public function suspend(Request $request, User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        $professional->update(['is_active' => false]);

        return back()->with('status', 'professional-suspended');
    }

    public function reactivate(Request $request, User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        $professional->update(['is_active' => true]);

        return back()->with('status', 'professional-reactivated');
    }
}
