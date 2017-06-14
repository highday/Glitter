<?php

namespace Glitter\Eloquent\Models;

use Glitter\Eloquent\Relations\StoreCustomer;
use Glitter\Eloquent\Relations\StoreMember;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Store.
 */
class Store extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'account_email',
        'customer_email',
        'timezone',
        'currency',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return BelongsToMany|Builder
     */
    public function members()
    {
        return $this->belongsToMany(Member::class, 'store_member')->using(StoreMember::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasManyThrough|Builder
     */
    public function variants()
    {
        return $this->hasManyThrough(Variant::class, Product::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    /**
     * @return BelongsToMany|Builder
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'store_customer')
            ->withPivot('address_id', 'accepts_marketing', 'tax_exempt')
            ->using(StoreCustomer::class);
    }

    public function circles()
    {
        return $this->hasMany(Circle::class, 'store_id', 'id');
    }

    /**
     * @return string
     */
    public function getIconAttribute()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->account_email)).'?s=80&d=identicon';
        // return 'https://placehold.jp/80x80.png?text='.mb_substr($this->name, 0, 1).'&css='.urlencode(json_encode(['font-size'=>'50px', 'font-weight'=>'bold']));
    }
}
