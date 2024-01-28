<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class FirstUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //si el usuario no tiene rol o es igual a 2
        if($request->user()->rol_id == 2 || $request->user()->rol_id == null){
            
        return redirect()->route('app.index');
        }
        return $next($request);
    }
}
