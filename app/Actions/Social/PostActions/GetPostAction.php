<?php

namespace App\Actions\Social\PostActions;

use App\Models\Post;
use App\Models\PostView;
use Exception;

class GetPostAction
{
    /**
     * @throws Exception
     */
    public function __invoke(string $identifier): ?Post
    {
        try {
            $post = $this->findPostByIdentifier($identifier);

            if ($post && auth()->check()) {
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
