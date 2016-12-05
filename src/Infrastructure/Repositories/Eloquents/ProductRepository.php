<?php

namespace Highday\Glitter\Infrastructure\Repositories\Eloquents;

use Highday\Glitter\Contracts\Repositories\ProductRepository as Repository;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\EntityCollection;
use Highday\Glitter\Infrastructure\Eloquents\Product;
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

        $items = $total ? $query->forPage($page, $perPage)->get() : new Collection;

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

    public function update($id, $attributes): bool
    {
        $model = Product::findOrFail($id);
        $model->fill($attributes);
        return $model->save();
    }

    private function toDomainCollection(Collection $items): EntityCollection
    {
        return new EntityCollection($items->map(function ($item) {
            return $item->toDomain();
        }));
    }
}
