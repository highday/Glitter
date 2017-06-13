<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface FinderInterface.
 */
interface FinderInterface
{
    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function __invoke($builder);
}
