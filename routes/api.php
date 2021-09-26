<?php

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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Api\V1\BlogController;

Route::get('/inspect', [TaskController::class, 'inspect']); // 自动检测

Route::prefix('v1')->group(function () {
    Route::prefix('blog')->group(function () {
        Route::post('check', [BlogController::class, 'check']);
        Route::get('feeds', [BlogController::class, 'feeds']);
    });
});
