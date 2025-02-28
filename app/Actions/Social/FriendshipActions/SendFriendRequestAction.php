<?php

namespace App\Actions\Social\FriendshipActions;

use App\Enums\FriendshipStatus;
use App\Models\Friendship;
use App\Models\User;
use App\Notifications\Social\Friendship\FriendRequestSentNotification;
use Illuminate\Support\Facades\DB;
use Exception;

class SendFriendRequestAction
{
    /**
     * Відправляє запит на дружбу.
     *
     * @param User $sender Відправник запиту
     * @param User $receiver Отримувач запиту
     * @return Friendship
     * @throws Exception
     */
    public function __invoke(User $sender, User $receiver): Friendship
    {
        DB::beginTransaction();

        try {
            $this->ensureConditionsMet($sender, $receiver);

            $friendship = $this->createFriendRequest($sender, $receiver);

            $sender->notify(new FriendRequestSentNotification($sender, $receiver));

            DB::commit();

            return $friendship;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час надсилання запиту на дружбу: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє всі необхідні умови перед створенням запиту.
     *
     * @param User $sender
     * @param User $receiver
     * @throws Exception
     */
    private function ensureConditionsMet(User $sender, User $receiver): void
    {
        $this->validateUsersAreDifferent($sender, $receiver);
        $this->validateRequestDoesNotExist($sender, $receiver);
    }

    /**
     * Перевіряє, що користувач не відправляє запит сам собі.
     *
     * @param User $sender
     * @param User $receiver
     * @throws Exception
     */
    private function validateUsersAreDifferent(User $sender, User $receiver): void
    {
        if ($sender->id === $receiver->id) {
            throw new Exception('Не можна відправити запит на дружбу самому собі.');
        }
    }

    /**
     * Перевіряє, чи запит на дружбу вже існує.
     *
     * @param User $sender
     * @param User $receiver
     * @throws Exception
     */
    private function validateRequestDoesNotExist(User $sender, User $receiver): void
    {
        $exists = Friendship::where(function ($query) use ($sender, $receiver) {
            $query->where('user_id', $sender->id)
                ->where('friend_id', $receiver->id);
        })->orWhere(function ($query) use ($sender, $receiver) {
            $query->where('user_id', $receiver->id)
                ->where('friend_id', $sender->id);
        })->exists();

        if ($exists) {
            throw new Exception('Запит на дружбу вже існує.');
        }
    }

    /**
     * Створює новий запит на дружбу.
     *
     * @param User $sender
     * @param User $receiver
     * @return Friendship
     */
    private function createFriendRequest(User $sender, User $receiver): Friendship
    {
        return Friendship::create([
            'user_id' => $sender->id,
            'friend_id' => $receiver->id,
            'status' => FriendshipStatus::PENDING->value,
        ]);
    }
}
