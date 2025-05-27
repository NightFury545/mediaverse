<?php

namespace App\Actions\Social\FriendshipActions;

use App\Models\User;
use App\Actions\Filters\RangeFilter;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class GetFriendsAction
{
    /**
     * Отримує список друзів користувача з фільтрацією, сортуванням та пагінацією.
     *
     * @param User $user Користувач, для якого потрібно отримати список друзів
     * @param int $perPage Кількість елементів на сторінці для пагінації
     * @return LengthAwarePaginator Пагінований список друзів
     */
    public function __invoke(User $user, int $perPage = 20): LengthAwarePaginator
    {
        return $this->applyPagination(
            $this->applySorting(
                $this->applyFilters($user->friends())
            ),
            $perPage
        );
    }

    /**
     * Застосовує фільтри до запиту.
     *
     * @param BelongsToMany $query Запит для відношення між користувачами (друзі)
     * @return QueryBuilder Оброблений запит з дозволеними фільтрами
     */
    private function applyFilters(BelongsToMany $query): QueryBuilder
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

    /**
     * Застосовує сортування до запиту.
     *
     * @param QueryBuilder $query Запит, до якого буде застосоване сортування
     * @return QueryBuilder Оброблений запит з дозволеними варіантами сортування
     */
    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'username',
            'first_name',
            'last_name',
            'birthday',
        ]);
    }

    /**
     * Застосовує пагінацію до запиту.
     *
     * @param QueryBuilder $query Запит, до якого буде застосована пагінація
     * @param int $perPage Кількість елементів на сторінці для пагінації
     * @return LengthAwarePaginator Пагінований результат
     */
    private function applyPagination(QueryBuilder $query, int $perPage): LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }
}
