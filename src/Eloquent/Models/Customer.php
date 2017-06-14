<?php

namespace Glitter\Eloquent\Models;

use Glitter\Eloquent\Relations\CircleCustomer;
use Glitter\Eloquent\Relations\StoreCustomer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Customer
 *
 * @package Glitter\Eloquent\Models
 *
 * @property string last_name
 * @property string first_name
 * @property string email
 * @property string mailmagazine_flag
 */
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
        'mailmagazine_flag',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return BelongsToMany|Builder
     */
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_customer')
                    ->withPivot('address_id', 'accepts_marketing', 'tax_exempt')
                    ->using(StoreCustomer::class);
    }

    /**
     * @return BelongsToMany|Builder
     */
    public function circle()
    {
        return $this->belongsToMany(Circle::class, 'circle_customer')
                    ->withPivot([])
                    ->using(CircleCustomer::class);
    }

    /**
     * @return HasMany|Builder
     */
    public function orders()
    {
        $relation = $this->hasMany(Order::class);

        return $this->pivot ? $relation->store($this->pivot->store()) : $relation;
    }

    /**
     * @return HasMany|Builder
     */
    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return implode(' ', [$this->last_name, $this->first_name]);
    }

    /**
     * @return null|CustomerAddress
     */
    public function getLocationAttribute()
    {
        $address = $this->pivot ? $this->pivot->address : $this->addresses()->first();

        return $address ? $address->province : null;
    }
}
