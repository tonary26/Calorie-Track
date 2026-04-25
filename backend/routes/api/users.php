<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

Route::middleware('admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/recent', [UserController::class, 'getRecentUsers'])->name('get.recent.users');
    Route::patch('/{user}', [UserController::class, 'updateRole'])->name('users.update.role');
    Route::delete('/{user}', [UserController::class, 'delete'])->name('users.delete');
});
