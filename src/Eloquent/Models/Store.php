<?php

namespace Glitter\Eloquent\Models;

use Glitter\Audit\Log;
use Glitter\Eloquent\Relations\StoreCustomer;
use Glitter\Eloquent\Relations\StoreMember;
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
        return $this->belongsToMany(Member::class, 'store_member')->using(StoreMember::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
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
        return $this->belongsToMany(Customer::class, 'store_customer')
            ->withPivot('address_id', 'accepts_marketing', 'tax_exempt')
            ->using(StoreCustomer::class);
    }

    public function getIconAttribute()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->account_email)).'?s=80&d=identicon';
        // return 'https://placehold.jp/80x80.png?text='.mb_substr($this->name, 0, 1).'&css='.urlencode(json_encode(['font-size'=>'50px', 'font-weight'=>'bold']));
    }
}
