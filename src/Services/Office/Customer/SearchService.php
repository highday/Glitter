<?php

namespace Highday\Glitter\Services\Office\Customer;

use Highday\Glitter\Eloquent\Models\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchService
{
    /** @var Store */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function search(string $keyword = ''): LengthAwarePaginator
    {
        $query = $this->store->customers();
        if ($keyword != '') {
            $query->where('name', 'like', "%{$keyword}%");
        }

        return $query->paginate();
    }
}
