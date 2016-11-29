<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        $me = $this->guard()->user();
        $store = $me->active_store;
        $products = [];

        return view('glitter.admin::products.index', compact('store', 'products'));
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
