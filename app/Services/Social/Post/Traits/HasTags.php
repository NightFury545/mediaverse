<?php

namespace App\Services\Social\Post\Traits;

use App\Models\Post;
use App\Models\Tag;
use Exception;

trait HasTags
{
    private function syncTags(Post $post, array $tags): void
    {
        try {
            $tagIds = collect($tags)->map(function ($tag) {
                return Tag::firstOrCreate(['name' => $tag])->id;
            });

            $post->tags()->sync($tagIds);
        } catch (Exception $e) {
            throw new Exception('Помилка при синхронізації тегів з постом.');
        }
    }
}
