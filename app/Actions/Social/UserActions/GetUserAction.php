<?php

namespace App\Actions\Social\UserActions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetUserAction
{
    /**
     * Отримує дані користувача залежно від рівня доступу.
     */
    public function __invoke(User $user): array
    {
        $authUser = Auth::user();

        return $this->isOwner($authUser, $user)
            ? $this->getFullUserData($user)
            : $this->getPublicUserData($user);
    }

    /**
     * Перевіряє, чи це власник аккаунту.
     */
    private function isOwner(?User $authUser, User $user): bool
    {
        return $authUser && $authUser->id === $user->id;
    }

    /**
     * Повертає повну інформацію про користувача (для власника).
     */
    private function getFullUserData(User $user): array
    {
        return collect($user->toArray())->except([
            'password',
            'google_id',
            'github_id',
        ])->toArray();
    }


    /**
     * Повертає обмежену інформацію про користувача (для інших).
     */
    private function getPublicUserData(User $user): array
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role' => $user->role,
            'avatar' => $user->avatar,
            'gender' => $user->gender,
            'biography' => $user->biography,
            'country' => $user->country,
            'is_online' => $user->is_online,
            'last_seen_at' => $user->last_seen_at,
        ];
    }
}
