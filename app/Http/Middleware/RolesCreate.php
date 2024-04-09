<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RolesCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,array $role): Response
    {
     $request->user()->rol_id;

        if($request->user()->rol_id == $role)
        {
            return $next($request);
        }
        return redirect()->route('welcome.view');
        
    }
}
