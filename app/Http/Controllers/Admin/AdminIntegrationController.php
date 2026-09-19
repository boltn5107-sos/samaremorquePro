<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Page de documentation interne (espace admin) sur l'integration Wave.
 *
 * Montre l'etat reel de la configuration (.env) et explique le modele metier retenu
 * (Option B : commission payee par le professionnel, client regle le pro sur place).
 */
class AdminIntegrationController extends Controller
{
    public function index()
    {
        /**
         * Etat de la configuration lu depuis config/wave.php.
         * On n'affiche jamais les valeurs reelles des cles : seulement si elles
         * sont renseignees ou non ('Configuree' / 'Non configuree (vide)').
         */
        $wave = [
            'environment' => config('wave.environment', 'non configure'),
            'sandbox_key' => filled(config('wave.sandbox.api_key')) ? 'Configuree' : 'Non configuree (vide)',
            'production_key' => filled(config('wave.production.api_key')) ? 'Configuree' : 'Non configuree (vide)',
            'webhook_secret' => filled(config('wave.webhook_secret')) ? 'Configuree' : 'Non configuree (vide)',
            'success_url' => config('wave.success_url') ?: '(non defini)',
            'error_url' => config('wave.error_url') ?: '(non defini)',
        ];

        return view('admin.integration', compact('wave'));
    }
}