<?php

namespace App\Actions\Social\MessageActions;

use App\Events\Social\Chat\MessageUpdatedEvent;
use App\Models\Message;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateMessageAction
{
    /**
     * Оновлює повідомлення з новими даними.
     *
     * @param Message $message Повідомлення, яке потрібно оновити
     * @param array $data Дані для оновлення (наприклад, 'content', 'attachments', 'is_read')
     * @return Message Оновлене повідомлення
     * @throws Exception
     */
    public function __invoke(Message $message, array $data): Message
    {
        DB::beginTransaction();

        try {
            $this->updateMessage($message, $data);

            broadcast(new MessageUpdatedEvent($message));

            DB::commit();

            return $message;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Не вдалося оновити повідомлення: ' . $e->getMessage());
        }
    }

    /**
     * Оновлює повідомлення з новими даними.
     *
     * @param Message $message
     * @param array $data
     * @return void
     */
    private function updateMessage(Message $message, array $data): void
    {
        $message->update($this->prepareUpdateMessageData($message, $data));
    }

    /**
     * Готує дані для оновлення повідомлення.
     *
     * @param Message $message
     * @param array $data
     * @return array
     */
    private function prepareUpdateMessageData(Message $message, array $data): array
    {
        return [
            'content' => $data['content'] ?? $message->content,
            'attachments' => $data['attachments'] ?? $message->attachments,
            'is_read' => $data['is_read'] ?? $message->is_read,
        ];
    }
}
