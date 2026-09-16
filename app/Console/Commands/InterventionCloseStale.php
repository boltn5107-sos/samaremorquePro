<?php

namespace App\Console\Commands;

use App\Models\Intervention;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InterventionCloseStale extends Command
{
    protected $signature = 'interventions:close-stale';
    protected $description = 'Ferme les interventions en attente depuis trop longtemps';

    public function handle(): void
    {
        $staleThreshold = now()->subHours(2);

        Intervention::where('status', Intervention::STATUS_AWAITING_PROFESSIONAL)
            ->where('created_at', '<', $staleThreshold)
            ->update(['status' => 'annulee']);

        $this->info('Interventions en attente fermees avec succes.');
    }
}
