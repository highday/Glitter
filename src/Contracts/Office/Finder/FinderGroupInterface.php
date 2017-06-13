<?php

namespace Glitter\Contracts\Office\Finder;

use Glitter\Services\Office\Finder\FinderItem;

interface FinderGroupInterface
{
    /**
     * @param string $name
     * @return FinderItem
     */
    public function getFinder(string $name): FinderItem;

    /**
     * @return FinderItem
     */
    public function getDefault(): FinderItem;
}