<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        Location::create([
            'user_id' => Auth::id(),
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'recorded_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
}
