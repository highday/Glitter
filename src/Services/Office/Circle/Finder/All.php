<?php

namespace Glitter\Services\Office\Customer\Finder;

use Glitter\Services\Office\Finder\FinderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class All.
 *
 * 特に何もしない
 */
class All extends FinderItem
{
    /**
     * @var bool
     */
    protected $is_default = true;

    /**
     * @var string
     */
    protected $name = 'all';

    /**
     * @var string
     */
    protected $label = '全て';

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
