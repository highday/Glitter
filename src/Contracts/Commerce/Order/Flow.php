<?php

namespace Glitter\Contracts\Commerce\Order;

use Closure;
use Glitter\Contracts\Commerce\Order\Context;

interface Flow
{
    public function process(Context $order, Closure $next);
}
