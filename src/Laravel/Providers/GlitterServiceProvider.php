<?php

namespace Highday\Glitter\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class GlitterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../../resources/lang', 'glitter');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');

            $this->publishes([
                __DIR__.'/../../../database/migrations' => database_path('migrations'),
            ], 'glitter');

            $this->commands([
                \Highday\Glitter\Laravel\Commands\InstallCommand::class,
            ]);
        }

        $this->app->bind(
            \Highday\Glitter\Contracts\Repositories\ProductRepository::class,
            \Highday\Glitter\Eloquents\Repositories\ProductRepository::class
        );
    }
}
