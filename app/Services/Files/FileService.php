<?php

namespace App\Services\Files;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    public function savePublicFile(UploadedFile $file, string $folder): string
    {
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs($folder, $file, $fileName);

        return Storage::url($path);
    }

    public function savePrivateFile(UploadedFile $file, string $folder): string
    {
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        return Storage::disk('private')->putFileAs($folder, $file, $fileName);
    }

    public function moveToPrivate(string $filePath, string $folder): string
    {
        $newPath = str_replace('public', 'private', $filePath);
        Storage::move($filePath, $newPath);

        return $newPath;
    }

    public function moveToPublic(string $filePath, string $folder): string
    {
        $newPath = str_replace('private', 'public', $filePath);
        Storage::move($filePath, $newPath);

        return $newPath;
    }

    public function deleteFile(string $filePath): void
    {
        Storage::delete($filePath);
    }
}
