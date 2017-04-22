<?php

namespace Highday\Glitter\Providers;

use Highday\Glitter\Http\Middleware\Admin\AccessRestrictionWithRemoteAddress;
use Highday\Glitter\Http\Middleware\Admin\RedirectIfMemberAuthenticated;
use Highday\Glitter\Http\Middleware\Admin\ShareAdminVariables;
use Highday\Glitter\Http\Middleware\Admin\ShareFlashMessagesFromSession;
use Illuminate\Contracts\Routing\Registrar as Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $config = require __DIR__.'/../../config/admin.php';
        foreach (array_get($config, 'auth') as $key => $value) {
            $value = array_merge($value, $this->app['config']->get("auth.{$key}", []));
            $this->app['config']->set("auth.{$key}", $value);
        }

        $this->loadViewsFrom(__DIR__.'/../../resources/views/admin', 'glitter.admin');

        $this->app->bind(\Highday\Glitter\Eloquent\Models\Member::class, function ($app) {
            return call_user_func($app['auth']->userResolver(), 'member');
        });

        $this->app->bind(\Highday\Glitter\Eloquent\Models\Store::class, function ($app) {
            return call_user_func($app['auth']->userResolver(), 'member')->activeStore;
        });

        $router->middlewareGroup('glitter.admin', [
            ShareAdminVariables::class,
            ShareFlashMessagesFromSession::class,
        ]);

        $router->aliasMiddleware('restriction', AccessRestrictionWithRemoteAddress::class);
        $router->aliasMiddleware('outsider', RedirectIfMemberAuthenticated::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/admin.php' => config_path('glitter-admin.php'),
            ], 'glitter-admin');

            $this->publishes([
                __DIR__.'/../../resources/views/admin' => resource_path('views/vendor/glitter/admin'),
            ], 'glitter-admin');

            $this->publishes([
                __DIR__.'/../../resources/lang/admin' => resource_path('lang/vendor/glitter/admin'),
            ], 'glitter-admin');
        }

        if (!$this->app->routesAreCached()) {
            $router->group([
                'middleware' => ['web', 'restriction'],
                'namespace'  => 'Highday\Glitter\Http\Controllers\Admin',
                'prefix'     => 'admin',
                'as'         => 'glitter.admin.',
            ], function ($route) {
                require __DIR__.'/../../routes/admin.php';
            });
        }
    }
}
