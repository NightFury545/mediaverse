<?php

namespace App\Services\Social;

use App\Models\Comment;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentService
{
    /**
     * @throws Exception
     */
    public function create(array $data, $commentable): Comment
    {
        $this->ensureCanReceiveComments($commentable);

        $comment = Comment::create($this->prepareCommentData($data));
        $commentable->comments()->save($comment);

        return $comment;
    }

    public function update(Comment $comment, array $data): Comment
    {
        $data = $this->prepareCommentData($data, $comment);
        $comment->update($data);

        return $comment;
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }

    public function getComment(string $identifier): ?Comment
    {
        return Comment::with(['user', 'children', 'parent'])
            ->where('id', $identifier)
            ->first();
    }

    public function getComments(array $filters = [], array $sort = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = Comment::with('user');

        $this->applyFilters($query, $filters);
        $this->applySorting($query, $sort);

        return $query->paginate($perPage);
    }

    private function prepareCommentData(array $data, ?Comment $comment = null): array
    {
        return [
            'content' => $data['content'],
            'user_id' => $data['user_id'] ?? $comment?->user_id,
            'parent_id' => $data['parent_id'] ?? null,
            'likes_count' => $data['likes_count'] ?? $comment?->likes_count ?? 0,
        ];
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        collect($filters)->each(function ($value, $key) use ($query) {
            if (empty($value)) {
                return;
            }

            match ($key) {
                'user_id', 'parent_id' => $query->where($key, $value),
                'content' => $query->where($key, 'like', '%' . $value . '%'),
                'commentable' => $query->where('commentable_id', $value['id'] ?? null)
                    ->where('commentable_type', $value['type'] ?? null),
                default => null,
            };
        });
    }

    private function applySorting(Builder $query, array $sort): void
    {
        $allowedFields = ['created_at', 'likes_count'];

        if (!empty($sort['field']) && in_array($sort['field'], $allowedFields) && !empty($sort['direction'])) {
            $query->orderBy($sort['field'], $sort['direction']);
        } else {
            $query->latest();
        }
    }

    /**
     * @throws Exception
     */
    private function ensureCanReceiveComments($commentable): void
    {
        if (property_exists($commentable, 'comments_enabled') && !$commentable->comments_enabled) {
            throw new Exception('Коментарі вимкнені.');
        }
    }
}
