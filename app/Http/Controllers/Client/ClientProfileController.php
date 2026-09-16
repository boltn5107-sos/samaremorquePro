<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'zone_intervention' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('status', 'profile-updated');
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:20'],
        ]);

        Auth::user()->update(['phone' => $request->phone]);

        return back()->with('status', 'phone-updated');
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

    public function vehicles()
    {
        return view('client.vehicles', [
            'vehicles' => Auth::user()->vehicles()->get(),
        ]);
    }

    public function storeVehicle(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:100'],
            'brand' => ['nullable', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'plate_number' => ['nullable', 'string', 'max:20'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);

        Auth::user()->vehicles()->create($request->only(['type', 'brand', 'model', 'plate_number', 'color']));

        return back()->with('status', 'vehicle-created');
    }

    public function destroyVehicle(Vehicle $vehicle)
    {
        abort_if($vehicle->user_id !== Auth::id(), 403);

        $vehicle->delete();

        return back()->with('status', 'vehicle-deleted');
    }
}
