<?php

namespace Glitter\Providers;

use Glitter\Contracts\Office\Finder\CustomerFinderGroup;
use Glitter\Http\Middleware\Office\AccessRestrictionWithRemoteAddress;
use Glitter\Http\Middleware\Office\RedirectIfMemberAuthenticated;
use Glitter\Http\Middleware\Office\ShareFlashMessagesFromSession;
use Glitter\Http\Middleware\Office\ShareVariables;
use Glitter\Services\Office\Finder\Factory;
use Glitter\Services\Office\Finder\FinderGroup;
use Illuminate\Contracts\Routing\Registrar as Router;
use Illuminate\Support\ServiceProvider;

class OfficeServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        // Config
        // $this->mergeConfigFrom(__DIR__.'/../../config/office.php', '');
        $config = require __DIR__.'/../../config/office.php';
        foreach (array_get($config, 'auth') as $key => $value) {
            $value = array_merge($value, $this->app['config']->get("auth.{$key}", []));
            $this->app['config']->set("auth.{$key}", $value);
        }
        $this->publishes([
            __DIR__.'/../../config/office.php' => config_path('glitter-office.php'),
        ], 'glitter-office');

        // Views
        $this->loadViewsFrom(__DIR__.'/../../resources/views/office', 'glitter.office');
        $this->publishes([
            __DIR__.'/../../resources/views/office' => resource_path('views/vendor/glitter/office'),
        ], 'glitter-office');

        // Languages
        $this->publishes([
            __DIR__.'/../../resources/lang/office' => resource_path('lang/vendor/glitter/office'),
        ], 'glitter-office');

        $this->app->bind(\Glitter\Eloquent\Models\Member::class, function ($app) {
            return call_user_func($app['auth']->userResolver(), 'member');
        });

        $this->app->bind(\Glitter\Eloquent\Models\Store::class, function ($app) {
            return call_user_func($app['auth']->userResolver(), 'member')->activeStore;
        });

        // Finder
        $this->app->bind(CustomerFinderGroup::class, FinderGroup::factory('glitter-office.finder.customers'));

        $router->middlewareGroup('glitter.office', [
            ShareVariables::class,
            ShareFlashMessagesFromSession::class,
        ]);

        $router->aliasMiddleware('restriction', AccessRestrictionWithRemoteAddress::class);
        $router->aliasMiddleware('outsider', RedirectIfMemberAuthenticated::class);

        if (!$this->app->routesAreCached()) {
            $router->group([
                'middleware' => ['web', 'restriction'],
                'namespace'  => 'Glitter\Http\Controllers\Office',
                'prefix'     => 'office',
                'as'         => 'glitter.office.',
            ], function ($route) {
                require __DIR__.'/../../routes/office.php';
            });
        }
    }
}
