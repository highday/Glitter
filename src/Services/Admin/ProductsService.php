<?php

namespace Highday\Glitter\Services\Admin;

use Highday\Glitter\Contracts\Repositories\ProductRepository;
use Highday\Glitter\Domain\Entities\Product;
use Highday\Glitter\Domain\Entities\Store;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function paginate(string $keyword, int $perPage = null, string $pageName = 'page', int $page = null): LengthAwarePaginator
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $perPage = $perPage ?: 1;

        $total = $this->repository->getCountForPagination($keyword);
        $results = $this->repository->search($keyword, $perPage, $page);

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);
    }

    public function find(int $key): Product
    {
        return $this->repository->find($key);
    }

    public function store(array $attributes): Product
    {
        $validator = app(Validator::class)->make($attributes, [
            'title'                            => 'required',
            'description'                      => 'nullable',
            'variants.*.price'                 => 'required|numeric',
            'variants.*.reference_price'       => 'nullable|numeric',
            'variants.*.taxes_included'        => 'nullable|boolean',
            'variants.*.sku'                   => 'nullable',
            'variants.*.barcode'               => 'nullable',
            'variants.*.inventory_management'  => 'nullable',
            'variants.*.inventory_quantity'    => 'nullable|integer',
            'variants.*.out_of_stock_purchase' => 'nullable|boolean',
            'variants.*.requires_shipping'     => 'nullable|boolean',
            'variants.*.weight'                => 'nullable',
            'variants.*.fulfillment_service'   => 'nullable',
            'variants.*.options'               => 'nullable|array',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->store($this->store, $attributes);
    }

    public function update(int $key, array $attributes)
    {
        $validator = app(Validator::class)->make($attributes, [
            'title'                            => 'required',
            'description'                      => 'nullable',
            'variants.*.price'                 => 'required|numeric',
            'variants.*.reference_price'       => 'nullable|numeric',
            'variants.*.taxes_included'        => 'nullable|boolean',
            'variants.*.sku'                   => 'nullable',
            'variants.*.barcode'               => 'nullable',
            'variants.*.inventory_management'  => 'nullable',
            'variants.*.inventory_quantity'    => 'nullable|integer',
            'variants.*.out_of_stock_purchase' => 'nullable|boolean',
            'variants.*.requires_shipping'     => 'nullable|boolean',
            'variants.*.weight'                => 'nullable',
            'variants.*.weight_unit'           => 'nullable',
            'variants.*.fulfillment_service'   => 'nullable',
            'variants.*.options'               => 'nullable|array',
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
