<?php

namespace Highday\Glitter\Application\Services\Admin;

use Highday\Glitter\Contracts\Repositories\ProductRepository;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\EntityCollection;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Validation\ValidationException;

class ProductsService
{
    /** @var ProductRepository */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(string $query): EntityCollection
    {
        return $this->repository->search($query);
    }

    public function find($key): Entity
    {
        return $this->repository->find($key);
    }

    public function update($key, string $name, string $description): bool
    {
        $validator = app(Validator::class)->make(compact('name', 'description'), [
            'name'        => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->update($key, compact('name', 'description'));
    }
}
