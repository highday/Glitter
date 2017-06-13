<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Repeater
 *
 * 注文履歴 n 件以上
 *
 * @package Glitter\Services\Office\Customer\Finder
 */
class Repeater implements FinderInterface
{
    /**
     * @var int 閾値
     */
    private $threshold = 1;

    /**
     * @param Builder|Relation $builder
     *
     * @return Builder
     */
    function __invoke($builder)
    {
        $builder->join('orders', 'customers.id', '=', 'orders.customer_id', 'LEFT')
                ->groupBy(
                    'customers.id',
                    'store_customer.store_id',
                    'store_customer.address_id',
                    'store_customer.accepts_marketing',
                    'store_customer.tax_exempt'
                )
                ->havingRaw('count(orders.id) >= ' . $this->threshold);

        return $builder;
    }
}
