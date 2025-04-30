<?php

use App\Http\Controllers\Social\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('{commentable}/comments', [CommentController::class, 'store']);
    Route::put('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
    Route::get('user/comments', [CommentController::class, 'userComments']);
});

Route::get('{commentable}/comments', [CommentController::class, 'index']);
Route::get('{commentable}/comments/{comment}', [CommentController::class, 'show']);
Route::get('{commentable}/comments/{comment}/replies', [CommentController::class, 'replies']);
