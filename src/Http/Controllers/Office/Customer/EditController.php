<?php

namespace Highday\Glitter\Http\Controllers\Office\Customer;

use Highday\Glitter\Eloquent\Models\Customer;
use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Office\Customer\PersistentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EditController extends Controller
{
    public function input(Request $request, Customer $customer)
    {
        return view('glitter.office::customer.edit', compact('customer'));
    }

    public function save(Request $request, PersistentService $service, Customer $customer)
    {
        try {
            $service->update($customer->getKey(), [
                // 'number'    => $request->input('number') ?: '',
                // 'status'    => $request->input('status') ?: '',
                // 'order_at'  => $request->input('order_at') ?: '',
                // 'accept_at' => $request->input('accept_at') ?: '',
                // 'note'      => $request->input('note') ?: '',
            ]);

            return redirect()->back()->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.office::errors.404');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
    }
}
