<?php

namespace App\Http\Controllers;

use App\Models\Depanneur;
use App\Models\Remorqueur;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        $remorque = $user->remorque;
        $profile = null;
        $services = collect();
        $assignedServices = collect();

        if ($user->isRemorqueur()) {
            $profile = Remorqueur::where('user_id', $user->id)->first();
            $remorque = $user->remorque;
        }

        if ($user->isDepanneur()) {
            $profile = Depanneur::where('user_id', $user->id)->first();
            $services = Service::where('is_active', true)->get();
            $assignedServices = $profile ? $profile->services()->pluck('services.id') : collect();
        }

        return view('profile.edit', compact('user', 'remorque', 'profile', 'services', 'assignedServices'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'zone_intervention' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'professional_info' => ['nullable', 'string', 'max:2000'],
        ]);

        $user->update($validated);

        return back()->with('status', 'profile-updated');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'],
        ]);

        Auth::user()->update([
            'photo' => $request->file('photo')->store('profiles', 'public'),
        ]);

        return back()->with('status', 'photo-updated');
    }

    public function updateRemorque(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:100'],
            'capacity' => ['nullable', 'string', 'max:100'],
            'immatriculation' => ['nullable', 'string', 'max:50'],
            'informations' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = Auth::user();

        $user->remorque()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['type', 'capacity', 'immatriculation', 'informations'])
        );

        return back()->with('status', 'remorque-updated');
    }

    public function updateServices(Request $request)
    {
        $request->validate([
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['exists:services,id'],
        ]);

        $profile = Depanneur::where('user_id', Auth::id())->firstOrFail();
        $profile->services()->sync($request->services);

        return back()->with('status', 'services-updated');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
