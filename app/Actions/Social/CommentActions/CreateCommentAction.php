<?php

namespace App\Actions\Social\CommentActions;

use App\Enums\NotificationType;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\Post;
use App\Models\User;
use App\Notifications\Social\Comment\CommentRepliedNotification;
use App\Notifications\Social\Post\PostCommentedNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateCommentAction
{
    /**
     * Створює новий коментар.
     * Виконується перевірка всіх необхідних умов для створення коментаря, а також обробка транзакцій.
     *
     * @param array $data Дані коментаря, що містять необхідні параметри
     * @param Movie|Post $commentable Об'єкт, до якого буде прив'язаний коментар (наприклад, пост, фільм)
     * @return Comment Створений коментар
     * @throws Exception Викидається, якщо трапилась помилка під час створення коментаря або коміт транзакції не вдалий
     */
    public function __invoke(array $data, Movie|Post $commentable): Comment
    {
        DB::beginTransaction();

        try {
            $this->ensureCanReceiveComments($commentable);

            $commentData = $this->prepareCommentData($data);

            $comment = Comment::create($commentData);

            $commentable->comments()->save($comment);

            $this->sendCommentNotificationIfEnabled($commentable, $comment);

            $this->sendReplyNotificationIfEnabled($comment);

            DB::commit();

            return $comment;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Помилка під час створення коментаря: ' . $e->getMessage());
        }
    }

    /**
     * Перевіряє, чи може об'єкт приймати коментарі.
     *
     * @param Movie|Post $commentable
     * @throws Exception
     */
    private function ensureCanReceiveComments(Movie|Post $commentable): void
    {
        if (property_exists($commentable, 'comments_enabled') && !$commentable->comments_enabled) {
            throw new Exception('Коментарі вимкнені.');
        }

        if (property_exists($commentable, 'visibility')) {
            $this->checkVisibility($commentable);
        }
    }

    /**
     * Перевіряє, чи користувач може залишити коментар в залежності від visibility.
     *
     * @param Movie|Post $commentable
     * @throws Exception
     */
    private function checkVisibility(Movie|Post $commentable): void
    {
        /** @var User $user */
        $user = Auth::user();

        if (!property_exists($commentable, 'user_id')) {
            return;
        }

        switch ($commentable->visibility) {
            case 'private':
                if ($commentable->user_id !== $user->id) {
                    throw new Exception('Тільки власник може залишати коментарі.');
                }
                break;

            case 'friends':
                if ($commentable->user_id !== $user->id && !$user->isFriendWith($commentable->user_id)) {
                    throw new Exception('Коментувати можуть лише друзі власника.');
                }
                break;
        }
    }

    /**
     * Підготовка даних для створення коментаря.
     *
     * @param array $data
     * @return array
     */
    private function prepareCommentData(array $data): array
    {
        return [
            'content' => $data['content'],
            'user_id' => Auth::id(),
            'parent_id' => $data['parent_id'] ?? null,
            'likes_count' => $data['likes_count'] ?? 0,
        ];
    }

    /**
     * Перевіряє, чи увімкнені нотифікації для коментарів, і надсилає їх.
     *
     * @param Movie|Post $commentable
     * @param Comment $comment
     */
    private function sendCommentNotificationIfEnabled(Movie|Post $commentable, Comment $comment): void
    {
        if (!property_exists($commentable, 'user_id')) {
            return;
        }

        $author = User::find($commentable->user_id);

        if ($author && $author->id !== Auth::id()) {
            if ($author->settings->getNotificationEnabled(NotificationType::POST_COMMENT)) {
                $author->notify(new PostCommentedNotification($comment));
            }
        }
    }

    /**
     * Надсилає сповіщення автору коментаря, якщо це відповідь.
     *
     * @param Comment $comment
     */
    private function sendReplyNotificationIfEnabled(Comment $comment): void
    {
        if (!$comment->parent_id) {
            return;
        }

        $parentComment = Comment::find($comment->parent_id);
        if (!$parentComment) {
            return;
        }

        $parentAuthor = $parentComment->user;
        if (!$parentAuthor || $parentAuthor->id === Auth::id()) {
            return;
        }

        if ($parentAuthor->settings->getNotificationEnabled(NotificationType::COMMENT_REPLY)) {
            $parentAuthor->notify(new CommentRepliedNotification($comment));
        }
    }
}
