<?php

namespace Highday\Glitter\Eloquents\Models;

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
        return $this->belongsToMany(Store::class, 'store_customer');
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
