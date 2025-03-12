<?php

namespace App\Notifications\Social\Post;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Comment $comment;
    protected User $commenter;

    /**
     * Створює новий екземпляр сповіщення.
     *
     * @param Comment $comment Коментар, через який виникло сповіщення
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->commenter = $comment->user;
    }

    /**
     * Вказує, через які канали надсилати сповіщення.
     *
     * @param object $notifiable
     * @return array
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Отримує представлення сповіщення для каналу Email.
     *
     * @param object $notifiable
     * @return MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Новий коментар до вашого поста')
            ->greeting("Привіт, {$notifiable->username}!")
            ->line("{$this->commenter->username} залишив коментар до вашого поста.")
            ->line("\"{$this->comment->content}\"")
            ->action('Переглянути коментар', url("/posts/{$this->comment->commentable->id}"))
            ->line('Дякуємо за вашу активність у нашій спільноті!');
    }

    /**
     * Отримує представлення сповіщення для збереження в базі даних.
     *
     * @param object $notifiable
     * @return array
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'post_id' => $this->comment->commentable->id,
            'comment_id' => $this->comment->id,
            'commenter_id' => $this->commenter->id,
            'commenter_username' => $this->commenter->username,
            'content' => $this->comment->content,
        ];
    }

    /**
     * Отримує представлення сповіщення для трансляції через WebSockets.
     *
     * @param object $notifiable
     * @return array
     */
    public function toBroadcast(object $notifiable): array
    {
        return [
            'post_id' => $this->comment->commentable->id,
            'comment_id' => $this->comment->id,
            'commenter_id' => $this->commenter->id,
            'commenter_username' => $this->commenter->username,
            'content' => $this->comment->content,
        ];
    }
}
