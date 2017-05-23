<?php

namespace Glitter\Http\Controllers\Office\Product;

use Glitter\Eloquent\Models\Product;
use Glitter\Eloquent\Models\Variant;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Product\PersistentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VariantEditController extends Controller
{
    public function input(Variant $variant)
    {
        return view('glitter.office::product.variant.edit', [
            'product' => $variant->product,
            'variant' => $variant,
        ]);
    }

    public function save(Request $request, PersistentService $service, Variant $variant)
    {
        try {
            $variant = $service->update_variant($variant->getKey(), [
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
