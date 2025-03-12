<?php

namespace App\Notifications\Social\Comment;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentRepliedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Comment $reply;
    protected User $replier;

    /**
     * Створює новий екземпляр сповіщення.
     *
     * @param Comment $reply Відповідь на коментар
     */
    public function __construct(Comment $reply)
    {
        $this->reply = $reply;
        $this->replier = $reply->user;
    }

    /**
     * Канали доставки сповіщення.
     *
     * @param object $notifiable
     * @return array
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Отримати представлення сповіщення для збереження в БД.
     *
     * @param object $notifiable
     * @return array
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'comment_id' => $this->reply->id,
            'entity_id' => $this->reply->commentable->id,
            'entity_type' => class_basename($this->reply->commentable_type),
            'replier_id' => $this->replier->id,
            'replier_username' => $this->replier->username,
            'content' => $this->reply->content,
        ];
    }

    /**
     * Отримати представлення сповіщення для Email.
     *
     * @param object $notifiable
     * @return MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Вам відповіли на коментар')
            ->greeting("Привіт, {$notifiable->username}!")
            ->line("{$this->replier->username} відповів(ла) на ваш коментар:")
            ->line("\"{$this->reply->content}\"")
            ->action('Переглянути відповідь', url("/comments/{$this->reply->id}"))
            ->line('Дякуємо, що ви з нами!');
    }

    /**
     * Отримати представлення сповіщення для трансляції через WebSockets.
     *
     * @param object $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'comment_id' => $this->reply->id,
            'entity_id' => $this->reply->commentable->id,
            'entity_type' => class_basename($this->reply->commentable_type),
            'replier_id' => $this->replier->id,
            'replier_username' => $this->replier->username,
            'content' => $this->reply->content,
        ]);
    }
}
