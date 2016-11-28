<?php

namespace Highday\Glitter\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\Registrar as Router;

use Highday\Glitter\Http\Middleware\Admin\{
    AccessRestrictionWithRemoteAddress,
    ShareAuthenticatedFromSession,
    ShareFlashMessagesFromSession,
    RedirectIfMemberAuthenticated
};

class AdminServiceProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        $config = require __DIR__.'/../../../config/admin.php';
        foreach (array_get($config, 'auth') as $key => $value) {
            $value = array_merge($value, $this->app['config']->get("auth.{$key}", []));
            $this->app['config']->set("auth.{$key}", $value);
        }

        $this->loadViewsFrom(__DIR__.'/../../../resources/views/admin', 'glitter.admin');

        $this->loadTranslationsFrom(__DIR__.'/../../../resources/lang/admin', 'glitter.admin');

        $router->middlewareGroup('glitter.admin', [
            ShareAuthenticatedFromSession::class,
            ShareFlashMessagesFromSession::class,
        ]);

        $router->middleware('restriction', AccessRestrictionWithRemoteAddress::class);
        $router->middleware('outsider', RedirectIfMemberAuthenticated::class);

        if (!$this->app->routesAreCached()) {
            $router->group([
                'middleware' => ['web', 'restriction'],
                'namespace'  => 'Highday\Glitter\Http\Controllers\Admin',
                'prefix'     => 'admin',
                'as'         => 'glitter.admin.',
            ], function ($route) {
                require __DIR__.'/../../../routes/admin.php';
            });
        }
    }

}
