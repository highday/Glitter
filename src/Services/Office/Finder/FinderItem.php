<?php

namespace Glitter\Services\Office\Finder;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class FinderItem.
 */
abstract class FinderItem
{
    /**
     * @var bool
     */
    protected $is_default = false;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    abstract public function __invoke($builder);

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->is_default;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
