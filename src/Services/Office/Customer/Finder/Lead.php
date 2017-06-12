<?php

namespace Glitter\Http\Controllers\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;

class Lead implements FinderInterface
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