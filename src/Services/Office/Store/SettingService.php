<?php

namespace Highday\Glitter\Services\Office\Store;

use Closure;
use Highday\Glitter\Eloquent\Models\Store;
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

    public function saveGeneral(int $key, array $attributes)
    {
        return $this->transaction(function () use ($key, $attributes) {
            $validator = app(Validator::class)->make($attributes, [
                'name'                             => 'required',
                'account_email'                    => 'required|email',
                'customer_email'                   => 'required|email',
                'timezone'                         => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = Store::findOrFail($key);
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
}
