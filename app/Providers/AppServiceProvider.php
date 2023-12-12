<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Footer;
use App\Models\Header;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::composer('*', function ($view) {
            $header = Header::first();
            $footer = Footer::first(); 

            $view->with(compact('header', 'footer'));
        });
    }
}
