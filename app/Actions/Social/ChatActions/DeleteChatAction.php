<?php

namespace App\Actions\Social\ChatActions;

use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use Exception;

class DeleteChatAction
{
    /**
     * Видаляє переданий чат.
     *
     * @param Chat $chat Об'єкт чату
     * @throws Exception
     */
    public function __invoke(Chat $chat): void
    {
        DB::beginTransaction();

        try {
            $chat->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час видалення чату: ' . $e->getMessage());
        }
    }
}
