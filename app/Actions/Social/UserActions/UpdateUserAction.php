<?php

namespace App\Actions\Social\UserActions;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateUserAction
{
    /**
     * Оновлює повідомлення з новими даними.
     *
     * @param User $user
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function __invoke(User $user, array $data): User
    {
        DB::beginTransaction();

        try {
            $this->updateUser($user, $data);

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Не вдалося оновити користувача: ' . $e->getMessage());
        }
    }

    /**
     * Оновлює повідомлення з новими даними.
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    private function updateUser(User $user, array $data): void
    {
        $user->update($this->prepareUpdateUserData($user, $data));
    }

    private function prepareUpdateUserData(User $user, array $data): array
    {
        return [
            'username' => $data['username'] ?? $user->username,
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
            'avatar' => $data['avatar'] ?? $user->avatar,
            'gender' => $data['gender'] ?? $user->gender,
            'biography' => $data['biography'] ?? $user->biography,
            'country' => $data['country'] ?? $user->country,
            'is_online' => $data['is_online'] ?? $user->is_online,
            'last_seen_at' => $data['last_seen_at'] ?? $user->last_seen_at,
        ];
    }

}
