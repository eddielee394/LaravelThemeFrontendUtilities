<?php

namespace LamplightSolutions\LaravelThemeFrontendUtilities;

use Illuminate\Support\ServiceProvider;

class LaravelThemeFrontendUtilitiesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelthemefrontendutilities.php', 'laravelthemefrontendutilities');

        // Register the service the package provides.
        $this->app->singleton('laravelthemefrontendutilities', function ($app) {
            return new LaravelThemeFrontendUtilities;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelthemefrontendutilities'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelthemefrontendutilities.php' => config_path('laravelthemefrontendutilities.php'),
        ], 'laravelthemefrontendutilities.config');

        // Publishing assets.
       $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/lamplightsolutions'),
        ], 'laravelthemefrontendutilities.views');

        // Registering package commands.
        // $this->commands([]);
    }
}
