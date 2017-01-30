<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Admin\ProductsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    public function products(Request $request, ProductsService $service)
    {
        $query = $request->input('q', '');

        return view('glitter.admin::products.products', [
            'keyword'  => $query,
            'products' => $service->search($query),
        ]);
    }

    public function inventory(Request $request, ProductsService $service)
    {
        $query = $request->input('q', '');

        return view('glitter.admin::products.inventory', [
            'keyword'  => $query,
            'products' => $service->search($query),
        ]);
    }

    public function new()
    {
        return view('glitter.admin::products.new');
    }

    public function store(Request $request, ProductsService $service)
    {
        try {
            $product = $this->transaction(function () use ($request, $service) {
                return $service->store([
                    'title'                 => $request->input('name'),
                    'description'           => $request->input('description'),
                    'variants'              => array_map(function ($input) {
                        return [
                            'price'                 => (float) array_get($input, 'price'),
                            'reference_price'       => (float) array_get($input, 'reference_price'),
                            'taxes_included'        => (bool) array_get($input, 'taxes_included'),
                            'sku'                   => array_get($input, 'sku'),
                            'barcode'               => array_get($input, 'barcode'),
                            'inventory_policy'      => array_get($input, 'inventory_policy'),
                            'inventory_quantity'    => (int) array_get($input, 'inventory_quantity'),
                            'out_of_stock_purchase' => (bool) array_get($input, 'out_of_stock_purchase'),
                            'requires_shipping'     => (bool) array_get($input, 'requires_shipping'),
                            'weight'                => (float) array_get($input, 'weight'),
                            'fulfillment_service'   => array_get($input, 'fulfillment_service'),
                        ];
                    }, $request->input('variants')),
                ]);
            });

            return redirect()->route('glitter.admin.products.edit', $product->getId())
                ->withFlashMessage([trans('glitter::admin.save.success')]);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
    }

    public function edit(ProductsService $service, $key)
    {
        try {
            return view('glitter.admin::products.edit', [
                'product' => $service->find($key),
            ]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        }
    }

    public function update(Request $request, ProductsService $service, $key)
    {
        try {
            $product = $this->transaction(function () use ($request, $service, $key) {
                return $service->update($key, [
                    'title'       => $request->input('name'),
                    'description' => $request->input('description'),
                ]);
            });

            return redirect()->back()->withFlashMessage([trans('glitter::admin.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        }
    }
}
