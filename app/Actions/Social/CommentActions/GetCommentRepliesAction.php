<?php

namespace App\Actions\Social\CommentActions;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Actions\Filters\RangeFilter;
use Exception;

class GetCommentRepliesAction
{
    /**
     * Отримує відповіді на певний коментар.
     *
     * @param Comment $comment Батьківський коментар
     * @param int $perPage Кількість відповідей на сторінку
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function __invoke(Comment $comment, int $perPage = 20): LengthAwarePaginator
    {
        $this->checkVisibility($comment);

        return $this->applyPagination(
            $this->applySorting(
                $this->applyFilters(
                    $comment->children()->with(['user:id,username,first_name,last_name,avatar'])
                )
            ),
            $perPage
        );
    }

    private function applyFilters($query): QueryBuilder
    {
        return QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::partial('content'),
                AllowedFilter::custom('created_at', new RangeFilter()),
                AllowedFilter::custom('likes_count', new RangeFilter()),
            ]);
    }

    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'created_at',
            'likes_count',
        ]);
    }

    private function applyPagination(QueryBuilder $query, int $perPage): LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }

    /**
     * Перевіряє, чи користувач має доступ до перегляду відповідей.
     *
     * @param Comment $comment
     * @throws Exception
     */
    private function checkVisibility(Comment $comment): void
    {
        /** @var User $user */
        $user = Auth::user();

        $commentable = $comment->commentable;

        if (!Schema::hasColumn($commentable->getTable(), 'visibility') || !Schema::hasColumn($commentable->getTable(), 'user_id')) {
            return;
        }

        switch ($commentable->visibility) {
            case 'private':
                if ($commentable->user_id !== $user->id) {
                    throw new Exception('Тільки власник може переглядати відповіді.');
                }
                break;

            case 'friends':
                if ($commentable->user_id !== $user->id && !$user->isFriendWith($commentable->user_id)) {
                    throw new Exception('Відповіді можуть переглядати лише друзі власника.');
                }
                break;
        }
    }
}
