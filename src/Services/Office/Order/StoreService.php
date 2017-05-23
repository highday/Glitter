<?php

namespace Glitter\Services\Office\Order;

use Glitter\Eloquent\Models\Order;
use Glitter\Eloquent\Models\Store;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class StoreService
{
    /** @var Store */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    private function transaction(Closure $callback)
    {
        return app(DatabaseManager::class)->transaction($callback);
    }

    public function create(array $attributes)
    {
        return $this->transaction(function () use ($attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'number'    => 'required',
                'status'    => 'required',
                'order_at'  => 'nullable',
                'accept_at' => 'nullable',
                'note'      => 'nullable',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $order = new Order(Arr::only($attributes, [
                'number',
                'status',
                'order_at',
                'accept_at',
                'note',
            ]));
            $this->store->orders()->save($order);
        });
    }

    public function update(int $key, array $attributes)
    {
        return $this->transaction(function () use ($attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'number'    => 'required',
                'status'    => 'required',
                'order_at'  => 'nullable',
                'accept_at' => 'nullable',
                'note'      => 'nullable',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $order = $this->store->orders()->findOrFail($key);
            $order->fill(Arr::only($attributes, [
                'number',
                'status',
                'order_at',
                'accept_at',
                'note',
            ]));
            if ($order->save() !== true) {
                throw new RuntimeException('Can not save model.');
            }
        });
    }

    public function archive(int $key)
    {
        return $this->transaction(function () use ($key) {
            //
            return false;
        });
    }
}
