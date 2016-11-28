<?php

namespace Highday\Glitter\Http\Middleware\Admin;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class RedirectIfMemberAuthenticated
{
    private $auth;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guard('member')->check()) {
            return redirect('/admin');
        }

        return $next($request);
    }
}
