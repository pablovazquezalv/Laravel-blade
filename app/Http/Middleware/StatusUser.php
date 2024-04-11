<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user = User::where('email',$request->email)->first();
      
      dd($user);
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
        //mandar a login
        return redirect('/login');
      }
      }
      abort(403, 'no hay usuario middleware status user');
    }
}
