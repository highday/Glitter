<?php

namespace Highday\Glitter\Eloquent\Repositories;

use Highday\Glitter\Contracts\Repositories\ProductRepository as Repository;
use Highday\Glitter\Domain\Entities\Product;
use Highday\Glitter\Domain\Entities\Store;
use Highday\Glitter\Domain\Collection;
use Highday\Glitter\Eloquent\Models\Product as ProductModel;
use Highday\Glitter\Eloquent\Models\Store as StoreModel;
use Highday\Glitter\Eloquent\Models\Variant as VariantModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use RuntimeException;

class ProductRepository implements Repository
{
    public function find($id): Product
    {
        return ProductModel::findOrFail($id)->toDomain();
    }

    public function getCountForPagination(string $keyword = '')
    {
        $query = ProductModel::query();
        $query = $this->getKeywordQuery($query, $keyword);
        return $query->toBase()->getCountForPagination();
    }

    public function search(string $keyword = '', int $perPage = -1, int $page = 1): Collection
    {
        $query = ProductModel::query();
        $query = $this->getKeywordQuery($query, $keyword);

        if ($perPage > 0) {
            $items = $query->toBase()->getCountForPagination()
                            ? $query->forPage($page, $perPage)->get()
                            : new Collection();
        } else {
            $items = $query->get();
        }

        return $this->toDomainCollection($items);
    }

    private function getKeywordQuery(Builder $query, string $keyword)
    {
        if (empty($keyword)) {
            return $query;
        }

        return $query->where('title', 'like', "%{$keyword}%");
    }

    public function store(Store $store, array $attributes): Product
    {
        $storeModel = StoreModel::findOrFail($store->getId());

        $productModel = new ProductModel(array_only($attributes, [
            'title',
            'description',
        ]));
        $storeModel->products()->save($productModel);

        $variantModels = array_map(function ($attributes) {
            return new VariantModel(array_only($attributes, [
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
        }, array_get($attributes, 'variants'));
        $productModel->variants()->saveMany($variantModels);

        return $productModel->toDomain();
    }

    public function update($id, array $attributes): Product
    {
        $productModel = ProductModel::findOrFail($id);
        $productModel->fill(array_only($attributes, [
            'title',
            'description',
        ]));

        if ($productModel->save() !== true) {
            throw new RuntimeException('Can not save model.');
        }

        $variantModels = array_map(function ($attributes) {
            $variantModel = VariantModel::findOrFail(array_get($attributes, 'id'));

            return $variantModel->fill(array_only($attributes, [
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
        }, array_get($attributes, 'variants'));
        $productModel->variants()->saveMany($variantModels);

        return $productModel->toDomain();
    }

    private function toDomainCollection(EloquentCollection $items): Collection
    {
        return new Collection($items->map(function ($item) {
            return $item->toDomain();
        }));
    }
}
