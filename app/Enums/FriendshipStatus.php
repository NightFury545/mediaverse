<?php

namespace App\Enums;

enum FriendshipStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case DECLINED = 'declined';

    public static function getValues(): array
    {
        return array_map(fn($item) => $item->value, FriendshipStatus::cases());
    }
}
