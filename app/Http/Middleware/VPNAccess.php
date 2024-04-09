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
        $user = Auth::user();

        if($user)
        {
            $rol = $user->rol_id;
            //dd($rol);
            if($rol == 3)
            {

                if($request->getHost() == 'danielypablo.tech')
                {
                    return $next($request);
                }

                
            }
            else if($rol == 2)
            {
              
                if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.2')
                {
                  
                    return $next($request);
                }
                abort(403);
            }
            else if($rol == 1)
            {
                if($request->getHost() == '192.168.25.2')
                {
                    return $next($request);
                } 
                alert('Debes acceder por el dominio de la empresa');
            }
            return redirect()->route('login.view');
        }
      //   $request->session()->invalidate();
      //   $request->session()->regenerateToken();
      //   return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
        alert('Debes iniciar sesión');

        
        
    }
}
