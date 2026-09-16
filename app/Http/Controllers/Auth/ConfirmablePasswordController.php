<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmablePasswordController extends Controller
{
    public function show()
    {
        return view('auth.confirm-password');
    }

    public function store(Request $request)
    {
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            return back()->withErrors([
                'password' => __('Le mot de passe fourni est incorrect.'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('home'));
    }
}
