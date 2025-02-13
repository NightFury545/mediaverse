<?php

namespace App\Events\Social\Chat;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     */
    public function __construct(private Message $message)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PresenceChannel|array
     */
    public function broadcastOn(): Channel|PresenceChannel|array
    {
        return new PresenceChannel('chat.' . $this->message->chat_id);
    }

    /**
     * Get the broadcast data for the event.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message->text,  // Текст повідомлення
            'sender_id' => $this->sender->id,   // ID відправника
            'sender_name' => $this->sender->name, // Ім'я відправника
            'created_at' => $this->createdAt,    // Час відправлення
            'chat_id' => $this->chatId           // ID чату
        ];
    }
}

