<?php

namespace Robodocxs\LaravelErpMiddleware\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (UnauthorizedHttpException $e, $request) {
            return response()->json(['message' => 'Unauthorized'], 403);
        });

        $this->renderable(function (ValidationException $e, $request) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 400);
        });

        $this->renderable(function (Exception $e, $request) {
            return response()->json(['message' => $e->getMessage()], 500);
        });
    }
}
