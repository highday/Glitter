<?php

namespace Glitter\Eloquent\Relations;

use Glitter\Eloquent\Models\CustomerAddress;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreCustomer extends Pivot
{
    protected $dates = [
        'join_at',
    ];

    public function store()
    {
        return $this->parent;
    }

    public function address()
    {
        return $this->hasOne(CustomerAddress::class, 'id', 'address_id');
    }
}
