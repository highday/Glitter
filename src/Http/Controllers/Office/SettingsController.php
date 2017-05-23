<?php

namespace Glitter\Http\Controllers\Office;

use Glitter\Eloquent\Models\Store;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Store\SettingService;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Store $store)
    {
        return view('glitter.office::settings.index', compact('store'));
    }

    public function update_store(Request $request, Store $store, SettingService $service)
    {
        try {
            $service->saveGeneral($store->getKey(), [
                'name'           => $request->input('name'),
                'account_email'  => $request->input('account_email'),
                'customer_email' => $request->input('customer_email'),
                'timezone'       => $request->input('timezone'),
            ]);

            return redirect()->route('glitter.office.settings.index')
                ->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
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
