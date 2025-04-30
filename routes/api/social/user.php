<?php

use App\Http\Controllers\Social\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['auth', 'verified'])->group(function () {
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'delete'])->name('users.delete');
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/me', [UserController::class, 'me'])->middleware('auth')->name('users.me');
    Route::get('/{identifier}', [UserController::class, 'show'])->name('users.show');
});
