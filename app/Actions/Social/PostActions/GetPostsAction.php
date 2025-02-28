<?php

namespace App\Actions\Social\PostActions;

use App\Actions\Filters\RangeFilter;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class GetPostsAction
{
    /**
     * Отримує список постів з можливістю фільтрації, сортування та пагінації.
     *
     * @param int $perPage Кількість постів на сторінці
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function __invoke(int $perPage = 20): LengthAwarePaginator
    {
        try {
            $query = $this->buildBaseQuery();

            $this->applyFilters($query);

            $this->applySorting($query);

            return $query->paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання постів: ' . $e->getMessage());
        }
    }

    /**
     * Створює базовий запит для отримання постів.
     *
     * @return QueryBuilder
     */
    private function buildBaseQuery(): QueryBuilder
    {
        return QueryBuilder::for(Post::class)
            ->with(['user', 'tags']);
    }

    /**
     * Застосовує фільтрацію до запиту.
     *
     * @param QueryBuilder $query
     */
    private function applyFilters(QueryBuilder $query): void
    {
        $query->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('visibility'),
            AllowedFilter::exact('comments_enabled'),
            AllowedFilter::partial('title'),
            AllowedFilter::partial('content'),
            AllowedFilter::custom('likes_count', new RangeFilter()),
            AllowedFilter::custom('comments_count', new RangeFilter()),
            AllowedFilter::custom('views_count', new RangeFilter()),
            AllowedFilter::custom('updated_at', new RangeFilter()),
            AllowedFilter::custom('created_at', new RangeFilter()),
        ]);
    }

    /**
     * Застосовує сортування до запиту.
     *
     * @param QueryBuilder $query
     */
    private function applySorting(QueryBuilder $query): void
    {
        $query->allowedSorts(['created_at', 'likes_count', 'comments_count', 'views_count']);
    }

    /**
     * Застосовує логіку видимості до запиту.
     *
     * @param QueryBuilder $query
     */
    private function applyVisibility(QueryBuilder $query): void
    {
        $user = auth()->user();

        $query->where(function ($q) use ($user) {
            $q->where('posts.visibility', 'public');

            if ($user) {
                $q->orWhere('posts.user_id', $user->id);

                $q->orWhere(function ($subQuery) use ($user) {
                    $subQuery->where('posts.visibility', 'friends')
                        ->whereHas('user.friends', function ($friendQuery) use ($user) {
                            $friendQuery->where('users.id', $user->id);
                        });
                });
            }
        });
    }
}
