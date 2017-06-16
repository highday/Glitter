<?php

namespace Glitter\Eloquent\Relations;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CircleCustomer extends Pivot
{
    protected $dates = [
        'join_at',
    ];

    public function circle()
    {
        return $this->parent;
    }
}
