<?php

namespace App\Providers;

use App\Services\Shop\CardManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if(!$_SERVER['SERVER_NAME']=="127.0.0.1"){
        //    $this->app['request']->server->set('HTTPS', true);
        //    \URL::forceScheme('https');
        // }
        //Schema::defaultStringLength(191);
        View::composer('dashboard.user.*', function ($view) {
            $cardManager = new CardManager();
            $view->with('card', $cardManager->get());
        });

    }
}
