<?php

namespace Highday\Glitter\Services\Office\Product;

use Closure;
use Highday\Glitter\Eloquent\Models\Product;
use Highday\Glitter\Eloquent\Models\Store;
use Highday\Glitter\Eloquent\Models\Variant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class PersistentService
{
    /** @var Store */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    private function transaction(Closure $callback)
    {
        return app(DatabaseManager::class)->transaction($callback);
    }

    public function store(array $attributes): Product
    {
        return $this->transaction(function () use ($attributes) {

            $validator = app(Validator::class)->make($attributes, [
                'title'                            => 'required',
                'description'                      => 'nullable',
                'variants.*.price'                 => 'required|numeric',
                'variants.*.reference_price'       => 'nullable|numeric',
                'variants.*.taxes_included'        => 'nullable|boolean',
                'variants.*.sku'                   => 'nullable',
                'variants.*.barcode'               => 'nullable',
                'variants.*.inventory_management'  => 'nullable',
                'variants.*.inventory_quantity'    => 'nullable|integer',
                'variants.*.out_of_stock_purchase' => 'nullable|boolean',
                'variants.*.requires_shipping'     => 'nullable|boolean',
                'variants.*.weight'                => 'nullable',
                'variants.*.fulfillment_service'   => 'nullable',
                'variants.*.options'               => 'nullable|array',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $product = new Product(Arr::only($attributes, [
                'title',
                'description',
            ]));
            $this->store->products()->save($product);

            $variants = array_map(function ($attributes) {
                return new Variant(Arr::only($attributes, [
                    'sku',
                    'barcode',
                    'price',
                    'reference_price',
                    'taxes_included',
                    'inventory_management',
                    'inventory_quantity',
                    'out_of_stock_purchase',
                    'requires_shipping',
                    'weight',
                    'weight_unit',
                    'fulfillment_service',
                    'options',
                ]));
            }, Arr::get($attributes, 'variants'));
            $product->variants()->saveMany($variants);

            return $product;
        });
    }

    public function update(int $key, array $attributes)
    {
        return $this->transaction(function () use ($key, $attributes) {

            $validator = app(Validator::class)->make($attributes, [
                'title'                            => 'required',
                'description'                      => 'nullable',
                'variants.*.price'                 => 'required|numeric',
                'variants.*.reference_price'       => 'nullable|numeric',
                'variants.*.taxes_included'        => 'nullable|boolean',
                'variants.*.sku'                   => 'nullable',
                'variants.*.barcode'               => 'nullable',
                'variants.*.inventory_management'  => 'nullable',
                'variants.*.inventory_quantity'    => 'nullable|integer',
                'variants.*.out_of_stock_purchase' => 'nullable|boolean',
                'variants.*.requires_shipping'     => 'nullable|boolean',
                'variants.*.weight'                => 'nullable',
                'variants.*.weight_unit'           => 'nullable',
                'variants.*.fulfillment_service'   => 'nullable',
                'variants.*.options'               => 'nullable|array',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $product = Product::findOrFail($key);
            $product->fill(Arr::only($attributes, [
                'title',
                'description',
            ]));
            if ($product->save() !== true) {
                throw new RuntimeException('Can not save model.');
            }
            $variants = array_map(function ($attributes) {
                $variant = Variant::findOrFail(Arr::get($attributes, 'id'));

                return $variant->fill(Arr::only($attributes, [
                    'sku',
                    'barcode',
                    'price',
                    'reference_price',
                    'taxes_included',
                    'inventory_management',
                    'inventory_quantity',
                    'out_of_stock_purchase',
                    'requires_shipping',
                    'weight',
                    'weight_unit',
                    'fulfillment_service',
                    'options',
                ]));
            }, Arr::get($attributes, 'variants'));
            $product->variants()->saveMany($variants);

            return $product;
        });
    }

    public function update_variant(int $key, array $attributes)
    {
        return $this->transaction(function () use ($key, $attributes) {

            $validator = app(Validator::class)->make($attributes, [
                'price'                 => 'required|numeric',
                'reference_price'       => 'nullable|numeric',
                'taxes_included'        => 'nullable|boolean',
                'sku'                   => 'nullable',
                'barcode'               => 'nullable',
                'inventory_management'  => 'nullable',
                'inventory_quantity'    => 'nullable|integer',
                'out_of_stock_purchase' => 'nullable|boolean',
                'requires_shipping'     => 'nullable|boolean',
                'weight'                => 'nullable',
                'weight_unit'           => 'nullable',
                'fulfillment_service'   => 'nullable',
                'options'               => 'nullable|array',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $variant = $this->store->variants()->findOrFail($key);
            $variant->fill(Arr::only($attributes, [
                'sku',
                'barcode',
                'price',
                'reference_price',
                'taxes_included',
                'inventory_management',
                'inventory_quantity',
                'out_of_stock_purchase',
                'requires_shipping',
                'weight',
                'weight_unit',
                'fulfillment_service',
                'options',
            ]));

            return $variant;
        });
    }

    public function addAttachment(int $key, array $attributes): bool
    {
        return $this->transaction(function () use ($key, $attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'file' => 'nullable|file|image',
                'url'  => 'required_unless:file|url',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            dd($attributes);

            return false;
        });
    }

    public function delete(int $key): bool
    {
        return $this->transaction(function () use ($key) {
            //
            return false;
        });
    }
}
