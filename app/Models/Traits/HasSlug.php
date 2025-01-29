<?php

namespace App\Models\Traits;

use App\Models\Post;
use Exception;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (!$model->slug && $model->title) {
                $model->slug = $model->generateSlug($model->title);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = $model->generateSlug($model->title);
            }
        });
    }
    private function generateSlug(string $title): string
    {
        try {
            $slug = Str::slug($title);
            $existingSlugs = Post::where('slug', 'like', "$slug%")
                ->pluck('slug')
                ->toArray();

            if (!in_array($slug, $existingSlugs)) {
                return $slug;
            }

            $counter = 1;
            while (in_array("$slug-$counter", $existingSlugs)) {
                $counter++;
            }

            return "$slug-$counter";
        } catch (Exception $e) {
            throw new Exception('Помилка при генерації слагу. Можлива проблема з базою даних.');
        }
    }
}
