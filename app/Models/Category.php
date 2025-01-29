<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Зв'язок з таблицею Movie (багато до багатьох).
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'category_movie');
    }
}

