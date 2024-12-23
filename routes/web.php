<?php

use App\Livewire\AdminComponent;
use App\Livewire\HomeComponent;
use App\Livewire\NewsComponent;
use App\Livewire\NotificationComponent;
use App\Livewire\SortsComponent;
use App\Livewire\StoresComponent;
use App\Livewire\UserGroupsComponent;
use App\Livewire\UsersComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');




Route::middleware('auth')->group(function () {
    Route::get('/', HomeComponent::class);
    Route::get('/index', function () {
        return redirect('/');
    });
    Route::get('/news', NewsComponent::class);
    Route::get('/users', UsersComponent::class);
    Route::get('/user-groups', UserGroupsComponent::class);
    Route::get('/administrators', AdminComponent::class);
    Route::get('/sorts', SortsComponent::class);
    Route::get('/stores', StoresComponent::class);
    Route::get('/notifications', NotificationComponent::class);
});
