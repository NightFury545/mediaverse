<?php

namespace App\Actions\Social\CommentActions;

use App\Actions\Filters\RangeFilter;
use App\Models\Movie;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetCommentsAction
{
    /**
     * Отримує список коментарів для заданого ресурсу з фільтрацією, сортуванням та пагінацією.
     *
     * @param Movie|Post $commentable Об'єкт, який підтримує коментарі (наприклад, Post, Movie)
     * @param int $perPage Кількість коментарів на сторінку
     * @return LengthAwarePaginator Пагінований список коментарів
     * @throws Exception
     */
    public function __invoke(Movie|Post $commentable, int $perPage = 20): LengthAwarePaginator
    {
        try {
            $this->checkVisibility($commentable);

            return $this->applyPagination(
                $this->applySorting(
                    $this->applyFilters($commentable->comments()->with(['user:id,username,first_name,last_name,avatar'])
                    )
                ),
                $perPage
            );
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання коментарів: ' . $e->getMessage());
        }
    }

    /**
     * Застосовує фільтри до запиту коментарів.
     *
     * @param MorphMany $query Запит до коментарів
     * @return QueryBuilder Оброблений запит з дозволеними фільтрами
     */
    private function applyFilters(MorphMany $query): QueryBuilder
    {
        return QueryBuilder::for(
            $query->whereNull('parent_id')
        )->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::partial('content'),
            AllowedFilter::custom('created_at', new RangeFilter()),
            AllowedFilter::custom('likes_count', new RangeFilter()),
        ]);
    }

    /**
     * Застосовує сортування до запиту коментарів.
     *
     * @param QueryBuilder $query Запит, до якого буде застосоване сортування
     * @return QueryBuilder Оброблений запит з дозволеними варіантами сортування
     */
    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'created_at',
            'likes_count',
        ]);
    }

    /**
     * Застосовує пагінацію до запиту коментарів.
     *
     * @param QueryBuilder $query Запит, до якого буде застосована пагінація
     * @param int $perPage Кількість елементів на сторінці для пагінації
     * @return LengthAwarePaginator Пагінований результат
     */
    private function applyPagination(QueryBuilder $query, int $perPage): LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }

    /**
     * Перевіряє, чи користувач має доступ до перегляду коментарів цієї сутності.
     *
     * @param Movie|Post $commentable
     * @throws Exception
     */
    private function checkVisibility(Movie|Post $commentable): void
    {
        /** @var User $user */
        $user = Auth::user();

        if (!property_exists($commentable, 'visibility') || !property_exists($commentable, 'user_id')) {
            return;
        }

        switch ($commentable->visibility) {
            case 'private':
                if ($commentable->user_id !== $user->id) {
                    throw new Exception('Тільки власник може переглядати коментарі.');
                }
                break;

            case 'friends':
                if ($commentable->user_id !== $user->id && !$user->isFriendWith($commentable->user_id)) {
                    throw new Exception('Коментарі можуть переглядати лише друзі власника.');
                }
                break;
        }
    }
}
