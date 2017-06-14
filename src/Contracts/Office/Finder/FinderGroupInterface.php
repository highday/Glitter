<?php

namespace Glitter\Contracts\Office\Finder;

use Glitter\Services\Office\Finder\FinderItem;

interface FinderGroupInterface
{
    /**
     * @param string $name
     *
     * @return FinderItem|null
     */
    public function getFinder(string $name);

    /**
     * @return FinderItem
     */
    public function getDefault(): FinderItem;
}
