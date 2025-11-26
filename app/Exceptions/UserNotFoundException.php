<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Response;

class UserNotFoundException extends Exception
{
    protected int $statusCode;

    public function __construct(
        string $message = "User not found",
        int $code = 0,
        ?Throwable $previous = null,
        int $statusCode = Response::HTTP_NOT_FOUND
    ) {
        parent::__construct($message, $code, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
