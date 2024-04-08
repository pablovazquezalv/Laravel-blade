<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
class DomainAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userId = session('user_id');

        
        $user = User::find($userId);


        if($user->rol_id === 1)
        {
            if($request->getHost() == '192.168.25.8')
            {
                return $next($request);
            }
            abort(403);
        }

        // if ($request->user()->hasRole($role)) 
        // {
            
        //     if($request->getHost() == 'danielypablo.tech')
        //     {
        //         return $next($request);
        //     }
        //     $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
        // }
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');


    }
}
