<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class admin_brand_access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // daca userul admin are access la modulul brands il paote access
        if (auth()->guard('admin')->user()->brand == 1) {
            return $next($request);
            // daca nu are access eroare 404
        } else {
            abort(405);
        }
    }
}