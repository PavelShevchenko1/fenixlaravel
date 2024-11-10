<?php

namespace App\Providers;

use App\Models\FxAppUser;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Регистрируем глобальный хелпер для работы с сессиями
        Session::macro('user', function () {
            // Извлекаем текущий запрос
            $request = Request::instance();

            // Получаем сессию из атрибутов текущего запроса
            return $request->attributes->get('session');
        });
        Schema::defaultStringLength(191);
    }
}
