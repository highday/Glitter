<?php

namespace Glitter\Http\Controllers\Office\Customer;

use Glitter\Eloquent\Models\Store;
use Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupSearchController extends Controller
{
    public function search(Request $request, Store $store)
    {
        $customers = $store->customers;

        return view('glitter.office::customer.search', compact('customers'));
    }
}
