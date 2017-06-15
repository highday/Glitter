<?php

namespace Glitter\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $hidden = [
        'pivot',
    ];

    protected $fillable = [
        'store_id',
        'built_in',
        'name',
        'description',
    ];

    protected $with = [
        'policies',
    ];

    protected $casts = [
        'built_in' => 'bool',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_role');
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'role_policy');
    }
}
