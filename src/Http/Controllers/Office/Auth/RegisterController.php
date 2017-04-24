<?php

namespace Highday\Glitter\Http\Controllers\Office\Auth;

use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Member;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $auth;

    protected $validator;

    protected $redirectTo = '/office';

    public function __construct(Auth $auth, Validator $validator)
    {
        $this->auth = $auth;

        $this->validator = $validator;

        $this->middleware('outsider');
    }

    public function showRegistrationForm()
    {
        return view('glitter.office::auth.register');
    }

    protected function validator(array $data)
    {
        return $this->validator->make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Member::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
