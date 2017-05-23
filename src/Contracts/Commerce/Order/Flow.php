<?php

namespace Glitter\Contracts\Commerce\Order;

use Closure;

interface Flow
{
    public function process(Context $order, Closure $next);
}
