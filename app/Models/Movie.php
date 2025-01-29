<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'release_date',
        'runtime',
        'poster_path',
        'backdrop_path',
        'rating_api',
        'rating_user',
        'director_id',
    ];

    /**
     * Зв'язок з таблицею Director (1 до 1).
     */
    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    /**
     * Зв'язок з таблицею Actor (багато до багатьох).
     */
    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    /**
     * Зв'язок з таблицею Genre (багато до багатьох).
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    /**
     * Зв'язок з таблицею Category (багато до багатьох).
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_movie');
    }
}

