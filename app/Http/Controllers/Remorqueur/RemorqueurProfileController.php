<?php

namespace App\Http\Controllers\Remorqueur;

use App\Http\Controllers\Controller;
use App\Models\Remorque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemorqueurProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

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

    public function updateRemorquePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'],
        ]);

        $user = Auth::user();
        $remorque = $user->remorque;

        if ($remorque) {
            $remorque->update([
                'photo' => $request->file('photo')->store('remorques', 'public'),
            ]);
        }

        return back()->with('status', 'remorque-photo-updated');
    }
}
