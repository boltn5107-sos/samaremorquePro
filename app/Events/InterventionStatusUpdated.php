<?php

namespace App\Events;

use App\Models\Intervention;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InterventionStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $intervention;
    public $status;
    public $note;

    public function __construct(Intervention $intervention, string $status, ?string $note = null)
    {
        $this->intervention = $intervention;
        $this->status = $status;
        $this->note = $note;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('intervention.' . $this->intervention->id);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->intervention->id,
            'status' => $this->status,
            'note' => $this->note,
            'updated_at' => now()->toDateTimeString(),
        ];
    }
}
