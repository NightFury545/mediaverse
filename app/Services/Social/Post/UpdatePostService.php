<?php

namespace App\Services\Social\Post;

use App\Enums\PostVisibility;
use App\Models\Post;
use App\Services\Social\Post\Traits\HasAttachments;
use App\Services\Social\Post\Traits\HasTags;
use App\Services\Social\Post\Traits\PreparesPostData;
use Exception;

class UpdatePostService
{
    use HasAttachments, HasTags, PreparesPostData;

    public function execute(Post $post, array $data): Post
    {
        try {
            $data['visibility'] = PostVisibility::from($data['visibility']);

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $data['attachments'] = $this->processAttachments($data['attachments'], $data['visibility']);
            } elseif ($data['visibility'] !== $post->visibility) {
                $data['attachments'] = $this->updateAttachmentsVisibility(
                    json_decode($post->attachments, true) ?? [],
                    $data['visibility']
                );
            } else {
                $data['attachments'] = $post->attachments;
            }

            $post->update($this->preparePostData($data, $post));

            if (!empty($data['tags'])) {
                $this->syncTags($post, $data['tags']);
            }

            return $post;
        } catch (Exception $e) {
            throw new Exception('Помилка під час оновлення поста. Можлива проблема з базою даних або файлами.');
        }
    }
}
