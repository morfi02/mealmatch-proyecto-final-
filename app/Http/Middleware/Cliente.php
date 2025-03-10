<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cliente
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->rol === 'cliente') {
            return $next($request);
        }

        abort(403, 'Acceso solo permitido para clientes.');
    }
}




