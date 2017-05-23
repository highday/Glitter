<?php

namespace Glitter\Providers;

use Illuminate\Support\ServiceProvider;

class GlitterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'glitter');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'glitter');

        $this->app->bind(
            \Glitter\Contracts\Commerce\Order\Context::class,
            \Glitter\Commerce\Order\Context::class
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Glitter\Console\Commands\InstallCommand::class,
                \Glitter\Console\Commands\OrderCommand::class,
            ]);
        }
    }
}
