<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasUuids;

    protected $fillable = [
        'chat_id',
        'user_id',
        'content',
        'attachments',
        'is_read',
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_read' => 'boolean',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
