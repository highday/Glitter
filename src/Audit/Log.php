<?php

namespace Glitter\Audit;

use Glitter\Eloquent\Models\Member;
use Glitter\Eloquent\Models\Store;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'audit_logs';

    protected $fillable = [
        'action_at',
        'action',
        'data',
    ];

    protected $dates = [
        'action_at',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public $timestamps = false;

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
