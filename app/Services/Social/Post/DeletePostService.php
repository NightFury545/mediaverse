<?php

namespace App\Services\Social\Post;

use App\Models\Post;
use App\Services\Social\Post\Traits\HasAttachments;
use Exception;

class DeletePostService
{
    use HasAttachments;

    public function execute(Post $post): void
    {
        try {
            $this->deleteAttachments($post->attachments);
            $post->delete();
        } catch (Exception $e) {
            throw new Exception('Помилка під час видалення поста. Можлива проблема з файлами або базою даних.');
        }
    }
}
