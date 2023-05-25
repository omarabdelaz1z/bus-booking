<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
