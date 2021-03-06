<?php

namespace Glitter\Http\Controllers\Office\Order;

use Glitter\Eloquent\Models\Order;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Order\PersistentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EditController extends Controller
{
    public function input(Request $request, Order $order)
    {
        return view('glitter.office::order.edit', compact('order'));
    }

    public function save(Request $request, PersistentService $service, Order $order)
    {
        try {
            $service->update($order->getKey(), [
                'number'    => $request->input('number') ?: '',
                'status'    => $request->input('status') ?: '',
                'order_at'  => $request->input('order_at') ?: '',
                'accept_at' => $request->input('accept_at') ?: '',
                'note'      => $request->input('note') ?: '',
            ]);

            return redirect()->back()->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.office::errors.404');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
    }
}
