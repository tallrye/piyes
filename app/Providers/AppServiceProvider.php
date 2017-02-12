<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            if(\Request::route()){
                $currentRouteName = \Request::route()->getName();
                $currentRoutePath = \Request::url();
            }else{
                $currentRouteName = "";
                $currentRoutePath = "";
            }
            $view->with(['currentRouteName' => $currentRouteName, 'currentRoutePath' => $currentRoutePath]);
        });
    }
}
