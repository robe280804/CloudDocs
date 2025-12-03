<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Response;

class BadCredentialException extends Exception
{

    protected int $statusCode;

    public function __construct(
        string $message = "Bad credentials",
        int $code = 0,
        ?Throwable $previous = null,
        int $statusCode = Response::HTTP_UNAUTHORIZED
    ) {
        parent::__construct($message, $code, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
