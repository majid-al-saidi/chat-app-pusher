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

    public function broadcastOn()
    {
        $channelName = $this->generateChatChannel($this->fromUserId, $this->toUserId);
        return new PrivateChannel("chat.{$channelName}");
    }

    private function generateChatChannel($userA, $userB)
    {
        $ids = [$userA, $userB];
        sort($ids); // Ensures consistency: chat.2.5 and chat.5.2 → chat.2.5
        return implode('.', $ids);
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
