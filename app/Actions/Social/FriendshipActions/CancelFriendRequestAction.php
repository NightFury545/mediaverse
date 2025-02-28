<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\Friendship;
use Exception;
use Illuminate\Support\Facades\DB;

class CancelFriendRequestAction
{
    /**
     * Скасовує відправлений запит на дружбу.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    public function __invoke(Friendship $friendship): void
    {
        DB::beginTransaction();

        try {
            $this->ensureCanCancel($friendship);

            $friendship->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час скасування запиту: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє, чи можна скасувати запит.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    private function ensureCanCancel(Friendship $friendship): void
    {
        if ($friendship->status !== 'pending') {
            throw new Exception('Цей запит вже оброблено і не може бути скасований.');
        }
    }
}
