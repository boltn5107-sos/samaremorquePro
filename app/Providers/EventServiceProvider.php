<?php

namespace App\Providers;

use App\Events\InterventionAccepted;
use App\Events\InterventionCreated;
use App\Events\InterventionStatusUpdated;
use App\Events\ProfessionalLocated;
use App\Listeners\BroadcastProfessionalLocation;
use App\Listeners\NotifyClientAccepted;
use App\Listeners\NotifyInterventionStatus;
use App\Listeners\SendInterventionNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        InterventionCreated::class => [
            SendInterventionNotification::class,
        ],
        InterventionAccepted::class => [
            NotifyClientAccepted::class,
        ],
        InterventionStatusUpdated::class => [
            NotifyInterventionStatus::class,
        ],
        ProfessionalLocated::class => [
            BroadcastProfessionalLocation::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
