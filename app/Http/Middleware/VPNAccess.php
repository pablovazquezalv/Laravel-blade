<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class VPNAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->rol_id == 1) {
                if ($request->getHost() == '192.168.25.5') {
                    return $next($request);
                } else {
                    abort(403);
                }

        } else {
            dd('No hay usuario autenticado'); // Mostrar mensaje si no hay usuario autenticado
        }
        
    }
}
}
