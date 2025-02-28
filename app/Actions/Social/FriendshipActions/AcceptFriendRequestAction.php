<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\Friendship;
use Exception;
use Illuminate\Support\Facades\DB;

class AcceptFriendRequestAction
{
    /**
     * Приймає запит на дружбу.
     *
     * @param Friendship $friendship
     * @return Friendship
     * @throws Exception
     */
    public function __invoke(Friendship $friendship): Friendship
    {
        DB::beginTransaction();

        try {
            $this->ensureCanAccept($friendship);

            $friendship->update(['status' => 'accepted']);

            DB::commit();

            return $friendship;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час прийняття запиту: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє, чи можна прийняти запит.
     *
     * @param Friendship $friendship
     * @throws Exception
     */
    private function ensureCanAccept(Friendship $friendship): void
    {
        if ($friendship->status !== 'pending') {
            throw new Exception('Цей запит не можна прийняти.');
        }
    }
}
