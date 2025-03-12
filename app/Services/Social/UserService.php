<?php

namespace App\Services\Social;

use App\Actions\Social\UserActions\DeleteUserAction;
use App\Actions\Social\UserActions\GetUserAction;
use App\Actions\Social\UserActions\GetUsersAction;
use App\Actions\Social\UserActions\UpdateUserAction;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        protected GetUserAction $getUserAction,
        protected GetUsersAction $getUsersAction,
        protected UpdateUserAction $updateUserAction,
        protected DeleteUserAction $deleteUserAction
    ) {
    }

    public function getUser(string $identifier): array
    {
        return ($this->getUserAction)($identifier);
    }

    public function getUsers(int $perPage = 20): LengthAwarePaginator
    {
        return ($this->getUsersAction)($perPage);
    }

    public function update(User $user, array $data): User
    {
        return ($this->updateUserAction)($user, $data);
    }

    public function delete(User $user): void
    {
        ($this->deleteUserAction)($user);
    }
}
