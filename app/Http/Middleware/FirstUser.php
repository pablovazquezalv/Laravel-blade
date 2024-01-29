<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class FirstUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userId = session('user_id');
        
        if($userId)
        {
            $user = User::find($userId);
            if($user->rol_id === 1)
            {
                return $next($request);
            }
        }
      
        return redirect()->route('app.index');
    }
}
