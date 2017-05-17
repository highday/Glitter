<?php

namespace Highday\Glitter\Http\Controllers\Office\Product;

use Highday\Glitter\Eloquent\Models\Product;
use Highday\Glitter\Eloquent\Models\Variant;
use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Office\Product\IndexService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    public function search(Request $request, IndexService $service)
    {
        $keyword = $request->input('keyword');
        $products = $service->search($keyword ?: '');

        return view('glitter.office::product.search', compact('keyword', 'products'));
    }
}
