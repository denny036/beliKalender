<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Penjual
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'penjual') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'pembeli') {
            return redirect('/pembeli');
        }
        else {
            return redirect('/login');
        }
    }
}
