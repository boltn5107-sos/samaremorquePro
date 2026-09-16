<?php

namespace App\Events;

use App\Models\Intervention;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InterventionAccepted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $intervention;

    public function __construct(Intervention $intervention)
    {
        $this->intervention = $intervention;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('intervention.' . $this->intervention->id);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->intervention->id,
            'professional_id' => $this->intervention->professional_id,
            'status' => $this->intervention->status,
        ];
    }
}
