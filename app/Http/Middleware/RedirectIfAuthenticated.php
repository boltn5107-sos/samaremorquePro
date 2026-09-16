<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                return match ($user->role) {
                    'client' => redirect()->route('client.dashboard'),
                    'remorqueur' => redirect()->route('remorqueur.dashboard'),
                    'depanneur' => redirect()->route('depanneur.dashboard'),
                    'admin' => redirect()->route('admin.dashboard'),
                    default => redirect('/'),
                };
            }
        }

        return $next($request);
    }
}
