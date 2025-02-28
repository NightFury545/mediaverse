<?php

namespace App\Actions\Social\MessageActions;

use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Exception;

class DeleteMessageAction
{
    /**
     * Видаляє передане повідомлення з використанням транзакції та обробкою винятків.
     *
     * @param Message $message
     * @return bool
     * @throws Exception
     */
    public function execute(Message $message): bool
    {
        DB::beginTransaction();

        try {
            $message->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception('Помилка під час видалення повідомлення: ' . $e->getMessage());
        }
    }
}
