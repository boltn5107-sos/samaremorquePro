<?php

namespace App\Listeners;

use App\Events\ProfessionalLocated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastProfessionalLocation implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProfessionalLocated $event): void
    {
        broadcast($event);
    }
}
