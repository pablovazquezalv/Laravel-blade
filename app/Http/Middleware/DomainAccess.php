<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

use function Laravel\Prompts\alert;

class DomainAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = User::where('email',$request->email)->first();
                 
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
                  $request->session()->invalidate();
                  $request->session()->regenerateToken();
                  alert('Su cuenta no ha sido verificada');
                  return redirect()->route('login.view');
                  
              }
              else if($rol == 2)
              {
                
                  if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.2')
                  {
                    
                      return $next($request);
                  }
                  $request->session()->invalidate();
                  $request->session()->regenerateToken();
                  return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
              }
              else if($rol == 1)
              {
                  if($request->getHost() == '192.168.25.2')
                  {
                      return $next($request);
                  } 
                  $request->session()->invalidate();
                  $request->session()->regenerateToken();
                  return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
              }
              $request->session()->invalidate();
              $request->session()->regenerateToken();
              return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
       
          }
        //   $request->session()->invalidate();
        //   $request->session()->regenerateToken();
        //   return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
          abort(403);

        
    }
}
        
    //     $userId = session('user_id');

        
    //     $user = User::find($userId);

    //     if($user)
    //     {
            
    //     if($user->rol_id === 1)
    //     {
    //         if($request->getHost() == '192.168.25.0')
    //         {
    //             return $next($request);
    //         }
    //         abort(403);
    //     }
    //     if($user->rol_id === 2)
    //     {
    //         if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.0')
    //         {
    //             return $next($request);
    //         }
    //         abort(403);
    //     }
    //     if($user->rol_id === 3)
    //     {
    //         if($request->getHost() == 'danielypablo.tech')
    //         {
    //             return $next($request);
    //         }
    //         abort(403);
    //    }
    // }
    // abort(404);
    // }

