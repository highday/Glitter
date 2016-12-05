<?php

namespace Highday\Glitter\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class GlitterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');

            $this->publishes([
                __DIR__.'/../../../database/migrations' => database_path('migrations'),
            ], 'glitter');

            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
