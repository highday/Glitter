<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    private $auth;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function notfound(Request $request, $path)
    {
        $extends = 'glitter.admin::layouts.admin-guest';

        if ($this->auth->guard('member')->check()) {
            $extends = 'glitter.admin::layouts.admin';

            if ($request->is('admin/account*')) {
                $extends = 'glitter.admin::layouts.admin-account';
            }
        }

        return response()->view('glitter.admin::errors.404', compact('extends', 'path'), 404);
    }
}
