<?php

namespace App\Exceptions;

use Exception;

class OutOfOrderException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
