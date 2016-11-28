<?php

namespace Highday\Glitter\Http\Controllers\Admin\Auth;

use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Contracts\Auth\PasswordBrokerFactory as Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    private $password;

    public function __construct(Password $password)
    {
        $this->password = $password;
    }

    public function showLinkRequestForm()
    {
        return view('glitter.admin::auth.passwords.email');
    }

    public function broker()
    {
        return $this->password->broker('member');
    }
}
