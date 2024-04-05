<?php

namespace App\Http\Middleware;

use Closure;
use Error;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //si email_verified_at da error o es nulo mandar a informacion
        if($request->user()->email_verified_at === '2024-04-04 01:37:37')
        {
            return redirect('/information');
        }

        return $next($request);
    }
}
