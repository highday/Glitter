<?php

namespace Highday\Glitter\Services\Admin;

use Highday\Glitter\Eloquent\Models\Product;
use Highday\Glitter\Eloquent\Models\Store;
use Highday\Glitter\Eloquent\Models\Variant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class ProductsService
{
    /** @var Store */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function search(string $keyword = ''): LengthAwarePaginator
    {
        $query = $this->store->products();
        if ($keyword != '') {
            $query->where('title', 'like', "%{$keyword}%");
        }

        return $query->paginate();
    }

    public function find(int $key): Product
    {
        return $this->store->products->find($key);
    }

    public function store(array $attributes): Product
    {
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
    }

    public function update(int $key, array $attributes)
    {
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

        $product = Product::findOrFail($id);
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
    }

    public function addAttachment(int $key, array $attributes): bool
    {
        $validator = app(Validator::class)->make($attributes, [
            'file' => 'nullable|file|image',
            'url'  => 'required_unless:file|url',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        dd($attributes);
    }

    public function delete(int $key): bool
    {
        //
    }
}
