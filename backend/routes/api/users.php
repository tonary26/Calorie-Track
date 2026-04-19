<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::patch('/{user}', [UserController::class, 'updateRole'])->name('users.update.role');
Route::delete('/{user}', [UserController::class, 'delete'])->name('users.delete');