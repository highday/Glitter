<?php

namespace Glitter\Commerce\Order\Flow;

use Closure;
use Glitter\Contracts\Commerce\Order\Context;
use Glitter\Contracts\Commerce\Order\Flow;

class Discount implements Flow
{
    public function process(Context $order, Closure $next)
    {
        return $next($order);
    }
}
