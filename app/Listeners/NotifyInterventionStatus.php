<?php

namespace App\Listeners;

use App\Events\InterventionStatusUpdated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyInterventionStatus implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(protected NotificationService $notifications) {}

    public function handle(InterventionStatusUpdated $event): void
    {
        $intervention = $event->intervention;

        $this->notifications->sendToUser(
            $intervention->client_id,
            'intervention_status_updated',
            'Statut mis a jour: ' . $event->status,
            $intervention
        );

        if ($intervention->professional_id) {
            $this->notifications->sendToUser(
                $intervention->professional_id,
                'intervention_status_updated',
                'Statut mis a jour: ' . $event->status,
                $intervention
            );
        }
    }
}
