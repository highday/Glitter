<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        return redirect()->route('glitter.admin.account.profile');
    }

    public function profile(Request $request)
    {
        $me = $this->guard()->user();

        return view('glitter.admin::account.profile', compact('me'));
    }

    public function security(Request $request)
    {
        $me = $this->guard()->user();

        return view('glitter.admin::account.security', compact('me'));
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
