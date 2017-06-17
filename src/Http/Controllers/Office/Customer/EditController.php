<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Eloquent\Models\Customer;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Customer\PersistentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class EditController.
 */
class EditController extends Controller
{
    /**
     * @param Customer $customer
     *
     * @return Factory|View
     */
    public function input(Customer $customer)
    {
        return view('glitter.office::customer.edit', compact('customer'));
    }

    /**
     * @param Request           $request
     * @param PersistentService $service
     * @param Customer          $customer
     *
     * @return RedirectResponse|Factory|View
     */
    public function update(Request $request, PersistentService $service, Customer $customer)
    {
        try {
            $service->update($customer->getKey(), [
                'first_name' => $request->input('first_name') ?: null,
                'last_name'  => $request->input('last_name') ?: null,
                'email'      => $request->input('email') ?: null,
            ]);

            return redirect()
                ->back()
                ->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.office::errors.404');
        } catch (ValidationException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->validator);
        }
    }
}
