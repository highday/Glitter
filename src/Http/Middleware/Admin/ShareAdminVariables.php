<?php

namespace Highday\Glitter\Http\Middleware\Admin;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ShareAdminVariables
{
    /**
     * The auth factory implementation.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return void
     */
    public function __construct(AuthFactory $auth, ViewFactory $view)
    {
        $this->auth = $auth;

        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $me = $this->auth->guard('member')->user();
        $store = $me->activeStore;

        $extends = 'glitter.admin::layouts.admin-guest';

        $this->view->share(compact('me', 'store', 'extends'));

        return $next($request);
    }
}
