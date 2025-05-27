<?php

namespace App\Notifications\Social\Friendship;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class FriendRequestCancelledNotification extends Notification implements ShouldBroadcast
{
    public function __construct(
        private User $canceller,
        private User $receiver
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'canceller_id' => $this->canceller->id,
            'receiver_id' => $this->receiver->id,
            'message' => 'Користувач ' . $this->canceller->username . ' скасував запит на дружбу.',
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [
            'canceller_id' => $this->canceller->id,
            'receiver_id' => $this->receiver->id,
            'message' => 'Користувач ' . $this->canceller->username . ' скасував запит на дружбу.',
        ];
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('notifications.' . $this->receiver->id)];
    }

    public function broadcastAs(): string
    {
        return 'friend-request.cancelled';
    }
}
