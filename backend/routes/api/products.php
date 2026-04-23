<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/', [ProductController::class, 'store'])->name('products.store');
Route::patch('/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
