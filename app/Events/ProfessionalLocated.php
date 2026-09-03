<?php

namespace App\Events;

use App\Models\Location;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfessionalLocated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('professional.' . $this->location->user_id);
    }

    public function broadcastWith(): array
    {
        return [
            'user_id' => $this->location->user_id,
            'lat' => $this->location->lat,
            'lng' => $this->location->lng,
            'address' => $this->location->address,
            'recorded_at' => $this->location->recorded_at->toDateTimeString(),
        ];
    }
}
