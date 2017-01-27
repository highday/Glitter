<?php

namespace Highday\Glitter\Contracts\Repositories;

use Highday\Glitter\Domain\Entities\Store;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\EntityCollection;

interface ProductRepository
{
    public function find($id): Entity;

    public function search(string $keyword = ''): EntityCollection;

    public function searchPaginate(string $keyword = '', int $perPage = 100, int $page = 1): EntityCollection;

    public function store(Store $store, array $attributes): Entity;

    public function update($id, array $attributes): Entity;
}
