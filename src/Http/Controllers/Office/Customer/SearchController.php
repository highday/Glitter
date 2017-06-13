<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Contracts\Office\Finder\CustomerFinderGroup;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Customer\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @return Factory|View|RedirectResponse
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

        $finder = ($preset)
            ? $finderGroup->getFinder($preset)
            : null;

        if (!$finder) {
            $default_finder = $finderGroup->getDefault();
            if (!$default_finder) {
                throw new NotFoundHttpException();
            }
            return redirect()->route('glitter.office.customer.search', ['preset' => $default_finder->getName()]);
        }

        $customers = $service->search($finder);

        return view('glitter.office::customer.search',
            compact('keyword', 'customers', 'preset', 'finder', 'finderGroup'));
    }
}
