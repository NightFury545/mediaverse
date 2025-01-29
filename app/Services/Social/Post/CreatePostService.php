<?php

namespace App\Services\Social\Post;

use App\Enums\PostVisibility;
use App\Models\Post;
use App\Services\Social\Post\Traits\HasAttachments;
use App\Services\Social\Post\Traits\HasTags;
use App\Services\Social\Post\Traits\PreparesPostData;
use Exception;

class CreatePostService
{
    use HasAttachments, HasTags, PreparesPostData;

    public function execute(array $data): Post
    {
        try {
            $data['visibility'] = PostVisibility::from($data['visibility']);
            $data['attachments'] = $this->processAttachments($data['attachments'] ?? [], $data['visibility']);

            $post = Post::create($this->preparePostData($data));

            if (!empty($data['tags'])) {
                $this->syncTags($post, $data['tags']);
            }

            return $post;
        } catch (Exception $e) {
            throw new Exception('Помилка під час створення поста. Можлива проблема з базою даних або файлами.');
        }
    }
}
