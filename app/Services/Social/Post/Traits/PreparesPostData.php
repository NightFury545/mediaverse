<?php

namespace App\Services\Social\Post\Traits;

use App\Models\Post;

trait PreparesPostData
{
    private function preparePostData(array $data, ?Post $post = null): array
    {
        return [
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->id(),
            'attachments' => $data['attachments'] ?? $post?->attachments,
            'slug' => $data['slug'],
            'visibility' => $data['visibility']->value,
        ];
    }
}
