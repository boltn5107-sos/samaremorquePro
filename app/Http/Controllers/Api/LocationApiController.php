<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationApiController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        Location::create([
            'user_id' => Auth::id(),
            'lat' => $validated['lat'],
            'lng' => $validated['lng'],
            'address' => $validated['address'],
            'recorded_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
}
