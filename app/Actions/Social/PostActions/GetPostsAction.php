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
    public function __invoke(int $perPage = 20): LengthAwarePaginator
    {
        try {
            $query = QueryBuilder::for(Post::class)
                ->with(['user', 'tags']);

            $this->applyVisibility($query);

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
            ])
                ->allowedSorts(['created_at', 'likes_count', 'comments_count', 'views_count']);

            return $query->paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання постів: ' . $e->getMessage());
        }
    }

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
