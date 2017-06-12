<?php

namespace Glitter\Http\Controllers\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;

class MailMagazine implements FinderInterface
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