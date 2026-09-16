<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\InterventionCreated::class => [
            \App\Listeners\SendInterventionNotification::class,
        ],
        \App\Events\InterventionAccepted::class => [
            \App\Listeners\NotifyClientAccepted::class,
        ],
        \App\Events\InterventionStatusUpdated::class => [
            \App\Listeners\NotifyInterventionStatus::class,
        ],
        \App\Events\ProfessionalLocated::class => [
            \App\Listeners\BroadcastProfessionalLocation::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
