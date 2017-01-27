<?php

namespace Highday\Glitter\Services\Admin;

use Highday\Glitter\Contracts\Repositories\ProductRepository;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\EntityCollection;
use Highday\Glitter\Domain\Entities\Store;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Validation\ValidationException;

class ProductsService
{
    /** @var ProductRepository */
    private $repository;

    /** @var Store */
    private $store;

    public function __construct(ProductRepository $repository, Store $store)
    {
        $this->repository = $repository;

        $this->store = $store;
    }

    public function search(string $query): EntityCollection
    {
        return $this->repository->search($query);
    }

    public function find(int $key): Entity
    {
        return $this->repository->find($key);
    }

    public function store(array $attributes)
    {
        $validator = app(Validator::class)->make($attributes, [
            'title'       => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->store($this->store, $attributes);
    }

    public function update(int $key, array $attributes)
    {
        $validator = app(Validator::class)->make($attributes, [
            'title'       => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->update($key, $attributes);
    }

    public function addAttachment(int $key, array $attributes): bool
    {
        $validator = app(Validator::class)->make($attributes, [
            'file' => 'nullable|file|image',
            'url'  => 'required_unless:file|url',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        dd($attributes);
    }

    public function delete(int $key): bool
    {
        $validator = app(Validator::class)->make($attributes, [
            'title'       => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->update($key, $attributes);
    }
}
