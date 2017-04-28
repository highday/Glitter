<?php

namespace Highday\Glitter\Services\Office\Product;

use Highday\Glitter\Eloquent\Models\Product;
use Highday\Glitter\Eloquent\Models\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexService
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
            $query->where('name', 'like', "%{$keyword}%");
        }

        return $query->paginate();
    }

    public function find(int $key): Product
    {
        return $this->store->products->find($key);
    }
}
