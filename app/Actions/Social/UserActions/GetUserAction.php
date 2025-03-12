<?php

namespace App\Actions\Social\UserActions;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class GetUserAction
{
    /**
     * Отримує дані користувача залежно від рівня доступу.
     *
     * Цей метод перевіряє рівень доступу до даних користувача та повертає або повну,
     * або обмежену інформацію залежно від того, чи є запитуваний користувач власником.
     *
     * @param string $identifier Ідентифікатор користувача (ID або username)
     * @return array Масив з даними користувача
     * @throws Exception Якщо користувача не знайдено або сталася помилка
     */
    public function __invoke(string $identifier): array
    {
        try {
            $authUser = Auth::user();
            $user = $this->findUserByIdentifier($identifier);

            if (!$user) {
                throw new Exception('Користувача не знайдено.');
            }

            return $this->isOwner($authUser, $user)
                ? $this->getFullUserData($user)
                : $this->getPublicUserData($user);
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання користувача: ' . $e->getMessage());
        }
    }

    /**
     * Знаходить користувача за його ідентифікатором.
     *
     * @param string $identifier Ідентифікатор користувача (ID або username)
     * @return User|null Повертає об'єкт користувача або null, якщо не знайдено
     */
    private function findUserByIdentifier(string $identifier): ?User
    {
        return User::where('id', $identifier)
            ->orWhere('username', $identifier)
            ->first();
    }

    /**
     * Перевіряє, чи є поточний користувач власником профілю.
     *
     * @param User|null $authUser Авторизований користувач
     * @param User $user Користувач, чий профіль запитують
     * @return bool Повертає true, якщо користувач є власником
     */
    private function isOwner(?User $authUser, User $user): bool
    {
        return $authUser && $authUser->id === $user->id;
    }

    /**
     * Повертає повну інформацію про користувача (для власника).
     *
     * @param User $user Користувач, чию інформацію потрібно повернути
     * @return array Масив з повною інформацією про користувача
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
     * Повертає обмежену інформацію про користувача (для інших користувачів).
     *
     * @param User $user Користувач, чию інформацію потрібно повернути
     * @return array Масив з обмеженою інформацією про користувача
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
