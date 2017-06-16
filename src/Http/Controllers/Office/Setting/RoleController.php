<?php

namespace Glitter\Http\Controllers\Office\Setting;

use Glitter\Eloquent\Models\Role;
use Glitter\Eloquent\Models\Store;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Store\SettingService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function search(Request $request, Store $store)
    {
        $query = $store->roles();
        if ($keyword = $request->input('keyword')) {
            // $query->where(function ($query) use ($keyword) {
            // });
            $query->where('name', 'like', "%{$keyword}%");
            $query->orWhere('description', 'like', "%{$keyword}%");
        }
        $roles = $query->get();

        return view('glitter.office::settings.roles.search', compact('keyword', 'roles'));
    }

    public function new(Request $request)
    {
        return view('glitter.office::settings.roles.new');
    }

    public function store(Request $request, Store $store, SettingService $service)
    {
        try {
            $service->addRole($store->getKey(), [
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'policies'      => $request->input('policies'),
            ]);

            return redirect()->route('glitter.office.settings.roles.search')
                ->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
    }

    public function edit(Request $request, Role $role)
    {
        if ($role->built_in) {
            return redirect()->route('glitter.office.settings.roles.search')
                ->withFlashMessage('ビルトインロールは変更できません。');
        }

        return view('glitter.office::settings.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role, Store $store, SettingService $service)
    {
        try {
            $service->saveRole($store->getKey(), $role->getKey(), [
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'policies'      => $request->input('policies'),
            ]);

            return redirect()->route('glitter.office.settings.roles.edit', $role)
                ->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
        //     try {
    //         $service->update($order->getKey(), [
    //             'number'    => $request->input('number') ?: '',
    //             'status'    => $request->input('status') ?: '',
    //             'order_at'  => $request->input('order_at') ?: '',
    //             'accept_at' => $request->input('accept_at') ?: '',
    //             'note'      => $request->input('note') ?: '',
    //         ]);

    //         return redirect()->back()->withFlashMessage([trans('glitter::office.save.success')]);
    //     } catch (ModelNotFoundException $e) {
    //         return view('glitter.office::errors.404');
    //     } catch (ValidationException $e) {
    //         return redirect()->back()->withInput()->withErrors($e->validator);
    //     }
    }
}
