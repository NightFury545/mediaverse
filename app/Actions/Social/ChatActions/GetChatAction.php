<?php

namespace App\Actions\Social\ChatActions;

use App\Models\Chat;
use Exception;

class GetChatAction
{
    /**
     * Отримує чат за його ID разом з останніми 10 повідомленнями.
     * Завантажує лише необхідні поля.
     *
     * @param string $chatId Ідентифікатор чату
     * @return Chat
     * @throws Exception
     */
    public function __invoke(string $chatId): Chat
    {
        $chat = Chat::with([
            'userOne:id,username,avatar,is_online,last_seen_at',
            'userTwo:id,username,avatar,is_online,last_seen_at',
            'messages' => function ($query) {
                $query->latest()->limit(10);
            }
        ])->find($chatId);

        if (!$chat) {
            throw new Exception('Чат не знайдено.');
        }

        return $chat;
    }
}
