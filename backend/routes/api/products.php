<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/{products}', [ProductController::class, 'show'])->name('products.show');
Route::post('/', [ProductController::class, 'store'])->name('products.store');
Route::delete('/{products}', [ProductController::class, 'destroy'])->name('products.destroy');
