<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Application\Services\Admin\ProductsService;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    /** @var ProductsService */
    protected $service;

    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    public function products(Request $request)
    {
        return view('glitter.admin::products.products', [
            'keyword'  => $this->service->searchQuery($request),
            'products' => $this->service->search($request),
        ]);
    }

    public function edit($key)
    {
        try {
            return view('glitter.admin::products.edit', [
                'product' => $this->service->find($key),
            ]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        }
    }

    public function update(Request $request, $key)
    {
        try {
            $this->service->update($key, $request);

            return redirect()->back()
                ->withFlashMessage(['OK!']);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($e->validator->getMessages());
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        }
    }
}
