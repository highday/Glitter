<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Highday\Glitter\Domain\Entities\Domainable;
use Highday\Glitter\Domain\Entities\Member as MemberEntity;
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

    /**
     * ======================
     * Relationships
     * ======================.
     */
    protected $storeModel = Store::class;

    protected $roleModel = Role::class;

    public function stores()
    {
        return $this->belongsToMany($this->storeModel, 'store_member');
    }

    public function activeStore()
    {
        return $this->belongsToMany($this->storeModel, 'store_member')
            ->withPivot('last_login_at')->orderBy('last_login_at', 'desc');
    }

    public function roles()
    {
        return $this->belongsToMany($this->roleModel, 'member_role');
    }

    /**
     * ======================
     * Mutators
     * ======================.
     */
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

    public function toDomain(): MemberEntity
    {
        return new MemberEntity($this->name, new EmailAddress($this->email));
    }
}
