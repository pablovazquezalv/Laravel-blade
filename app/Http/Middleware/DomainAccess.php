<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DomainAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user()->rol_id == 3)
        {
            return $next($request);
        }
        else if($request->user()->rol_id == 2)
        {
            if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.2')
            {
                return $next($request);
            }
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
        }
        else if($request->user()->rol_id == 1)
        {

            if($request->getHost() == '192.168.25.2')
            {

            }
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login.view')->with('status','Su cuenta no ha sido verificada');
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
