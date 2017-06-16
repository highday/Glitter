<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Contracts\Office\Finder\CustomerFinderGroup;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Circle\SearchService;
use Illuminate\Http\Request;

class CircleSearchController extends Controller
{
    public function search(
        string $preset = null,
        Request $request,
        SearchService $service,
        CustomerFinderGroup $finderGroup
    ) {
        // キーワードセット
        $keyword = $request->input('keyword', null);
        $service->setKeyword($keyword);

        $circles = $service->search();

        return view('glitter.office::customer.circle_search',
            compact('keyword', 'circles', 'preset', 'finder', 'finderGroup'));
    }
}
