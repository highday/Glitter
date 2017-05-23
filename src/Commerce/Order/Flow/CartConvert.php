<?php

namespace Glitter\Commerce\Order\Flow;

use Closure;
use Glitter\Commerce\Order\Box;
use Glitter\Commerce\Order\Item;
use Glitter\Contracts\Commerce\Order\Context;
use Glitter\Contracts\Commerce\Order\Flow;

class CartConvert implements Flow
{
    public function process(Context $order, Closure $next)
    {
        $box = new Box();
        $order->pushBox($box);

        $box->pushItem((new Item())->setName('アイテム1')->setQuantity(1)->setUnitPrice(1000));
        $box->pushItem((new Item())->setName('アイテム2')->setQuantity(3)->setUnitPrice(1500));
        $box->pushItem((new Item())->setName('アイテム3')->setQuantity(8)->setUnitPrice(3200));

        return $next($order);
    }
}
