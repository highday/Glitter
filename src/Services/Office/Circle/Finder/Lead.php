<?php

namespace Glitter\Services\Office\Customer\Finder;

use Glitter\Services\Office\Finder\FinderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Lead.
 *
 * カートに入れてる顧客
 *  (カート未実装のためまだできてない)
 */
class Lead extends FinderItem
{
    /**
     * @var string
     */
    protected $name = 'lead';

    /**
     * @var string
     */
    protected $label = '見込み客';

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
        /*
        $builder->join('cart_products', 'customers.id', '=', 'cart_products.customer_id', 'LEFT')
                ->groupBy(
                    'customers.id',
                    'store_customer.store_id',
                    'store_customer.address_id',
                    'store_customer.accepts_marketing',
                    'store_customer.tax_exempt'
                )
                ->havingRaw('count(cart_products.id) >= ' . $this->threshold);
        */

        return $builder;
    }
}
