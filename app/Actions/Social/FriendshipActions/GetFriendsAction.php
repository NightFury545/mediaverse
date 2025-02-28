<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\User;
use App\Actions\Filters\RangeFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class GetFriendsAction
{
    public function __invoke(User $user, int $perPage = 20): LengthAwarePaginator
    {
        return $this->applyPagination(
            $this->applySorting(
                $this->applyFilters($user->friends())
            ),
            $perPage
        );
    }

    private function applyFilters($query): QueryBuilder
    {
        return QueryBuilder::for($query)->allowedFilters([
            AllowedFilter::exact('country'),
            AllowedFilter::exact('gender'),
            AllowedFilter::exact('is_online'),
            AllowedFilter::custom('birthday', new RangeFilter()),
            AllowedFilter::partial('username'),
            AllowedFilter::partial('first_name'),
            AllowedFilter::partial('last_name'),
        ]);
    }

    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'username',
            'first_name',
            'last_name',
            'birthday',
        ]);
    }

    private function applyPagination(QueryBuilder $query, int $perPage): LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }
}
