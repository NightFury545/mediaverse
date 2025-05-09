<?php

namespace App\Actions\Social\LikeActions;

use App\Actions\Filters\RangeFilter;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetUserLikesAction
{
    /**
     * Отримує всі лайки поточного користувача з фільтрацією та сортуванням.
     *
     * @return Collection
     * @throws Exception
     */
    public function __invoke(): Collection
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            $query = QueryBuilder::for($user->likes()->with(['likeable']));

            return $this->applySorting(
                $this->applyFilters($query)
            )->get()->map(function ($like) {
                return [
                    'id' => $like->id,
                    'likeable_type' => $like->likeable_type,
                    'likeable_id' => $like->likeable_id,
                    'created_at' => $like->created_at->toISOString(),
                    'likeable' => $this->formatLikeable($like->likeable),
                ];
            });
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання лайків користувача.');
        }
    }

    /**
     * Застосовує фільтри до запиту лайків.
     *
     * @param QueryBuilder $query Запит до лайків
     * @return QueryBuilder
     */
    private function applyFilters(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedFilters([
            AllowedFilter::partial('likeable_type'),
            AllowedFilter::custom('created_at', new RangeFilter()),
            AllowedFilter::exact('likeable_id'),
        ]);
    }

    /**
     * Застосовує сортування до запиту лайків.
     *
     * @param QueryBuilder $query
     * @return QueryBuilder
     */
    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'created_at',
            'likeable_type',
        ]);
    }

    /**
     * Форматує пов’язаний об’єкт (likeable) для включення у відповідь.
     *
     * @param mixed $likeable Пов’язаний об’єкт (Post, Movie, Comment)
     * @return array|null
     */
    private function formatLikeable(mixed $likeable): ?array
    {
        if (!$likeable) {
            return null;
        }

        if ($likeable instanceof Post) {
            return [
                'id' => $likeable->id,
                'title' => $likeable->title,
                'slug' => $likeable->slug,
                'type' => 'post',
            ];
        }

        if ($likeable instanceof Movie) {
            return [
                'id' => $likeable->id,
                'title' => $likeable->title,
                'type' => 'movie',
            ];
        }

        if ($likeable instanceof Comment) {
            return [
                'id' => $likeable->id,
                'content' => substr($likeable->content, 0, 50) . '...',
                'type' => 'comment',
            ];
        }

        return null;
    }
}
