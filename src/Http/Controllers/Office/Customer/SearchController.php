<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Customer\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, SearchService $service)
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = app('config');

        $finders = $config->get('glitter-office.finder.customers', []);
        $current_finder = null;
        foreach ($finders as $finder_name => $finder_config) {
            if ($request->except($finder_name)) {
                $current_finder = $finder_name;
            }
        }

        $keyword = $request->input('keyword');
        $customers = $service->search($keyword ?: '');

        return view('glitter.office::customer.search', compact('keyword', 'customers', 'finders', 'current_finder'));
    }
}
