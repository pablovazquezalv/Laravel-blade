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

        ///dd($request->user());

        
        $user = User::where('email',$request->email)->first();
        
        if($user)
        {
            //Hash::check($request->password,$user->password);

            if($user->rol_id === 1)
            {
                dd($request->getHost());
                if($request->getHost() == '192.168.25.2')
                {
                    return $next($request);
                }
                abort(404);
            }
            else if($user->rol_id === 2)
            {
                dd($request->getHost());
                if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.2')
                {
                    return $next($request);
                }
                abort(403);
            }
            else if($user->rol_id === 3)
            {
                if($request->getHost() == 'danielypablo.tech')
                {
                    return $next($request);
                }
                abort(403);

            }

        }


         
        abort(403);
    }
}
        
    //     $userId = session('user_id');

        
    //     $user = User::find($userId);

    //     if($user)
    //     {
            
    //     if($user->rol_id === 1)
    //     {
    //         if($request->getHost() == '192.168.25.0')
    //         {
    //             return $next($request);
    //         }
    //         abort(403);
    //     }
    //     if($user->rol_id === 2)
    //     {
    //         if($request->getHost() == 'danielypablo.tech' || $request->getHost() == '192.168.25.0')
    //         {
    //             return $next($request);
    //         }
    //         abort(403);
    //     }
    //     if($user->rol_id === 3)
    //     {
    //         if($request->getHost() == 'danielypablo.tech')
    //         {
    //             return $next($request);
    //         }
    //         abort(403);
    //    }
    // }
    // abort(404);
    // }

