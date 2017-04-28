<?php

namespace Highday\Glitter\Http\Controllers\Office;

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
        $extends = 'glitter.office::layouts.guest';

        if ($this->auth->guard('member')->check()) {
            $extends = 'glitter.office::layouts.console';

            if ($request->is('office/account*')) {
                $extends = 'glitter.office::layouts.account';
            }
        }

        return response()->view('glitter.office::errors.404', compact('extends', 'path'), 404);
    }
}
