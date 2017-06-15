<?php

namespace Glitter\Services\Office\Store;

use Closure;
use Glitter\Eloquent\Models\Store;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class SettingService
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

    public function saveGeneral(int $store_id, array $attributes)
    {
        return $this->transaction(function () use ($store_id, $attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'name'                             => 'required',
                'account_email'                    => 'required|email',
                'customer_email'                   => 'required|email',
                'timezone'                         => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = Store::findOrFail($store_id);
            $store->fill(Arr::only($attributes, [
                'name',
                'account_email',
                'customer_email',
                'timezone',
            ]));
            if ($store->save() !== true) {
                throw new RuntimeException('Can not save model.');
            }

            return $store;
        });
    }

    public function addRole(int $store_id, array $attributes)
    {
        return $this->transaction(function () use ($store_id, $attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'name'          => 'required',
                'description'   => 'required',
                'policies'      => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = Store::findOrFail($store_id);
            $role = $store->roles()->create(Arr::only($attributes, [
                'name',
                'description',
            ]));

            $role->policies()->sync($attributes['policies']);

            return $role;
        });
    }

    public function saveRole(int $store_id, int $role_id, array $attributes)
    {
        return $this->transaction(function () use ($store_id, $role_id, $attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'name'          => 'required',
                'description'   => 'required',
                'policies'      => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = Store::findOrFail($store_id);
            $role = $store->roles()->findOrFail($role_id)->fill(Arr::only($attributes, [
                'name',
                'description',
            ]));
            $role->save();

            $role->policies()->sync($attributes['policies']);

            return $role;
        });
    }
}
