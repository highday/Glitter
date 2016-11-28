<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;

class OrdersController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        $me = $this->guard()->user();
        $orders = $me->active_store->orders;
        return view('glitter.admin::orders.index', compact('orders'));
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
