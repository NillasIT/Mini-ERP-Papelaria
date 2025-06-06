<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Administrador') {
            return $next($request);
        }

        return redirect('/')->withErrors('Você não tem permissão para acessar esta página.');
    }
}
