<?php

namespace App\Actions\Social\PostActions;

use App\Models\Post;
use Exception;

class DeletePostAction
{
    /**
     * Викликається для видалення поста.
     *
     * @param Post $post
     * @return bool
     * @throws Exception
     */
    public function __invoke(Post $post): bool
    {
        try {
            $post->delete();
            return true;
        } catch (Exception $e) {
            throw new Exception('Помилка під час видалення поста. Можлива проблема з файлами або базою даних.');
        }
    }
}
