<?php

namespace App\Notifications\Social\Friendship;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class FriendRequestSentNotification extends Notification implements ShouldBroadcast
{
    public function __construct(
        private User $sender,
        private User $receiver
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'sender_id' => $this->sender->id,
            'receiver_id' => $this->receiver->id,
            'message' => 'Ви надіслали заявку в друзі користувачу ' . $this->receiver->username,
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [
            'sender_id' => $this->sender->id,
            'receiver_id' => $this->receiver->id,
            'message' => 'Ви надіслали заявку в друзі користувачу ' . $this->receiver->username,
        ];
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('notifications.' . $this->sender->id)];
    }

    public function broadcastAs(): string
    {
        return 'friend-request.sent';
    }
}

