<?php

namespace Highday\Glitter\Http\Controllers\Office\Order;

use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Office\Order\SearchService;
// use Highday\Glitter\Services\Office\Product\PersistentService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, SearchService $service)
    {
        $keyword = $request->input('keyword');
        $orders = $service->search($keyword ?: '');

        return view('glitter.office::orders.search', compact('keyword', 'orders'));
    }

    public function new()
    {
        return view('glitter.office::orders.new');
    }
}
