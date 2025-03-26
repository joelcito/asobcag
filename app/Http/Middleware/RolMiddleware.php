<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        //Verifica si tiene cargo
        if (is_null(Auth::user()->rol_id)) {
            return response()->json(['message' => 'Usuario sin rol'], 403);
        }

        // Verifica si el usuario tiene el rol requerido
        if (Auth::user()->rol->id !== 1) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        return $next($request);
    }
}
