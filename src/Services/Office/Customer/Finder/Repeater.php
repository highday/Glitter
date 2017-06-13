<?php

namespace Glitter\Services\Office\Customer\Finder;

use Glitter\Services\Office\Finder\FinderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Repeater.
 *
 * 注文履歴 n 件以上
 */
class Repeater extends FinderItem
{
    /**
     * @var string
     */
    protected $name = 'repeater';

    /**
     * @var string
     */
    protected $label = 'リピート客';

    /**
     * @var int 閾値
     */
    private $threshold = 1;

    /**
     * @param Builder|Relation $builder
     *
     * @return Builder
     */
    public function __invoke($builder)
    {
        $builder->join('orders', 'customers.id', '=', 'orders.customer_id', 'LEFT')
                ->groupBy(
                    'customers.id',
                    'store_customer.store_id',
                    'store_customer.address_id',
                    'store_customer.accepts_marketing',
                    'store_customer.tax_exempt'
                )
                ->havingRaw('count(orders.id) >= '.$this->threshold);

        return $builder;
    }
}
