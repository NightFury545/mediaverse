<?php

namespace App\Actions\Social\ChatActions;

use App\Events\Social\Chat\ChatCreatedEvent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class CreateChatAction
{
    /**
     * Створює новий чат між двома користувачами.
     *
     * @param array $data Дані чату (user_two_id)
     * @return Chat Створений чат
     * @throws Exception
     */
    public function __invoke(array $data): Chat
    {
        DB::beginTransaction();

        try {
            $this->ensureConditionsMet($data);

            $chat = $this->createChat($data);

            broadcast(new ChatCreatedEvent($chat));

            DB::commit();

            return $chat;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час створення чату: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє всі необхідні умови перед створенням чату.
     *
     * @param array $data
     * @throws Exception
     */
    private function ensureConditionsMet(array $data): void
    {
        $this->validateChatDoesNotExist($data);
        $this->validateUsersAreDifferent($data);
        $this->validateNotBlockedUsers($data);
    }

    /**
     * Перевіряє, чи вже існує чат між цими користувачами.
     *
     * @param array $data
     * @throws Exception
     */
    private function validateChatDoesNotExist(array $data): void
    {
        $exists = Chat::where(function ($query) use ($data) {
            $query->where('user_one_id', Auth::id())
                ->where('user_two_id', $data['user_two_id']);
        })->orWhere(function ($query) use ($data) {
            $query->where('user_one_id', $data['user_two_id'])
                ->where('user_two_id', Auth::id());
        })->exists();

        if ($exists) {
            throw new Exception('Чат між цими користувачами вже існує.');
        }
    }

    /**
     * Перевіряє, що користувач не створює чат сам із собою.
     *
     * @param array $data
     * @throws Exception
     */
    private function validateUsersAreDifferent(array $data): void
    {
        if (Auth::id() === $data['user_two_id']) {
            throw new Exception('Користувач не може створити чат сам із собою.');
        }
    }

    /**
     * Перевіряє, що користувач не знаходиться у списку заблокованих.
     *
     * @param array $data
     * @throws Exception
     */
    private function validateNotBlockedUsers(array $data): void
    {
        $currentUser = Auth::user();
        $otherUser = User::find($data['user_two_id']);

        $isBlockedByCurrentUser = $currentUser->blockedUsers()->where('blocked_id', $otherUser->id)->exists();
        $isBlockedByOtherUser = $otherUser->blockedUsers()->where('blocked_id', $currentUser->id)->exists();

        if ($isBlockedByCurrentUser) {
            throw new Exception('Ви заблокували цього користувача і не можете створити чат.');
        }

        if ($isBlockedByOtherUser) {
            throw new Exception('Цей користувач заблокував вас і ви не можете створити чат.');
        }
    }

    /**
     * Створює новий чат.
     *
     * @param array $data
     * @return Chat
     */
    private function createChat(array $data): Chat
    {
        return Chat::create([
            'user_one_id' => Auth::id(),
            'user_two_id' => $data['user_two_id'],
            'last_message' => null,
            'last_message_at' => null,
        ]);
    }
}
