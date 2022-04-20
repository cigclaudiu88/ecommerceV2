<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // verificam daca utilizatorul este autentificat il redirectionam catre pagina solicitata
        if (Auth::check() && Auth::user()) {
            return $next($request);
            // altfel redirectam catre pagina de autentificare
        } else {
            return redirect()->route('login');
        }
    }
}