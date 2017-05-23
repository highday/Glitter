<?php

namespace Glitter\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'address1',
        'address2',
        'city',
        'zip',
        'country',
        'province',
        'phone',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
