<?php

namespace Highday\Glitter\Providers;

use Highday\Glitter\Http\Middleware\Office\AccessRestrictionWithRemoteAddress;
use Highday\Glitter\Http\Middleware\Office\RedirectIfMemberAuthenticated;
use Highday\Glitter\Http\Middleware\Office\ShareVariables;
use Highday\Glitter\Http\Middleware\Office\ShareFlashMessagesFromSession;
use Illuminate\Contracts\Routing\Registrar as Router;
use Illuminate\Support\ServiceProvider;

class OfficeServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $config = require __DIR__.'/../../config/office.php';
        foreach (array_get($config, 'auth') as $key => $value) {
            $value = array_merge($value, $this->app['config']->get("auth.{$key}", []));
            $this->app['config']->set("auth.{$key}", $value);
        }

        $this->loadViewsFrom(__DIR__.'/../../resources/views/office', 'glitter.office');

        $this->app->bind(\Highday\Glitter\Eloquent\Models\Member::class, function ($app) {
            return call_user_func($app['auth']->userResolver(), 'member');
        });

        $this->app->bind(\Highday\Glitter\Eloquent\Models\Store::class, function ($app) {
            return call_user_func($app['auth']->userResolver(), 'member')->activeStore;
        });

        $router->middlewareGroup('glitter.office', [
            ShareVariables::class,
            ShareFlashMessagesFromSession::class,
        ]);

        $router->aliasMiddleware('restriction', AccessRestrictionWithRemoteAddress::class);
        $router->aliasMiddleware('outsider', RedirectIfMemberAuthenticated::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/office.php' => config_path('glitter-office.php'),
            ], 'glitter-office');

            $this->publishes([
                __DIR__.'/../../resources/views/office' => resource_path('views/vendor/glitter/office'),
            ], 'glitter-office');

            $this->publishes([
                __DIR__.'/../../resources/lang/office' => resource_path('lang/vendor/glitter/office'),
            ], 'glitter-office');
        }

        if (!$this->app->routesAreCached()) {
            $router->group([
                'middleware' => ['web', 'restriction'],
                'namespace'  => 'Highday\Glitter\Http\Controllers\Office',
                'prefix'     => 'office',
                'as'         => 'glitter.office.',
            ], function ($route) {
                require __DIR__.'/../../routes/office.php';
            });
        }
    }
}
