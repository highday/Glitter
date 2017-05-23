<?php

namespace Glitter\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'company_name',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
