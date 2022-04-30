<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;

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
        // partea pt verificarea ca utilizatorul este online sau ultima logare
        // verificam daca userul este logat
        if (Auth::check()) {
            // $expireTime adauga la timpul curenta o valoare de timp 30 secunde
            $expireTime = Carbon::now()->addSeconds(30);
            // adaugam in Cache valoarea $expireTime pentru userul logat
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
            // actualizam campul last_seen pt utilizatorul logatcu data si ora curenta
            User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }

        // verificam daca utilizatorul este autentificat il redirectionam catre pagina solicitata
        if (Auth::check() && Auth::user()) {
            return $next($request);
            // altfel redirectam catre pagina de autentificare
        } else {
            return redirect()->route('login');
        }
    }
}