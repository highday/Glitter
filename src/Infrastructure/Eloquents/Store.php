<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'account_email',
        'customer_email',
        'timezone',
        'currency',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'store_member');
    }

    public function roles()
    {
        return $this->hasMany(Roles::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function variants()
    {
        return $this->hasManyThrough(Variant::class, Product::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'store_customer');
    }
}
