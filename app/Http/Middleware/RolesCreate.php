<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RolesCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$allowedRoles): Response
    {
        
        $user = Auth::user();
        $userRole= $user->rol_id;
        //        $userRole = $request->user()->rol_id;

        // Verificar si el rol del usuario está permitido
        if (!in_array($userRole, $allowedRoles)) {
            return redirect()->route('welcome.view'); // Redirigir a la página de bienvenida o a donde sea necesario
        }
        return $next($request);
    }
}
