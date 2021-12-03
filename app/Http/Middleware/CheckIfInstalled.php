<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckIfInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $flag = 'true')
    {
        $installed = Storage::disk('public')->exists('installed');

        if ($flag == 'true' && !$installed) {
            return redirect('/setup');
        }

        if ($flag == 'false' && $installed) {
            abort(403);
        }

        return $next($request);
    }
}
