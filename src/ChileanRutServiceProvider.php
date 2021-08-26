<?php

namespace Innovaweb\ChileanRut;

use Illuminate\Support\ServiceProvider;

class ChileanRutServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'innovaweb');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'innovaweb');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/chileanrut.php', 'chileanrut');

        // Register the service the package provides.
        $this->app->singleton('chileanrut', function ($app) {
            return new ChileanRut;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['chileanrut'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/chileanrut.php' => config_path('chileanrut.php'),
        ], 'chileanrut.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/innovaweb'),
        ], 'chileanrut.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/innovaweb'),
        ], 'chileanrut.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/innovaweb'),
        ], 'chileanrut.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
