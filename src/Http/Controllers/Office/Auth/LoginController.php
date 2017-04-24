<?php

namespace Highday\Glitter\Http\Controllers\Office\Auth;

use Carbon\Carbon;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Translation\Translator as Lang;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $auth;

    protected $lang;

    protected $redirectTo = '/office';

    public function __construct(Auth $auth, Lang $lang)
    {
        $this->auth = $auth;
        $this->lang = $lang;

        $this->middleware('outsider', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('glitter.office::auth.login');
    }

    protected function authenticated(Request $request, $member)
    {
        if ($member->active_store) {
            $last_login_at = Carbon::now();
            $member->activeStore()->updateExistingPivot($member->active_store->getKey(), compact('last_login_at'));

            return redirect()->intended($this->redirectPath())
                ->withFlashMessage([
                    sprintf('<strong>おかえりなさい！</strong> %s さん', $member->name),
                ]);
        } else {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => $this->lang->get('auth.failed'),
                ]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/office');
    }

    protected function guard()
    {
        return $this->auth->guard('member');
    }
}
