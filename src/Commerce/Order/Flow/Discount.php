<?php

namespace Glitter\Commerce\Order\Flow;

use Closure;
use Glitter\Commerce\Order\Box;
use Glitter\Commerce\Order\Item;
use Glitter\Contracts\Commerce\Order\Context;
use Glitter\Contracts\Commerce\Order\Flow;

class Discount implements Flow
{
    public function process(Context $order, Closure $next)
    {
        return $next($order);
    }
}
