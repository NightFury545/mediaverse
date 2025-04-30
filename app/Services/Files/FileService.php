<?php

namespace App\Services\Files;

use App\Enums\FileExtension;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Image;

class FileService
{
    /**
     * Зберегти файл на вказаному диску.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string $disk
     * @return string
     */
    public function saveFile(UploadedFile $file, string $folder = 'attachments', string $disk = 'public'): string
    {
        if (in_array($file->getClientOriginalExtension(), FileExtension::getImageExtensions())) {
            $file = $this->convertToWebp($file);
        }

        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = Storage::disk($disk)->putFileAs($folder, $file, $fileName);

        return $disk === 'public' ? Storage::disk($disk)->url($path) : $path;
    }

    /**
     * Перемістити файл з одного диска на інший.
     *
     * @param string $filePath
     * @param string $fromDisk
     * @param string $toDisk
     * @return string
     */
    public function moveFile(string $filePath, string $fromDisk, string $toDisk): string
    {
        $newPath = $filePath;

        Storage::disk($toDisk)->put($newPath, Storage::disk($fromDisk)->get($filePath));
        Storage::disk($fromDisk)->delete($filePath);

        return $newPath;
    }

    /**
     * Видалити файл з вказаного диска.
     *
     * @param string $filePath
     * @param string $disk
     * @return void
     */
    public function deleteFile(string $filePath, string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($filePath);
    }

    /**
     * Конвертувати зображення у WebP.
     *
     * @param UploadedFile $file
     * @param int $quality
     * @return UploadedFile
     */
    protected function convertToWebp(UploadedFile $file, int $quality = 90): UploadedFile
    {
        $image = Image::make($file->getPathname())->encode('webp', $quality);

        $tmpPath = tempnam(sys_get_temp_dir(), 'webp_') . '.webp';
        $image->save($tmpPath);

        return new UploadedFile(
            $tmpPath,
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.webp',
            'image/webp',
            null,
            true
        );
    }
}
