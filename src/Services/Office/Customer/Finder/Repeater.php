<?php

namespace Glitter\Http\Controllers\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;

class Repeater implements FinderInterface
{
    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    function __invoke($builder)
    {
        return $builder;
    }
}