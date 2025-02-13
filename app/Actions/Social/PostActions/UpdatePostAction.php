<?php

namespace App\Actions\Social\PostActions;

use App\Actions\Traits\ProcessesAttachments;
use App\Enums\PostVisibility;
use App\Models\Post;
use App\Models\Tag;
use Exception;

class UpdatePostAction
{
    use ProcessesAttachments;

    /**
     * @throws Exception
     */
    public function __invoke(Post $post, array $data): Post
    {
        try {
            $data['visibility'] = PostVisibility::from($data['visibility']);

            if (isset($data['attachments'])) {
                $data['attachments'] = $this->processAttachments($data['attachments'], $data['visibility']->value);
            } else {
                $data['attachments'] = $post->attachments;
            }

            $post->update($this->prepareUpdatePostData($data, $post));

            if (!empty($data['tags'])) {
                $this->syncTags($post, $data['tags']);
            }

            return $post;
        } catch (Exception $e) {
            throw new Exception('Помилка під час оновлення поста. Можлива проблема з базою даних або файлами.');
        }
    }

    /**
     * Підготовка даних для оновлення поста.
     *
     * @param array $data
     * @param Post $post
     * @return array
     */
    private function prepareUpdatePostData(array $data, Post $post): array
    {
        return [
            'title' => $data['title'] ?? $post->title,
            'content' => $data['content'] ?? $post->content,
            'visibility' => $data['visibility'] ?? $post->visibility->value,
            'attachments' => $data['attachments'] ?? $post->attachments,
            'comments_enabled' => $data['comments_enabled'] ?? $post->comments_enabled,
        ];
    }

    private function syncTags(Post $post, array $tags): void
    {
        $tagIds = Tag::whereIn('name', $tags)->pluck('id', 'name');

        $newTags = collect($tags)->diff($tagIds->keys())->mapWithKeys(
            fn($tag) => [Tag::create(['name' => $tag])->id => $tag]
        );

        $post->tags()->sync($tagIds->merge($newTags)->keys());
    }
}
