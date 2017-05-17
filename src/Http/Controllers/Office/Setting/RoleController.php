<?php

namespace Highday\Glitter\Http\Controllers\Office\Setting;

use Highday\Glitter\Eloquent\Models\Role;
use Highday\Glitter\Eloquent\Models\Store;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function search(Request $request, Store $store)
    {
        $roles = $store->roles;

        return view('glitter.office::settings.roles.search', compact('roles'));
    }

    public function edit(Request $request, Role $role)
    {
        return view('glitter.office::settings.roles.edit', compact('role'));
    }

    public function save(Request $request, Role $role)
    {
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
