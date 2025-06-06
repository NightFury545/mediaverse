<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FriendshipPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === Role::ADMIN->value;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Friendship $friendship): bool
    {
        return $user->id === $friendship->user->id
            || $user->id === $friendship->friend->id
            || $user->role === Role::ADMIN->value;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Friendship $friendship): bool
    {
        return $user->id === $friendship->user->id
            || $user->id === $friendship->friend->id
            || $user->role === Role::ADMIN->value;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Friendship $friendship): bool
    {
        return $user->id === $friendship->user->id
            || $user->id === $friendship->friend->id
            || $user->role === Role::ADMIN->value;
    }
}
