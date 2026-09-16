<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Depanneur;
use App\Models\Remorqueur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:client,remorqueur,depanneur'],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        $this->createProfile($user, $validated['role']);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
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

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, 204);
    }
}
