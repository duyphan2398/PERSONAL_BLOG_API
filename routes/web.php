<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [HomeController::class, 'index'])->name('web.home');
Route::get('post/{post:slug}',[HomeController::class, 'getPost']);
Route::get('stories', [StoryController::class, 'index']);
Route::get('blogs', [BlogController::class, 'index']);
Route::get('projects', [ProjectController::class, 'index']);
Route::get('services', [ServiceController::class, 'index']);
Route::get('contacts', [ContactController::class, 'index']);
