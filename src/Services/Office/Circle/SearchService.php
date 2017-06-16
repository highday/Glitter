<?php

namespace Glitter\Services\Office\Circle;

use Glitter\Eloquent\Models\Store;
use Glitter\Services\Office\Finder\FinderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class SearchService.
 */
class SearchService
{
    /** @var Store */
    private $store;

    /** @var Builder|BelongsToMany */
    private $query;

    /**
     * SearchService constructor.
     *
     * @param Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;

        $this->query = $this->store->circles();
    }

    /**
     * @param string|null $keyword
     */
    public function setKeyword(string $keyword = null)
    {
        if (!is_null($keyword) && $keyword != '') {
            $this->query->where(function (Builder $q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }
    }

    /**
     * @param FinderItem|null $finder
     *
     * @throws \Exception
     *
     * @return LengthAwarePaginator
     */
    public function search(FinderItem $finder = null): LengthAwarePaginator
    {
        if ($finder) {
            $this->query = $finder($this->query);
        }

        return $this->query->paginate();
    }
}
