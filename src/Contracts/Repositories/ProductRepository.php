<?php

namespace Highday\Glitter\Contracts\Repositories;

use Highday\Glitter\Domain\Collection;
use Highday\Glitter\Domain\Entities\Product;
use Highday\Glitter\Domain\Entities\Store;

interface ProductRepository
{
    public function find($id): Product;

    public function search(string $keyword = '', int $perPage = null, int $page = 1): Collection;

    public function store(Store $store, array $attributes): Product;

    public function update($id, array $attributes): Product;
}
