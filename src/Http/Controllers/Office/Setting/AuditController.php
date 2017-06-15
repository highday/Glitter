<?php

namespace Glitter\Http\Controllers\Office\Setting;

use Glitter\Eloquent\Models\Store;
use Glitter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function log(Request $request, Store $store)
    {
        $logs = $store->logs;

        return view('glitter.office::settings.audit.log', compact('logs'));
    }
}
