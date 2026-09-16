<?php

namespace App\Listeners;

use App\Events\InterventionCreated;
use App\Services\NotificationService;
use App\Services\InterventionMatchingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInterventionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        protected NotificationService $notifications,
        protected InterventionMatchingService $matcher
    ) {}

    public function handle(InterventionCreated $event): void
    {
        $this->matcher->findAndNotify($event->intervention);
    }
}
