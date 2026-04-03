<?php

use App\Http\Controllers\Api\V1\MealItemController;
use Illuminate\Support\Facades\Route;

Route::post('/{meal}/products', [MealItemController::class, 'store'])->name('meal-item.store');
Route::delete('/{meal}/products', [MealItemController::class, 'destroy'])->name('meal-item.destroy');
