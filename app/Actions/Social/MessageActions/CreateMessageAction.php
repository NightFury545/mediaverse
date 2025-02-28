<?php

namespace App\Actions\Social\MessageActions;

use App\Actions\Social\ChatActions\UpdateChatAction;
use App\Actions\Traits\ProcessesAttachments;
use App\Events\Social\Chat\MessageSentEvent;
use App\Models\Message;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateMessageAction
{
    use ProcessesAttachments;

    public function __construct(private UpdateChatAction $updateChatAction)
    {
    }

    /**
     * Створює нове повідомлення в чаті.
     *
     * @param array $data Дані для створення повідомлення (chat_id, content, attachments)
     * @return Message
     * @throws Exception
     */
    public function __invoke(array $data): Message
    {
        DB::beginTransaction();

        try {
            $attachments = $this->processAttachments($data['attachments'] ?? [], 'private');

            $message = $this->createMessage($data, $attachments);

            ($this->updateChatAction)($message->chat, [
                'last_message' => $message->content,
            ]);

            broadcast(new MessageSentEvent($message));

            DB::commit();

            return $message;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час створення повідомлення: ' . $e->getMessage());
        }
    }

    /**
     * Створює нове повідомлення.
     *
     * @param array $data
     * @param string|null $attachments
     * @return Message
     */
    private function createMessage(array $data, ?string $attachments): Message
    {
        return Message::create([
            'chat_id' => $data['chat_id'],
            'user_id' => Auth::user()->id,
            'content' => $data['content'],
            'attachments' => $attachments,
            'is_read' => false,
        ]);
    }
}
