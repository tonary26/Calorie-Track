<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ActivityLevelController;

Route::get('/', [ActivityLevelController::class, 'index'])->name('activity-level.index');
Route::post('/', [ActivityLevelController::class, 'store'])->name('activity-level.store');
