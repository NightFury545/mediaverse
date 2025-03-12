<?php

namespace App\Actions\Social\PostActions;

use App\Models\Post;
use App\Models\PostView;
use Exception;

class GetPostAction
{
    /**
     * Отримує пост за заданим ідентифікатором та обробляє перегляд поста для зареєстрованого користувача.
     * Якщо користувач ще не переглядав цей пост, записується новий перегляд та збільшується лічильник переглядів.
     *
     * @param string $identifier Ідентифікатор поста (ID або slug)
     * @return Post|null Повертає пост, якщо він знайдений, або null, якщо пост не існує
     * @throws Exception Якщо виникла помилка під час отримання поста з бази даних або під час обробки доступу
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

    /**
     * Знаходить пост за ідентифікатором (ID або slug).
     *
     * @param string $identifier Ідентифікатор поста
     * @return Post|null Повертає пост, якщо знайдений, або null
     */
    private function findPostByIdentifier(string $identifier): ?Post
    {
        return Post::with(['user', 'tags'])
            ->where(function ($query) use ($identifier) {
                $query->where('id', $identifier)
                    ->orWhere('slug', $identifier);
            })
            ->first();
    }

    /**
     * Обробляє перегляд поста для авторизованого користувача, якщо це перший перегляд.
     * Якщо пост ще не був переглянутий користувачем, зберігається новий перегляд та збільшується лічильник переглядів.
     *
     * @param Post $post Пост, який переглядається
     * @return void
     */
    private function handlePostView(Post $post): void
    {
        $user = auth()->user();

        if (!$this->hasUserViewedPost($post->id, $user->id)) {
            $this->recordPostView($post->id, $user->id);
            $post->increment('views_count');
        }
    }

    /**
     * Перевіряє, чи користувач вже переглядав пост.
     *
     * @param int $postId Ідентифікатор поста
     * @param int $userId Ідентифікатор користувача
     * @return bool true, якщо пост вже був переглянутий користувачем
     */
    private function hasUserViewedPost(int $postId, int $userId): bool
    {
        return PostView::where('post_id', $postId)
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Записує новий перегляд поста для користувача.
     *
     * @param int $postId Ідентифікатор поста
     * @param int $userId Ідентифікатор користувача
     * @return void
     */
    private function recordPostView(int $postId, int $userId): void
    {
        PostView::create([
            'post_id' => $postId,
            'user_id' => $userId,
            'viewed_at' => now(),
        ]);
    }
}
