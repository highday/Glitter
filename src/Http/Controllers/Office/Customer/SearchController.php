<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Customer\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, SearchService $service)
    {
        $keyword = $request->input('keyword');
        $customers = $service->search($keyword ?: '');

        return view('glitter.office::customer.search', compact('keyword', 'customers'));
    }
}
