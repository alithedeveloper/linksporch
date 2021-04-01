<?php

namespace App\Providers;

use App\Services\SvgIcons\SvgCache;
use App\Services\SvgIcons\SvgCacheable;
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
        $this->app->singleton(SvgCacheable::class, fn($app) => new SvgCache());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
