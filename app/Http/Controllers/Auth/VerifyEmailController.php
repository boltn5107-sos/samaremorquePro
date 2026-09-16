<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->user()->markEmailAsVerified();

        return redirect()->intended(route('home') . '?verified=1');
    }
}
