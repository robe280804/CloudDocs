<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserDatabaseException;

class ExceptionHandler extends Handler
{
    public function renderException($request, Throwable $exception)
    {
        if ($request->wantsJson()) {

            if ($exception instanceof UserDatabaseException) {
                return response()->json([
                    'error' => $exception->getMessage(),
                ], $exception->getStatusCode() ?? 500);
            }

            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'errors' => $exception->errors()
                ], 422);
            }

            if ($exception instanceof UserNotFoundException) {
                return response()->json([
                    'errors' => $exception->getMessage(),
                ], 404);
            }

            return response()->json([
                'error' => 'Retry later'
            ]);
        }
        return parent::render($request, $exception);
    }
}
