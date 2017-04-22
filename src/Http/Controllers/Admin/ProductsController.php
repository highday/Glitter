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
        $keyword = $request->input('keyword');
        $products = $service->search($keyword ?: '');

        return view('glitter.admin::products.products', compact('keyword', 'products'));
    }

    public function inventory(Request $request, ProductsService $service)
    {
        $keyword = $request->input('keyword');
        $perPage = 2;
        $page = $request->input('page', 1);

        return view('glitter.admin::products.inventory', [
            'keyword'  => $keyword,
            'products' => $service->search($keyword ?: '', $perPage, $page ?: 1),
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
                    'title'                 => $request->input('title'),
                    'description'           => $request->input('description') ?: '',
                    'variants'              => array_map(function ($input) {
                        return [
                            'price'                 => array_get($input, 'price'),
                            'reference_price'       => array_get($input, 'reference_price'),
                            'taxes_included'        => array_get($input, 'taxes_included') ?: false,
                            'sku'                   => array_get($input, 'sku'),
                            'barcode'               => array_get($input, 'barcode'),
                            'inventory_management'  => array_get($input, 'inventory_management') ?: 'none',
                            'inventory_quantity'    => array_get($input, 'inventory_quantity') ?: 0,
                            'out_of_stock_purchase' => array_get($input, 'out_of_stock_purchase') ?: false,
                            'requires_shipping'     => array_get($input, 'requires_shipping') ?: false,
                            'weight'                => array_get($input, 'weight'),
                            'fulfillment_service'   => array_get($input, 'fulfillment_service'),
                            'options'               => array_get($input, 'options', []),
                        ];
                    }, $request->input('variants', [])),
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
                    'title'                 => $request->input('title'),
                    'description'           => $request->input('description') ?: '',
                    'variants'              => array_map(function ($input) {
                        return [
                            'id'                    => array_get($input, 'id'),
                            'price'                 => array_get($input, 'price'),
                            'reference_price'       => array_get($input, 'reference_price'),
                            'taxes_included'        => array_get($input, 'taxes_included') ?: false,
                            'sku'                   => array_get($input, 'sku'),
                            'barcode'               => array_get($input, 'barcode'),
                            'inventory_management'  => array_get($input, 'inventory_management') ?: 'none',
                            'inventory_quantity'    => array_get($input, 'inventory_quantity'),
                            'out_of_stock_purchase' => array_get($input, 'out_of_stock_purchase') ?: false,
                            'requires_shipping'     => array_get($input, 'requires_shipping') ?: false,
                            'weight'                => array_get($input, 'weight'),
                            'weight_unit'           => array_get($input, 'weight_unit'),
                            'fulfillment_service'   => array_get($input, 'fulfillment_service'),
                            'options'               => array_get($input, 'options', []),
                        ];
                    }, $request->input('variants', [])),
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
