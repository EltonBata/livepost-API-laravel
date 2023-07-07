<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class PostJsonException extends Exception
{

    public function report()
    {

    }


    /**
     * Summary of render
     * @param \Illuminate\Http\Request $request
     * 
     */
    public function render($request)
    {

        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage()
            ]
        ], $this->code);

    }
}