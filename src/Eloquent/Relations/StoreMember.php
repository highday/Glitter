<?php

namespace Highday\Glitter\Eloquent\Relations;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreMember extends Pivot
{

    protected $dates = [
        'last_login_at',
    ];

}

