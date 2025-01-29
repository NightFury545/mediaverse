<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    /**
     * Determine whether the user can view any chats.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view a specific chat.
     */
    public function view(User $user, Chat $chat): bool
    {
        return $user->id === $chat->user_one_id
            || $user->id === $chat->user_two_id
            || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create a chat.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the chat.
     */
    public function update(User $user, Chat $chat): bool
    {
        return $user->id === $chat->user_one_id
            || $user->id === $chat->user_two_id;
    }

    /**
     * Determine whether the user can delete the chat.
     */
    public function delete(User $user, Chat $chat): bool
    {
        return $user->id === $chat->user_one_id
            || $user->id === $chat->user_two_id
            || $user->role === 'admin';
    }
}
