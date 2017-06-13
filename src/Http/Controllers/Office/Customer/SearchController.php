<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Customer\SearchService;
use Illuminate\Http\Request;

/**
 * Class SearchController.
 */
class SearchController extends Controller
{
    /**
     * @param string|null   $preset  ファインダー名
     * @param Request       $request
     * @param SearchService $service
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(string $preset = null, Request $request, SearchService $service)
    {
        // キーワードセット
        $keyword = $request->input('keyword', null);
        $service->setKeyword($keyword);

        // プリセットファインダー
        $finder_collection = collect(app('config')->get('glitter-office.finder'));

        if ($preset) {
            $finder = $finder_collection->first(function ($config, $name) use ($preset) {
                return $preset === $name;
            });
            if (!$finder) {
                // @todo NotFound ???
            }
        } else {
            $finder = $finder_collection->first(function ($config, $name) use (&$preset) {
                if (isset($config['default']) && $config['default'] === true) {
                    $preset = $name;

                    return true;
                } else {
                    return false;
                }
            });
        }

        $customers = $service->search($finder['callback']);

        return view(
            'glitter.office::customer.search',
            compact('keyword', 'customers', 'preset', 'finder', 'finder_collection')
        );
    }
}
