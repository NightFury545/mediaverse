<?php

use App\Http\Controllers\Social\LikeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/{likeable_type}/{likeable}/likes', [LikeController::class, 'store']);
    Route::delete('/likes/{like}', [LikeController::class, 'destroy']);
    Route::get('/user/likes', [LikeController::class, 'userLikes']);
});
