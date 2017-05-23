<?php

namespace Glitter\Http\Middleware\Office;

use Closure;

class AccessRestrictionWithRemoteAddress
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (false) {
            return response()->view('glitter.office::errors.403', [], 403);
        }

        return $next($request);
    }
}
