<?php

namespace Highday\Glitter\Eloquents\Repositories;

use Highday\Glitter\Contracts\Repositories\ProductRepository as Repository;
use Highday\Glitter\Domain\Entities\Store;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\EntityCollection;
use Highday\Glitter\Eloquents\Models\Product;
use Highday\Glitter\Eloquents\RepositoryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements Repository
{
    public function find($id): Entity
    {
        return Product::findOrFail($id)->toDomain();
    }

    public function search(string $keyword = ''): EntityCollection
    {
        $query = Product::query();
        $query = $this->getKeywordQuery($query, $keyword);

        $items = $query->get();

        return $this->toDomainCollection($items);
    }

    public function searchPaginate(string $keyword = '', int $perPage = -1, int $page = 1): EntityCollection
    {
        $query = Product::query();
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

    public function store(Store $store, array $attributes): Entity
    {
        $model = new Product();
        $model->fill($attributes);
        $model->store()->associate($store->getId());

        if ($model->save()) {
            return $model->toDomain();
        }

        throw new RepositoryException('dame');
    }

    public function update($id, array $attributes): Entity
    {
        $model = Product::findOrFail($id);
        $model->fill($attributes);

        if ($model->save()) {
            return $model->toDomain();
        }

        throw new RepositoryException('dame');
    }

    private function toDomainCollection(Collection $items): EntityCollection
    {
        return new EntityCollection($items->map(function ($item) {
            return $item->toDomain();
        }));
    }
}
