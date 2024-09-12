<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (env('IS_MAINTENANCE')) {
            return response()->view('errors.maintenance');
        }
        return $next($request);
    }
}
