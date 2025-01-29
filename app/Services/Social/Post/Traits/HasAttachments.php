<?php

namespace App\Services\Social\Post\Traits;

use App\Enums\PostVisibility;
use App\Facades\Files\FileFacade;
use Exception;

trait HasAttachments
{
    private function processAttachments(array $attachments, PostVisibility $visibility): ?string
    {
        try {
            if (empty($attachments)) {
                return null;
            }

            $processedFiles = [];
            foreach ($attachments as $file) {
                if (in_array($visibility, [PostVisibility::PRIVATE, PostVisibility::FRIENDS], true)) {
                    $processedFiles[] = FileFacade::savePrivateFile($file, 'posts');
                } else {
                    $processedFiles[] = FileFacade::savePublicFile($file, 'posts');
                }
            }

            return json_encode($processedFiles);
        } catch (Exception $e) {
            throw new Exception('Помилка під час обробки файлів. Можлива проблема з збереженням файлів.');
        }
    }

    /**
     * @throws Exception
     */
    private function updateAttachmentsVisibility(array $attachments, PostVisibility $newVisibility): ?string
    {
        try {
            $updatedFiles = [];
            foreach ($attachments as $filePath) {
                if (str_contains($filePath, 'public') && in_array($newVisibility, [PostVisibility::PRIVATE, PostVisibility::FRIENDS])) {
                    $updatedFiles[] = FileFacade::moveToPrivate($filePath, 'posts');
                } elseif (str_contains($filePath, 'private') && $newVisibility === PostVisibility::PUBLIC) {
                    $updatedFiles[] = FileFacade::moveToPublic($filePath, 'posts');
                } else {
                    $updatedFiles[] = $filePath;
                }
            }

            return json_encode($updatedFiles);
        } catch (Exception $e) {
            throw new Exception('Помилка при оновленні доступності файлів. Можлива проблема з переміщенням файлів.');
        }
    }

    private function deleteAttachments(?string $attachments): void
    {
        try {
            if (!$attachments) {
                return;
            }

            $attachmentPaths = json_decode($attachments, true);
            foreach ($attachmentPaths as $filePath) {
                FileFacade::deleteFile($filePath);
            }
        } catch (Exception $e) {
            throw new Exception('Помилка під час видалення файлів. Можлива проблема з видаленням файлів з серверу.');
        }
    }
}
