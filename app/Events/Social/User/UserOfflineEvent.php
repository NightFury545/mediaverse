<?php

namespace App\Events\Social\User;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class UserOfflineEvent implements ShouldBroadcast
{
    use SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('public-user-status');
    }

    public function broadcastAs(): string
    {
        return 'user.offline';
    }
    public function broadcastWith(): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
        ];
    }
}
