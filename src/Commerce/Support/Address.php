<?php

namespace Glitter\Commerce\Support;

use Illuminate\Support\Arr;

class Address
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $address1;

    /**
     * @var string
     */
    protected $address2;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @param array $attributes
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->name = Arr::get($attributes, 'name', '');
        $this->address1 = Arr::get($attributes, 'address1', '');
        $this->address2 = Arr::get($attributes, 'address2', '');
        $this->city = Arr::get($attributes, 'city', '');
        $this->state = Arr::get($attributes, 'state', '');
        $this->postalCode = Arr::get($attributes, 'postalCode', '');
        $this->country = Arr::get($attributes, 'country', '');
        $this->phone = Arr::get($attributes, 'phone', '');
    }
}
