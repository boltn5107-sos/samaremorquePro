<?php

namespace App\Events;

use App\Models\Intervention;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InterventionCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $intervention;

    public function __construct(Intervention $intervention)
    {
        $this->intervention = $intervention;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('intervention.' . $this->intervention->id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->intervention->id,
            'service_type' => $this->intervention->service_type,
            'client_lat' => $this->intervention->client_lat,
            'client_lng' => $this->intervention->client_lng,
            'client_address' => $this->intervention->client_address,
            'destination' => $this->intervention->destination,
            'description' => $this->intervention->description,
            'created_at' => $this->intervention->created_at->toDateTimeString(),
        ];
    }
}
