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
     * Цей метод дозволяє отримати повідомлення з певного чату з пагінацією, з можливістю вказати
     * кількість повідомлень на сторінку. Повертається пагінований результат з повідомленнями, де
     * повідомлення відсортовані за датою створення від нових до старих.
     *
     * @param Chat $chat Чат, для якого потрібно отримати повідомлення.
     * @param int $perPage Скільки повідомлень повертати за один запит (за замовчуванням 20).
     * @return LengthAwarePaginator Пагіновані повідомлення.
     * @throws Exception Якщо сталася помилка під час отримання повідомлень.
     */
    public function __invoke(Chat $chat, int $perPage = 20): LengthAwarePaginator
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

