<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Lead.
 *
 * カートに入れてる顧客
 *  (カート未実装のためまだできてない)
 */
class Lead implements FinderInterface
{
    /**
     * @param Builder|Relation $builder
     *
     * @return Builder
     */
    public function __invoke($builder)
    {
        return $builder;
    }
}
