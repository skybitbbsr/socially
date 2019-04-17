<?php

namespace SkyBit\Socially\Providers;

use Illuminate\Support\ServiceProvider;

class SociallyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/config/socially.php' => config_path('socially.php'),
            ], 'config');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('socially', function ($app) {
            return new Socially($app['session'], $app['config']);
        });
    }

    /**
     * Get the services provider by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['socially'];
    }
}
