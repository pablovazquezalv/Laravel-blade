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
      
      if($user)
      {
        
//      dd($user->status);
      $status = $user->status;
         
      if($status == true)
      {
        return $next($request);
      }
      else
      {
        abort(403, 'no tienes acceso ');
      }
      }
      abort(403, 'no hay usuario middleware status user');
    }
}
