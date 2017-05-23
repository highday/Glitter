<?php

namespace Glitter\Commerce\Order\Flow;

use Closure;
use Glitter\Commerce\Shipping\Tag;
use Glitter\Commerce\Support\Address;
use Glitter\Contracts\Commerce\Order\Context;
use Glitter\Contracts\Commerce\Order\Flow;

class Shipping implements Flow
{
    public function process(Context $order, Closure $next)
    {
        $customerAddress = new Address([
            'name'       => '根本啓介',
            'address1'   => '上野1-2-3',
            'address2'   => 'ハイデイマンション303',
            'city'       => '台東区',
            'state'      => '東京都',
            'postalCode' => '123-4567',
            'country'    => '',
            'phone'      => '08012345678',
        ]);

        foreach ($order->getBoxes() as $box) {
            $box->setShippingTag((new Tag)->setMethod('佐川急便')->setAddress($customerAddress)->setFee(500));
        }

        return $next($order);
    }
}
