<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public int $roomId;

    public function __construct($message, $roomId)
    {
        $this->message = $message;
        $this->roomId = $roomId;
    }

    public function broadcastOn()
    {
        return ['channel-'. $this->roomId];
    }

    public function broadcastAs()
    {
        return 'chat-event';
    }
}
