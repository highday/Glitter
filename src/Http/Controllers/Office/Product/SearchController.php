<?php

namespace Glitter\Http\Controllers\Office\Product;

use Glitter\Eloquent\Models\Product;
use Glitter\Http\Controllers\Controller;
use Glitter\Services\Office\Product\IndexService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, IndexService $service)
    {
        $keyword = $request->input('keyword');
        $products = $service->search($keyword ?: '');

        return view('glitter.office::product.search', compact('keyword', 'products'));
    }
}
