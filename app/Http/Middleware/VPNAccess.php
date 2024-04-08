<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VPNAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if ($request->user()->hasRole($role)) 
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
}