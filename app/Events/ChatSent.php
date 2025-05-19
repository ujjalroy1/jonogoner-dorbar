<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChatSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat->load('sender');
    }

    public function broadcastOn()
    {
        // Private channels for admin and user in session
        return new PrivateChannel('chat.' . $this->chat->chat_session_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'message' => $this->chat->message,
            'sender' => $this->chat->sender->name,
            'sender_id' => $this->chat->sender->id,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
    }
}
