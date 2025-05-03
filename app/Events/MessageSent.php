<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $fromUserId;
    public $toUserId;
    public $fromUserName;

    public function __construct($message, $fromUserId, $toUserId, $fromUserName)
    {
        $this->message = $message;
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
        $this->fromUserName = $fromUserName; 
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->toUserId),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'from' => $this->fromUserId,
            'from_name' => $this->fromUserName, // Assuming you have a name attribute
        ];
    }
}
