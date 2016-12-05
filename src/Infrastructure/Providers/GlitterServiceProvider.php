<?php

namespace Highday\Glitter\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Highday\Glitter\Application\Commands\InstallCommand;
use Highday\Glitter\Contracts\Repositories\{
    ProductRepository
};
use Highday\Glitter\Infrastructure\Repositories\Eloquents\{
    ProductRepository as EloquentProductRepository
};

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

        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
    }
}
