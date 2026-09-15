<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminIntegrationController extends Controller
{
    public function index()
    {
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