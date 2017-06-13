<?php

namespace Glitter\Services\Office\Finder;

use Glitter\Contracts\Office\Finder\CustomerFinderGroup;
use Illuminate\Contracts\Foundation\Application;
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

    /**
     * @param string $config
     *
     * @return \Closure
     */
    public static function factory(string $config)
    {
        return function (Application $app) use ($config) {
            $collection = new FinderGroup($app->make('config')
                                              ->get($config));
            $collection->transform(function (string $itemClass) {
                return new $itemClass();
            });

            return $collection;
        };
    }
}
