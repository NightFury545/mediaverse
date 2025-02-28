<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\Friendship;
use Exception;
use Illuminate\Support\Facades\DB;

class RejectFriendRequestAction
{
    /**
     * Відхиляє запит на дружбу.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    public function __invoke(Friendship $friendship): void
    {
        DB::beginTransaction();

        try {
            $this->ensureCanReject($friendship);

            $friendship->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час відхилення запиту: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє, чи можна відхилити запит.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    private function ensureCanReject(Friendship $friendship): void
    {
        if ($friendship->status !== 'pending') {
            throw new Exception('Цей запит не можна відхилити.');
        }
    }
}
