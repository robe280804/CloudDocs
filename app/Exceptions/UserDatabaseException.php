<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Throwable;

class UserDatabaseException extends Exception
{
    protected int $statusCode;

    public function __construct(
        string $message = "Errore lato server",
        int $code = 0,
        ?Throwable $previous = null,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {
        parent::__construct($message, $code, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
