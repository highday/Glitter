<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Contracts\Office\Finder\CustomerFinderGroup;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Customer\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class SearchController.
 */
class SearchController extends Controller
{
    /**
     * @param string|null         $preset ファインダー名
     * @param Request             $request
     * @param SearchService       $service
     * @param CustomerFinderGroup $finderGroup
     *
     * @return Factory|View
     */
    public function search(
        string $preset = null,
        Request $request,
        SearchService $service,
        CustomerFinderGroup $finderGroup
    ) {
        // キーワードセット
        $keyword = $request->input('keyword', null);
        $service->setKeyword($keyword);

        if ($preset) {
            $finder = $finderGroup->getFinder($preset);
            if (!$finder) {
                // @todo NotFound ???
            }
        } else {
            $finder = $finderGroup->getDefault();
        }

        $customers = $service->search($finder);

        return view('glitter.office::customer.search',
            compact('keyword', 'customers', 'preset', 'finder', 'finderGroup'));
    }
}
