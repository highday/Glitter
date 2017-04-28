<?php

namespace Highday\Glitter\Http\Controllers\Office;

use Highday\Glitter\Eloquent\Models\Product;
use Highday\Glitter\Eloquent\Models\Variant;
use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Office\Product\IndexService;
use Highday\Glitter\Services\Office\Product\PersistentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    public function products(Request $request, IndexService $service)
    {
        $keyword = $request->input('keyword');
        $products = $service->search($keyword ?: '');

        return view('glitter.office::products.products', compact('keyword', 'products'));
    }

    public function inventory(Request $request, IndexService $service)
    {
        $keyword = $request->input('keyword');
        $perPage = 2;
        $page = $request->input('page', 1);

        return view('glitter.office::products.inventory', [
            'keyword'  => $keyword,
            'products' => $service->search($keyword ?: '', $perPage, $page ?: 1),
        ]);
    }

    public function new()
    {
        return view('glitter.office::products.new');
    }

    public function store(Request $request, PersistentService $service)
    {
        try {
            $product = $service->store([
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

            return redirect()->route('glitter.office.products.edit', $product->getId())
                ->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }
    }

    public function edit(Product $product)
    {
        return view('glitter.office::products.edit', [
            'product' => $product,
        ]);
    }

    public function edit_variant(Product $product, Variant $variant)
    {
        return view('glitter.office::products.edit_variant', [
            'product' => $product,
            'variant' => $variant,
        ]);
    }

    public function update(Request $request, PersistentService $service, $key)
    {
        try {
            $product = $service->update($key, [
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

            return redirect()->back()->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.office::errors.404');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        }
    }

    public function update_variant(Request $request, PersistentService $service, $key)
    {
        try {
            $product = $service->update_variant($key, [
                'id'                    => $request->input('id'),
                'price'                 => $request->input('price'),
                'reference_price'       => $request->input('reference_price'),
                'taxes_included'        => $request->input('taxes_included') ?: false,
                'sku'                   => $request->input('sku'),
                'barcode'               => $request->input('barcode'),
                'inventory_management'  => $request->input('inventory_management') ?: 'none',
                'inventory_quantity'    => $request->input('inventory_quantity'),
                'out_of_stock_purchase' => $request->input('out_of_stock_purchase') ?: false,
                'requires_shipping'     => $request->input('requires_shipping') ?: false,
                'weight'                => $request->input('weight'),
                'weight_unit'           => $request->input('weight_unit'),
                'fulfillment_service'   => $request->input('fulfillment_service'),
                'options'               => $request->input('options', []),
            ]);

            return redirect()->back()->withFlashMessage([trans('glitter::office.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.office::errors.404');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        }
    }
}
