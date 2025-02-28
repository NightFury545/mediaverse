<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class GetReceivedFriendRequestsAction
{
    public function __invoke(User $user, int $perPage = 20): LengthAwarePaginator
    {
        return $this->applyPagination(
            $this->applySorting(
                QueryBuilder::for($user->receivedFriendRequests())
            ),
            $perPage
        );
    }

    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'created_at',
        ]);
    }

    private function applyPagination(QueryBuilder $query, int $perPage): LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }
}
