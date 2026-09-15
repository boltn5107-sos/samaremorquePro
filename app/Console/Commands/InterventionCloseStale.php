<?php

namespace App\Console\Commands;

use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Notification;
use Illuminate\Console\Command;

class InterventionCloseStale extends Command
{
    protected $signature = 'interventions:close-stale';
    protected $description = 'Expire les offres d\'intervention restees sans professionnel pendant trop longtemps';

    public function handle(): void
    {
        $staleOffers = Intervention::staleOffers()->get();

        $closed = 0;

        foreach ($staleOffers as $intervention) {
            $intervention->update([
                'status' => Intervention::STATUS_CANCELLED,
            ]);

            InterventionStatus::create([
                'intervention_id' => $intervention->id,
                'status' => Intervention::STATUS_CANCELLED,
                'user_id' => null,
                'note' => 'Expiration automatique : aucun professionnel disponible dans le delai.',
            ]);

            if ($intervention->client_id !== null && ! $intervention->isGuest()) {
                Notification::create([
                    'user_id' => $intervention->client_id,
                    'type' => 'intervention_update',
                    'notifiable_type' => Intervention::class,
                    'notifiable_id' => $intervention->id,
                    'data' => [
                        'title' => 'Intervention expiree',
                        'body' => 'Aucun professionnel disponible dans le delai. Votre demande a ete annulee. Relancez une nouvelle demande.',
                        'url' => '/client/interventions',
                    ],
                ]);
            }

            $closed++;
        }

        $this->info($closed . ' offre(s) expiree(s).');
    }
}