<?php

use App\Http\Controllers\Dish\DishController;
use App\Http\Controllers\Order\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('dish')->group(function() {
    Route::get('', [DishController::class, 'index']);
    Route::post('', [DishController::class, 'store']);
    Route::post('{id}', [DishController::class, 'update']);
    Route::delete('{id}', [DishController::class, 'destroy']);
});

Route::prefix('order')->group(function() {
    Route::get('', [OrderController::class, 'index']);
    Route::get('{id}', [OrderController::class, 'show']);
    Route::post('', [OrderController::class, 'storeOrUpdate']);
    Route::delete('{id}', [OrderController::class, 'destroy']);
});



