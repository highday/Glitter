<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Repeater.
 *
 * 注文履歴 1 件以上
 */
class Repeater implements FinderInterface
{
    /**
     * @param Builder|Relation $builder
     *
     * @return Builder
     */
    public function __invoke($builder)
    {
        // Hmmm...

        return $builder;
    }
}
