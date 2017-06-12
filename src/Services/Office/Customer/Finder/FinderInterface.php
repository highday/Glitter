<?php

namespace Glitter\Http\Controllers\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;

interface FinderInterface
{
    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function __invoke($builder);
}
