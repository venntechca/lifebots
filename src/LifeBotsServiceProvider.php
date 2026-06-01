<?php

namespace LifeBots;

use Illuminate\Support\ServiceProvider;

class LifeBotsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lifebots.php', 'lifebots');

        $this->app->singleton(LifeBots::class, function ($app) {
            return new LifeBots(
                config('lifebots.api_key'),
                config('lifebots.base_url')
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/lifebots.php' => config_path('lifebots.php'),
        ], 'lifebots-config');
    }
}
