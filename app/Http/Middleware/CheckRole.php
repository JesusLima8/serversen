<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Manejar la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array|string  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, 'No tienes acceso a esta sección.');
        }

        // Obtiene el rol del usuario autenticado
        $userRole = Auth::user()->role;

        // Verifica si el rol del usuario está permitido
        if (!in_array($userRole, $roles)) {
            abort(403, 'No tienes acceso a esta sección.');
        }

        return $next($request);
    }
}
