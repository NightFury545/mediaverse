<?php

namespace App\Services\Social\Post;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class GetPostsService
{
    public function execute(array $filters = [], array $sort = [], int $perPage = 20): LengthAwarePaginator
    {
        try {
            $query = Post::with(['user', 'tags']);

            $this->applyFilters($query, $filters);

            $this->applyVisibility($query);

            $this->applySorting($query, $sort);

            return $query->paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання постів. Можлива проблема з фільтрацією або сортуванням.');
        }
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        try {
            $exactFilters = [
                'user_id' => 'user_id',
                'visibility' => 'visibility',
                'comments_enabled' => 'comments_enabled',
            ];

            foreach ($exactFilters as $filterKey => $column) {
                if (!empty($filters[$filterKey])) {
                    $query->where($column, $filters[$filterKey]);
                }
            }

            $rangeFilters = [
                'likes' => 'likes_count',
                'comments' => 'comments_count',
                'reports' => 'reports_count',
                'views' => 'views_count',
            ];

            foreach ($rangeFilters as $filterKey => $column) {
                if (!empty($filters["{$filterKey}_min"])) {
                    $query->where($column, '>=', $filters["{$filterKey}_min"]);
                }
                if (!empty($filters["{$filterKey}_max"])) {
                    $query->where($column, '<=', $filters["{$filterKey}_max"]);
                }
            }

            if (!empty($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('title', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('content', 'like', '%' . $filters['search'] . '%');
                });
            }
        } catch (Exception $e) {
            throw new Exception('Помилка при застосуванні фільтрів до запиту.');
        }
    }

    private function applySorting(Builder $query, array $sort): void
    {
        try {
            $allowedFields = ['created_at', 'likes_count', 'comments_count', 'views_count'];

            if (!empty($sort['field']) && in_array($sort['field'], $allowedFields) && !empty($sort['direction'])) {
                $query->orderBy($sort['field'], $sort['direction']);
            } else {
                $query->latest();
            }
        } catch (Exception $e) {
            throw new Exception('Помилка при сортуванні запиту.');
        }
    }

    private function applyVisibility(Builder $query): void
    {
        $user = auth()->user();

        $query->where(function ($q) use ($user) {
            $q->where('visibility', 'public');

            if ($user) {
                $q->orWhere('user_id', $user->id)
                    ->orWhere(function ($subQuery) use ($user) {
                        $subQuery->where('visibility', 'friends')
                            ->whereHas('user.friends', function ($friendQuery) use ($user) {
                                $friendQuery->where('id', $user->id);
                            });
                    });
            }
        });
    }
}
