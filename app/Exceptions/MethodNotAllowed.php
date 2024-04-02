<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use    Throwable;

class MethodNotAllowed extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
     
    }
    public function render($request, Throwable $exception)
    {
        return response()->view('errors.405', [], Response::HTTP_METHOD_NOT_ALLOWED);
    }


}
