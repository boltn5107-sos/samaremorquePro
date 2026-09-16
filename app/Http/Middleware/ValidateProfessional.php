<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateProfessional
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ($user->isRemorqueur() || $user->isDepanneur()) && !$user->is_validated) {
            abort(403, 'Votre compte professionnel est en cours de validation par l\'administrateur.');
        }

        return $next($request);
    }
}
