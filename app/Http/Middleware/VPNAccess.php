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

        //OBTENER EL USUARIO AUTENTICADO

        $user = Auth::user();
        
        $A =$request->user();
        dd($A); 
        $rol= 4;
        if($rol == 3)
        {
            if($request->getHost() == 'danielypablo.tech')
            {
                return $next($request);
            }
            
           // $request->session()->invalidate();
            abort(403, 'No tiene permisos para acceder a esta página');
            
        }
        else if($rol == 2)
        {
          
            if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.2')
            {
              
                return $next($request);
            }
           // $request->session()->invalidate();
            abort(403, 'No tiene permisos para acceder a esta página');
        }
        else if($rol == 1)
        {
            if($request->getHost() == '192.168.25.2')
            {
                return $next($request);
            }
            //$request->session()->invalidate();
            abort(403, 'No tiene permisos para acceder a esta página');
        }
    
}
}
