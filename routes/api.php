<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UploadFileController;
use App\Http\Controllers\API\CategoryController;
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

// CMS
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });

    Route::apiResource('admins', AdminController::class);
    Route::apiResource('posts', PostController::class)->except('update');
    Route::post('posts/{post}', [PostController::class, 'update']);
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show', 'update']);
    Route::post('upload', UploadFileController::class);
});
