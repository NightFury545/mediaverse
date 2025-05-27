<?php

namespace App\Notifications\Social\Friendship;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class FriendRequestRejectedNotification extends Notification implements ShouldBroadcast
{
    public function __construct(
        private User $rejector,
        private User $sender
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'rejector_id' => $this->rejector->id,
            'sender_id' => $this->sender->id,
            'message' => 'Користувач ' . $this->rejector->username . ' відхилив ваш запит на дружбу.',
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [
            'rejector_id' => $this->rejector->id,
            'sender_id' => $this->sender->id,
            'message' => 'Користувач ' . $this->rejector->username . ' відхилив ваш запит на дружбу.',
        ];
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('notifications.' . $this->sender->id)];
    }

    public function broadcastAs(): string
    {
        return 'friend-request.rejected';
    }
}
