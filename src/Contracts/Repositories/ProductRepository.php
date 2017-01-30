<?php

namespace Highday\Glitter\Contracts\Repositories;

use Highday\Glitter\Domain\Entities\Product;
use Highday\Glitter\Domain\Entities\Store;
use Highday\Glitter\Domain\EntityCollection;

interface ProductRepository
{
    public function find($id): Product;

    public function search(string $keyword = ''): EntityCollection;

    public function searchPaginate(string $keyword = '', int $perPage = 100, int $page = 1): EntityCollection;

    public function store(Store $store, array $attributes): Product;

    public function update($id, array $attributes): Product;
}
