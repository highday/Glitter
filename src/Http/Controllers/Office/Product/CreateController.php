<?php

namespace Highday\Glitter\Http\Controllers\Office\Product;

use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Office\Product\PersistentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function input()
    {
        return view('glitter.office::product.new');
    }

    public function save(Request $request, PersistentService $service)
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
}
