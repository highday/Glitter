<?php

namespace Highday\Glitter\Eloquents\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'expected_arrival_at',
        'reference_numbar',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'transfer_variant');
    }
}
