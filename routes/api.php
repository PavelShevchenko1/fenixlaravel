<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------  ------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/news', [App\Http\Controllers\Api\NewsController::class, 'getNews']);

Route::get('/app', [App\Http\Controllers\Api\AppUserController::class, 'app']);

Route::get('/user/profile', [App\Http\Controllers\Api\AppUserController::class, 'getUserProfile'])->middleware('app.auth');
Route::post('/user/profile', [App\Http\Controllers\Api\AppUserController::class, 'createProfile']);
Route::put('/user/profile', [App\Http\Controllers\Api\AppUserController::class, 'updateUserProfile'])->middleware('app.auth');
Route::put('/user/profile/tester', [App\Http\Controllers\Api\AppUserController::class, 'setAsTester'])->middleware('app.auth');
