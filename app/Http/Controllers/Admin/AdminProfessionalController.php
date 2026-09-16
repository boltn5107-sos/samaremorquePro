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

    public function edit(User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        $professional->load('remorqueurProfile', 'depanneurProfile', 'remorque');

        return view('admin.professional-edit', compact('professional'));
    }

    public function update(Request $request, User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'zone_intervention' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
        ]);

        $professional->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'zone_intervention' => $validated['zone_intervention'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        if ($professional->isRemorqueur() && $professional->remorqueurProfile) {
            $professional->remorqueurProfile->update([
                'hourly_rate' => $validated['hourly_rate'] ?? null,
            ]);
        } elseif ($professional->isDepanneur() && $professional->depanneurProfile) {
            $professional->depanneurProfile->update([
                'hourly_rate' => $validated['hourly_rate'] ?? null,
            ]);
        }

        return redirect()
            ->route('admin.professionnels.show', $professional)
            ->with('status', 'Professionnel mis a jour.');
    }

    public function destroy(Request $request, User $professional)
    {
        abort_if(!in_array($professional->role, ['remorqueur', 'depanneur']), 404);

        foreach ($professional->interventionsAsProfessional as $intervention) {
            $intervention->statuses()->delete();
            $intervention->notifications()->delete();
            $intervention->rejections()->delete();
            $intervention->delete();
        }

        $professional->remorqueurProfile?->delete();
        $professional->depanneurProfile?->delete();
        $professional->remorque?->delete();
        $professional->locations()->delete();
        $professional->delete();

        return redirect()->route('admin.professionnels.index')
            ->with('status', 'Professionnel supprime.');
    }
}
