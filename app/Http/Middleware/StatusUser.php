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
      
      
      if($user)
      {
        $status = $user->status;
          
        if($status === true)
        {
          return $next($request);
        }
        else
        {
          return redirect()->route('login.view');
        }
      }
      else if(Auth::user())
      {
        $status = Auth::user()->status;
          
        if($status == true)
        {
          return $next($request);
        }
        else
        {
          return redirect()->route('login.view');
        }
      }
      
      abort(403, 'no hay usuario middleware status user');
    }
}
