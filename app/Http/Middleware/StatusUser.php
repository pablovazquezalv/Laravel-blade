<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->isStatus(1)) {
          return $next($request);
        }
//        return redirect()->route('login.view');
        //aqui se cierra la sesion
        $request->session()->invalidate();
        //aqui se regenera el token
        $request->session()->regenerateToken();
        //aqui se redirige a la vista de login
        return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
    }
}
