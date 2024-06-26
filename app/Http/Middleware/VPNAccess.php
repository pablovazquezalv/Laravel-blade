<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        
            //agarrar el usuario de la sesion
            $user = User::where('email',$request->email)->first();
          
            //dd($request->ip());
            if($user)
            {
                $rol = $user->rol_id;
                
                if($rol === 3 && $request->ip() != '192.168.25.17')
                {
                    return $next($request);
                }
                else if($rol === 2)
                {
                    return $next($request);
                }
                else if($rol === 1 && $request->ip() == '192.168.25.17')
                {
                    return $next($request);
                }
                else
                {
                    abort(403, 'No tiene permisos para acceder a esta página');
                }
            }
            else
            {
                Session::flash('error', 'Parece que no puede acceder.');
        
                // Redireccionar a la página de inicio de sesión
                return redirect()->route('login.view');
            }
        }

                  
}
        

    //     //OBTENER EL USUARIO AUTENTICADO
    //     $session = $request->session();
        
    //    $rol = $request->session()->user_id;
    //    dd($rol);
    //     $user = User::find();
    //     $user = Auth::user();

    //      if($user)
    //      {

    //         $rol = $user->rol_id;
    //     if($rol == 3)
    //     {
    //         if($request->getHost() == 'danielypablo.tech')
    //         {
    //             return $next($request);
    //         }
            
    //        // $request->session()->invalidate();
    //         abort(403, 'No tiene permisos para acceder a esta página');
            
    //     }
    //     else if($rol == 2)
    //     {
          
    //         if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.2')
    //         {
    //             return $next($request);
    //         }
    //        // $request->session()->invalidate();
    //         abort(403, 'middleware vpn access No tiene permisos para acceder a esta página');
    //     }
    //     else if($rol == 1)
    //     {
    //         if($request->getHost() == '192.168.25.2')
    //         {
    //             return $next($request);
    //         }
    //         //$request->session()->invalidate();
    //         abort(403, 'No tiene permisos para acceder a esta página');
    //     }
    // }
    // abort(403, 'No se encontro el usuario middleware vpn access');
    

