<?php

namespace Highday\Glitter\Http\Controllers\Office\Customer;

use Highday\Glitter\Eloquent\Models\Store;
use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Office\Customer\SearchService;
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
