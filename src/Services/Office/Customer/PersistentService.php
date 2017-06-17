<?php

namespace Glitter\Services\Office\Customer;

use Closure;
use Glitter\Eloquent\Models\Product;
use Glitter\Eloquent\Models\Store;
use Glitter\Eloquent\Models\Variant;
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
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required|email',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $product = new Product(Arr::only($attributes, [
                'title',
                'description',
            ]));
            $this->store->products()
                        ->save($product);

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
            $product->variants()
                    ->saveMany($variants);

            return $product;
        });
    }

    public function update(int $key, array $attributes)
    {
        return $this->transaction(function () use ($key, $attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required|email',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $customer = $this->store->customers()
                                    ->findOrFail($key);

            $customer->fill(Arr::only($attributes, [
                'first_name',
                'last_name',
                'email',
            ]));

            if ($customer->save() !== true) {
                throw new RuntimeException('Can not save model.');
            }

            return $customer;
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
