<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class All.
 *
 * 特に何もしない
 */
class All implements FinderInterface
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
