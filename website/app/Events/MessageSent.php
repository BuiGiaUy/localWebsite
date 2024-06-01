<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
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

    public Message $message;
    public User $user;
    public int $roomId;

    public function __construct(Message $message, User $user ,$roomId)
    {
        $this->message = $message;
        $this->user = $user;
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
