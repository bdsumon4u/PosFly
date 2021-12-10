<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTenantStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$tenant = tenant()) {
            return $next($request);
        }

        if ($request->url() == route('pay-bill')) {
            return $tenant->statut ? redirect('/') : $next($request);
        }

        return $tenant->statut ? $next($request) : redirect('/pay-bill');
    }
}
