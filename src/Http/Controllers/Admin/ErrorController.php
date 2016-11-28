<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notfound(Request $request, $path)
    {
        $extends = 'glitter.admin::layouts.admin';

        if ($request->is('admin/account*')) {
            $extends = 'glitter.admin::layouts.admin-account';
        }

        return response()->view('glitter.admin::errors.404', compact('extends', 'path'), 404);
    }
}
