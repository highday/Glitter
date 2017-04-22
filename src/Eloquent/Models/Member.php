<?php

namespace Highday\Glitter\Eloquent\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
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
        return $this->belongsToMany(Store::class, 'store_member');
    }

    public function activeStore()
    {
        return $this->stores()->withPivot('last_login_at')->orderBy('last_login_at', 'desc');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'member_role');
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getActiveStoreAttribute()
    {
        return $this->activeStore()->first();
    }

    public function getSwitchableStoresAttribute()
    {
        return $this->stores->except([$this->active_store->getKey()]);
    }

    public function getActiveStoreRoleAttribute()
    {
        return $this->roles()->where('roles.store_id', $this->active_store->getKey())->first();
    }
}
