<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Depanneur;
use App\Models\Remorqueur;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthenticatedRegistrationController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', 'in:client,remorqueur,depanneur'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        $this->createProfile($user, $request->role);

        event(new Registered($user));

        Auth::login($user);

        return match ($user->role) {
            'client' => redirect()->route('client.dashboard'),
            'remorqueur' => redirect()->route('remorqueur.dashboard'),
            'depanneur' => redirect()->route('depanneur.dashboard'),
            default => redirect()->route('home'),
        };
    }

    protected function createProfile(User $user, string $role): void
    {
        match ($role) {
            'client' => Client::firstOrCreate(['user_id' => $user->id]),
            'remorqueur' => Remorqueur::firstOrCreate(['user_id' => $user->id]),
            'depanneur' => Depanneur::firstOrCreate(['user_id' => $user->id]),
            default => null,
        };
    }
}
