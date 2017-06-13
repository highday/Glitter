<?php

namespace Glitter\Services\Office\Finder;

use Glitter\Contracts\Office\Finder\CustomerFinderGroup;
use Illuminate\Support\Collection;

/**
 * Class FinderGroup.
 */
class FinderGroup extends Collection implements CustomerFinderGroup
{
    /**
     * @param string $name
     *
     * @return FinderItem
     */
    public function getFinder(string $name): FinderItem
    {
        return $this->first(function (FinderItem $item) use ($name) {
            return $item->getName() === $name;
        });
    }

    /**
     * @return FinderItem
     */
    public function getDefault(): FinderItem
    {
        return $this->first(function (FinderItem $item) {
            return $item->isDefault();
        });
    }
}
