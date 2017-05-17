<?php

namespace Highday\Glitter\Http\Controllers\Office\Customer;

use Highday\Glitter\Eloquent\Models\Store;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, Store $store)
    {
        $customers = $store->customers;

        return view('glitter.office::customer.search', compact('customers'));
    }
}
