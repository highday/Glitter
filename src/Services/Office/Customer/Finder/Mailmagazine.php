<?php

namespace Glitter\Services\Office\Customer\Finder;

use Glitter\Services\Office\Finder\FinderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Mailmagazine.
 *
 * メルマガフラグが '1' のもの
 */
class Mailmagazine extends FinderItem
{
    /**
     * @var string
     */
    protected $name = 'mailmagazine';

    /**
     * @var string
     */
    protected $label = 'メールマガジン購読客';

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
