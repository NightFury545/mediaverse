<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\Friendship;
use Exception;
use Illuminate\Support\Facades\DB;

class RemoveFriendAction
{
    /**
     * Видаляє друга зі списку.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    public function __invoke(Friendship $friendship): void
    {
        DB::beginTransaction();

        try {
            $this->ensureCanRemove($friendship);

            $friendship->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час видалення друга: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє, чи можна видалити друга.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    private function ensureCanRemove(Friendship $friendship): void
    {
        if ($friendship->status !== 'accepted') {
            throw new Exception('Цей користувач не є вашим другом.');
        }
    }
}
