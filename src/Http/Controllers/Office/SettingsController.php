<?php

namespace Highday\Glitter\Http\Controllers\Office;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        $store = $this->guard()->user()->activeStore;

        return view('glitter.office::settings.index', compact('store'));
    }

    public function members(Request $request)
    {
        $store = $this->guard()->user()->activeStore;
        $members = $store->members;

        return view('glitter.office::settings.members', compact('store', 'members'));
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
