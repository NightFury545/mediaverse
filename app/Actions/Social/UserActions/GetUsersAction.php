<?php

namespace App\Actions\Social\UserActions;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Actions\Filters\RangeFilter;

class GetUsersAction
{
    public function __invoke(int $perPage = 20): LengthAwarePaginator
    {
        return $this->applyPagination(
            $this->applySorting(
                $this->applyFilters(QueryBuilder::for(User::class))
            ),
            $perPage
        );
    }

    private function applyFilters(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedFilters([
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
