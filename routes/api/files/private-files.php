<?php
use App\Http\Controllers\Files\PrivateFilesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/storage/private/post/{directory}/{fileName}', [PrivateFilesController::class, 'servePostFile'])->name(
        'files.post'
    );
    Route::get('/storage/private/chat/{directory}/{fileName}', [PrivateFilesController::class, 'serveChatFile'])->name(
        'files.chat'
    );
});
