<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface FinderInterface
 *
 * @package Glitter\Services\Office\Customer\Finder
 */
interface FinderInterface
{
    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    function __invoke($builder);
}
