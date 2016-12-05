<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Highday\Glitter\Contracts\Domain\Domainable;
use Highday\Glitter\Domain\Entities\Member as DomainEntity;
use Highday\Glitter\Domain\ValueObjects\Web\EmailAddress;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable implements Domainable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

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

    public function toDomain(): DomainEntity
    {
        return new DomainEntity($this->getKey(), $this->name, new EmailAddress($this->email));
    }
}
