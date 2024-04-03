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
    public function handle(Request $request, Closure $next,$role): Response
    {
        if ($request->user()->hasRole($role)) 
        {
            
            if($request->getHost() == 'danielypablo.tech')
            {
                return $next($request);
            }
            return response('Unauthorized 2.', 401);
        }
        return response('Unauthorizedd.', 401);

        
    }
}
