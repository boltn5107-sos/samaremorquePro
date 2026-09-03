<?php

namespace App\Http\Controllers\Remorqueur;

use App\Http\Controllers\Controller;
use App\Models\Remorqueur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemorqueurAvailabilityController extends Controller
{
    public function toggle()
    {
        $profile = Remorqueur::where('user_id', Auth::id())->firstOrFail();

        $profile->update([
            'is_available' => !$profile->is_available,
        ]);

        return back()->with('status', 'availability-toggled');
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        Auth::user()->locations()->create([
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'recorded_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
}
