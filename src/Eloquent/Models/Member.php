<?php

namespace Glitter\Eloquent\Models;

use Glitter\Audit\Auditable;
use Glitter\Eloquent\Relations\StoreMember;
use Glitter\Events\MemberCreated;
use Glitter\Events\MemberUpdated;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Auditable, Notifiable, SoftDeletes;

    protected $events = [
        'created' => MemberCreated::class,
        'updated' => MemberUpdated::class,
    ];

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

    public function getRouteKeyName()
    {
        return 'email';
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_member')->using(StoreMember::class);
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
        return implode(' ', [$this->last_name, $this->first_name]);
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
