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



Route::get('/app', [App\Http\Controllers\Api\AppUserController::class, 'app']);

Route::post('/user/profile', [App\Http\Controllers\Api\AppUserController::class, 'createProfile']);
Route::get('/user/profile', [App\Http\Controllers\Api\AppUserController::class, 'getUserProfile'])->middleware('app.auth');
Route::put('/user/profile', [App\Http\Controllers\Api\AppUserController::class, 'updateUserProfile'])->middleware('app.auth');
Route::put('/user/profile/tester', [App\Http\Controllers\Api\AppUserController::class, 'setAsTester'])->middleware('app.auth');

Route::get('/news', [App\Http\Controllers\Api\NewsController::class, 'getNews'])->middleware('app.auth');
Route::get('/news/{id}', [App\Http\Controllers\Api\NewsController::class, 'getNewsById']);
Route::get('/stores', [App\Http\Controllers\Api\StoresController::class, 'getStores'])->middleware('app.auth');
Route::get('/sorts', [App\Http\Controllers\Api\SortsController::class, 'getSorts'])->middleware('app.auth');
Route::get('/sorts', [App\Http\Controllers\Api\SortsController::class, 'getSorts'])->middleware('app.auth');

Route::get('/node/notifications', [App\Http\Controllers\Api\NodeController::class, 'notifications']);
Route::get('/node/notifications/{id}', [App\Http\Controllers\Api\NodeController::class, 'notification']);
Route::get('/node/notifications/{id}/sended', [App\Http\Controllers\Api\NodeController::class, 'setSended']);