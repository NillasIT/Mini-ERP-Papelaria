<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FuncionarioMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Funcionario') {
            return $next($request);
        }

        return redirect('/')->withErrors('Você não tem permissão para acessar esta página.');
    }
}