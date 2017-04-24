<?php

namespace Highday\Glitter\Http\Controllers\Office\Auth;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\PasswordBrokerFactory as Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $auth;

    protected $password;

    protected $redirectTo = '/office';

    public function __construct(Auth $auth, Password $password)
    {
        $this->auth = $auth;

        $this->password = $password;
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('glitter.office::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return $this->password->broker('member');
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
