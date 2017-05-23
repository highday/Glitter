<?php

namespace Glitter\Http\Controllers\Office\Order;

use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Order\SearchService;
// use Glitter\Services\Office\Product\PersistentService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, SearchService $service)
    {
        $keyword = $request->input('keyword');
        $orders = $service->search($keyword ?: '');

        return view('glitter.office::order.search', compact('keyword', 'orders'));
    }

    public function new()
    {
        return view('glitter.office::order.new');
    }
}
