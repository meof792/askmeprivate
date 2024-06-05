<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $room_id;
    public string $message;
    public string $otherUser;


    public function __construct(string $room_id, string $otherUser, string $message)
    {
        $this->room_id = $room_id;
        $this->otherUser = $otherUser;
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [$this->room_id];
    }
    public function broadcastAs(): string
    {
        return 'chat';
    }
}
