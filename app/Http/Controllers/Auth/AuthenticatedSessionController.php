<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('Identifiants incorrects.'),
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return match ($user->role) {
            'client' => redirect()->route('client.dashboard'),
            'remorqueur' => redirect()->route('remorqueur.dashboard'),
            'depanneur' => redirect()->route('depanneur.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('home'),
        };
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
