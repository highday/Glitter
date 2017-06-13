<?php

namespace Glitter\Services\Office\Customer\Finder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Mailmagazine.
 *
 * メルマガフラグが '1' のもの
 */
class Mailmagazine implements FinderInterface
{
    /**
     * @param Builder|Relation $builder
     *
     * @return Builder
     */
    public function __invoke($builder)
    {
        $builder->where('mailmagazine_flag', '1');

        return $builder;
    }
}
