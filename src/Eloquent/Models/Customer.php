<?php

namespace Highday\Glitter\Eloquent\Models;

use Highday\Glitter\Eloquent\Relations\StoreCustomer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_customer')
            ->withPivot('address_id', 'accepts_marketing', 'tax_exempt')
            ->using(StoreCustomer::class);
    }

    public function orders()
    {
        $relation = $this->hasMany(Order::class);

        return $this->pivot ? $relation->store($this->pivot->store()) : $relation;
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function getNameAttribute()
    {
        return implode(' ', [$this->last_name, $this->first_name]);
    }

    public function getLocationAttribute()
    {
        $address = $this->pivot ? $this->pivot->address : $this->addresses()->first();

        return $address ? $address->province : null;
    }
}
