<?php

namespace Hasfoug\Grampa;

use Illuminate\Support\ServiceProvider;
use Hasfoug\Grampa\Middleware\AuthGrampa;

class GrampaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/resources/routes.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'grampa');

        $this->publishes([
            __DIR__ . '/resources/config' => config_path('grampa'),
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Merge options with published config
        $this->mergeConfigFrom(__DIR__ . '/resources/config/grampa.php', 'grampa');

        app('router')->aliasMiddleware('auth.grampa', AuthGrampa::class);
    }
}
