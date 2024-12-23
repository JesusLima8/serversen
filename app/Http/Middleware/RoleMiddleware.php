<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario tiene el rol correcto
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple con el rol
        }

        return $next($request); // Permite continuar con la solicitud
    }
}
