<?php

namespace Highday\Glitter\Application\Services\Admin;

use Highday\Glitter\Contracts\Repositories\ProductRepository;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\EntityCollection;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsService
{
    const SEARCH_QUERY_NAME = 'q';

    /** @var ProductRepository */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchQuery(Request $request): string
    {
        return (string) $request->input(self::SEARCH_QUERY_NAME, '');
    }

    public function search(Request $request): EntityCollection
    {
        return $this->repository->search($this->searchQuery($request));
    }

    public function find($key): Entity
    {
        return $this->repository->find($key);
    }

    public function update($key, Request $request): bool
    {
        $validator = app(Validator::class)->make($request->input(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->update($key, $request->only([
            'name',
            'description',
        ]));
    }
}
