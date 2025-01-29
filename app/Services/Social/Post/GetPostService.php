<?php

namespace App\Services\Social\Post;

use App\Models\Post;
use App\Models\PostView;
use Exception;

class GetPostService
{public function execute(string $identifier): ?Post
{
    try {
        $post = $this->findPostByIdentifier($identifier);

        if ($post && $this->isUserAuthenticated()) {
            $this->handlePostView($post);
        }

        return $post;
    } catch (Exception $e) {
        throw new Exception(
            'Помилка під час отримання поста. Можлива проблема з базою даних або доступом до поста.'
        );
    }
}

    private function findPostByIdentifier(string $identifier): ?Post
    {
        return Post::with(['user', 'tags'])
            ->where(function ($query) use ($identifier) {
                $query->where('id', $identifier)
                    ->orWhere('slug', $identifier);
            })
            ->first();
    }

    private function isUserAuthenticated(): bool
    {
        return auth()->check();
    }

    private function handlePostView(Post $post): void
    {
        $user = auth()->user();

        if (!$this->hasUserViewedPost($post->id, $user->id)) {
            $this->recordPostView($post->id, $user->id);
            $post->increment('views_count');
        }
    }

    private function hasUserViewedPost(int $postId, int $userId): bool
    {
        return PostView::where('post_id', $postId)
            ->where('user_id', $userId)
            ->exists();
    }

    private function recordPostView(int $postId, int $userId): void
    {
        PostView::create([
            'post_id' => $postId,
            'user_id' => $userId,
            'viewed_at' => now(),
        ]);
    }
}
