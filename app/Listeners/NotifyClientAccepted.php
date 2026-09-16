<?php

namespace App\Listeners;

use App\Events\InterventionAccepted;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyClientAccepted implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(protected NotificationService $notifications) {}

    public function handle(InterventionAccepted $event): void
    {
        $this->notifications->sendToUser(
            $event->intervention->client_id,
            'intervention_accepted',
            'Votre demande a ete acceptee',
            $event->intervention
        );
    }
}
