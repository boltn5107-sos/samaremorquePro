<?php

namespace App\Http\Controllers\Depanneur;

use App\Http\Controllers\Controller;
use App\Models\Depanneur;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepanneurProfileController extends Controller
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

    public function updateServices(Request $request)
    {
        $request->validate([
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['exists:services,id'],
        ]);

        $user = Auth::user();

        $profile = Depanneur::where('user_id', $user->id)->firstOrFail();

        $profile->services()->sync($request->services);

        return back()->with('status', 'services-updated');
    }
}
