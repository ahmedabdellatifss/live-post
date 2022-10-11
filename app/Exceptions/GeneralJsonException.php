<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    /**
     * Report the exception
     *
     * @return void
     */
    // public function report()
    // {
    //     //dump('avss');
    // }

    /**
     *
     * Render the exception as an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     */

    public function render($request)
    {
        return new JsonResponse([
            'errors' =>[
                'message'=> $this->getMessage(),
            ]
        ], $this->code);
    }
}
