<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/v1')->middleware('throttle:api')->group(function () {
    Route::prefix('/auth')->group(function () {
        require __DIR__ . '/api/auth.php';
    });

    Route::prefix('/activityLevels')->group(function () {
       require __DIR__ . '/api/activityLevels.php';
    });

    Route::prefix('/products')->middleware('auth:sanctum')->group(function () {
        require __DIR__ . '/api/products.php';
    });

    Route::prefix('/meals')->middleware('auth:sanctum')->group(function () {
        require __DIR__ . '/api/meals.php';

        require __DIR__ . '/api/mealsItem.php';
    });

    Route::prefix('/users')->group(function () {
        require __DIR__ . '/api/users.php';
    });
});
