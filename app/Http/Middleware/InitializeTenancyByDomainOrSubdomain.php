<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InitializeTenancyByDomainOrSubdomain
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
        $host = $request->getHost();

        // Skip for central domains
        if(in_array($host, config('tenancy.central_domains'), true)){
            return $next($request);
        }

        return app(\Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain::class)
            ->handle($request, $next);
    }
}
