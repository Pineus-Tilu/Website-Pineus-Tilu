<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Area;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if($this->app->environment('local')) {
        //     URL::forceScheme('https');
        // }
        
        View::composer('*', function ($view) {
            $view->with('areas', Area::all());
        });
    }
}
