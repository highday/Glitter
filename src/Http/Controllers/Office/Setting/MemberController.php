<?php

namespace Highday\Glitter\Http\Controllers\Office\Setting;

use Highday\Glitter\Eloquent\Models\Member;
use Highday\Glitter\Eloquent\Models\Store;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function search(Request $request, Store $store)
    {
        $members = $store->members;

        return view('glitter.office::settings.members.search', compact('members'));
    }

    public function edit(Request $request, Member $member)
    {
        return view('glitter.office::settings.members.edit', compact('member'));
    }

    public function save(Request $request, Member $member)
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
