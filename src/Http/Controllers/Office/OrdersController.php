<?php

namespace Glitter\Http\Controllers\Office;

use Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

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

        return view('glitter.office::order.index', compact('orders'));
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
