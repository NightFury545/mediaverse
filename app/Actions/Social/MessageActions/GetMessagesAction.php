<?php

namespace App\Actions\Social\MessageActions;

use App\Models\Chat;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetMessagesAction
{
    /**
     * Отримує повідомлення для заданого чату з пагінацією та сортуванням від нових до старих.
     *
     * @param Chat $chat
     * @param int $perPage Скільки повідомлень повертати за один запит (за замовчуванням 20)
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function execute(Chat $chat, int $perPage = 20): LengthAwarePaginator
    {
        try {
            return $chat->messages()
                ->with('user:username,avatar')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання повідомлень: ' . $e->getMessage());
        }
    }
}

