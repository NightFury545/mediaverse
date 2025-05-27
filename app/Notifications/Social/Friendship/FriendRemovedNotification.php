<?php

namespace App\Notifications\Social\Friendship;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class FriendRemovedNotification extends Notification implements ShouldBroadcast
{
    public function __construct(
        private User $remover,
        private User $removed
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'remover_id' => $this->remover->id,
            'removed_id' => $this->removed->id,
            'message' => 'Користувач ' . $this->remover->username . ' видалив вас із друзів.',
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [
            'remover_id' => $this->remover->id,
            'removed_id' => $this->removed->id,
            'message' => 'Користувач ' . $this->remover->username . ' видалив вас із друзів.',
        ];
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('notifications.' . $this->removed->id)];
    }

    public function broadcastAs(): string
    {
        return 'friend.removed';
    }
}
