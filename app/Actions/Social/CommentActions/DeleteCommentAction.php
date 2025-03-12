<?php

namespace App\Actions\Social\CommentActions;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Exception;

class DeleteCommentAction
{
    /**
     * Видаляє переданий коментар з використанням транзакції та обробкою винятків.
     *
     * Цей метод видаляє конкретний коментар з бази даних в рамках транзакції. Якщо операція не вдається,
     * буде здійснено відкат транзакції, і буде викинуто виключення з повідомленням про помилку.
     *
     * @param Comment $comment Коментар, який необхідно видалити.
     * @return bool Повертає `true`, якщо видалення було успішним.
     * @throws Exception Якщо сталася помилка під час видалення коментаря.
     */
    public function __invoke(Comment $comment): bool
    {
        DB::beginTransaction();

        try {
            $comment->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception('Помилка під час видалення коментаря: ' . $e->getMessage());
        }
    }
}
