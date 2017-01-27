<?php

namespace Highday\Glitter\Http\Controllers;

use Closure;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function transaction(Closure $callback) {
        return app(DatabaseManager::class)->transaction($callback);
    }
}
