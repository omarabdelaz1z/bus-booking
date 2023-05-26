<?php

namespace App\Exceptions;

use Exception;

class NonExistentException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
        ], 400);
    }
}
