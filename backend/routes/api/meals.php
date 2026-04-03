<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\MealController;

Route::get('/', [MealController::class, 'index'])->name('meal.index');
Route::get('/{meal}', [MealController::class, 'show'])->name('meal.show');
Route::post('/', [MealController::class, 'store'])->name('meals.store');
Route::delete('/{meal}', [MealController::class, 'destroy'])->name('meal.destroy');
