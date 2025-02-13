<?php

namespace App\Actions\Social\PostActions;

use App\Actions\Traits\ProcessesAttachments;
use App\Enums\PostVisibility;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;

class CreatePostAction
{
    use ProcessesAttachments;

    /**
     * Створює новий пост.
     *
     * @param array $data Дані поста (visibility, attachments, tags тощо).
     * @return Post Створений пост.
     * @throws Exception
     */
    public function __invoke(array $data): Post
    {
        DB::beginTransaction();

        try {
            $data['visibility'] = PostVisibility::from($data['visibility']);
            $data['attachments'] = $this->processAttachments($data['attachments'] ?? [], $data['visibility']->value);

            $post = Post::create($this->prepareCreatePostData($data));

            if (!empty($data['tags'])) {
                $this->syncTags($post, $data['tags']);
            }

            DB::commit();

            return $post;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час створення поста. Можлива проблема з базою даних або файлами.');
        }
    }

    /**
     * Готує дані для створення поста.
     *
     * @param array $data
     * @return array
     */
    private function prepareCreatePostData(array $data): array
    {
        return [
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'visibility' => $data['visibility']->value,
            'attachments' => $data['attachments'] ?? null,
            'comments_enabled' => $data['comments_enabled'] ?? true,
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
