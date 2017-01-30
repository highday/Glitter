<?php

namespace Highday\Glitter\Eloquents\Repositories;

use Highday\Glitter\Contracts\Repositories\ProductRepository as Repository;
use Highday\Glitter\Domain\Entities\Product;
use Highday\Glitter\Domain\Entities\Store;
use Highday\Glitter\Domain\Entities\Variant;
use Highday\Glitter\Domain\EntityCollection;
use Highday\Glitter\Eloquents\Models\Store as StoreModel;
use Highday\Glitter\Eloquents\Models\Product as ProductModel;
use Highday\Glitter\Eloquents\Models\Variant as VariantModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

class ProductRepository implements Repository
{
    public function find($id): Product
    {
        return ProductModel::findOrFail($id)->toDomain();
    }

    public function search(string $keyword = ''): EntityCollection
    {
        $query = ProductModel::query();
        $query = $this->getKeywordQuery($query, $keyword);

        $items = $query->get();

        return $this->toDomainCollection($items);
    }

    public function searchPaginate(string $keyword = '', int $perPage = -1, int $page = 1): EntityCollection
    {
        $query = ProductModel::query();
        $query = $this->getKeywordQuery($query, $keyword);

        $total = $query->getCountForPagination();

        $items = $total ? $query->forPage($page, $perPage)->get() : new Collection();

        return $this->toDomainCollection($items);
        // return [
        //     'total' => $total,
        //     'results' => $this->toDomainCollection($items),
        //     'perPage' => $perPage,
        //     'page' => $page,
        // ];
    }

    private function getKeywordQuery(Builder $query, string $keyword)
    {
        if (empty($keyword)) {
            return $query;
        }

        return $query->where('name', 'like', "%{$keyword}%");
    }

    public function store(Store $store, array $attributes): Product
    {
        $_store = StoreModel::findOrFail($store->getId());

        $product = new ProductModel(array_only($attributes, ['title', 'description']));
        $_store->products()->save($product);

        $variants = array_map(function ($attributes) {
            return new VariantModel($attributes);
        }, array_get($attributes, 'variants'));
        $product->variants()->saveMany($variants);

        return $product->toDomain();
    }

    public function update($id, array $attributes): Product
    {
        $model = ProductModel::findOrFail($id);
        $model->fill($attributes);

        if ($model->save() !== true) {
            throw new RuntimeException('Can not save model.');
        }

        return $model->toDomain();
    }

    private function toDomainCollection(Collection $items): EntityCollection
    {
        return new EntityCollection($items->map(function ($item) {
            return $item->toDomain();
        }));
    }
}
