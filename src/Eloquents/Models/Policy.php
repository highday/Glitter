<?php

namespace Highday\Glitter\Eloquents\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $hidden = [
        'pivot',
    ];

    protected $fillable = [
        'store_id',
        'name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_policy');
    }
}
