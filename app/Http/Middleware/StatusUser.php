<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user = Auth::user();
      
      
//      dd($user->status);
      $status = $user->status;
         
      if($status == true)
      {
        return $next($request);
      }
      else
      {
        return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
      }
      //rediregir a la vista de que su cuenta no ha sido verificada
      abort(403, 'No tiene permisos para acceder a esta página');
    }
}
