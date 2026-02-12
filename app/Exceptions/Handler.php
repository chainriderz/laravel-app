<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    private function debugError(Throwable $e)
    {
        return app()->environment(['local', 'development']) ? $e->getMessage() : null;
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {

            /* ------------------ AUTH & ACCESS ------------------ */

            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                    'errors'  => $this->debugError($e),
                    'data'    => null,
                ], 401);
            }

            if ($e instanceof AuthorizationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden',
                    'errors'  => $this->debugError($e),
                    'data'    => null,
                ], 403);
            }

            /* ------------------ VALIDATION ------------------ */

            if ($e instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors'  => $e->errors(),
                ], 422);
            }

            /* ------------------ ROUTING ------------------ */

            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Route not found',
                    'errors'  => $this->debugError($e),
                    'data'    => null,
                ], 404);
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'HTTP method not allowed',
                    'data'    => null,
                ], 405);
            }

            /* ------------------ MODEL & DB ------------------ */

            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found',
                    'errors'  => $this->debugError($e),
                    'data'    => null,
                ], 404);
            }

            if ($e instanceof QueryException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database error occurred',
                    'errors'  => $this->debugError($e),
                    'data'    => null,
                ], 500);
            }

            /* ------------------ RATE LIMITING ------------------ */

            if ($e instanceof TooManyRequestsHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many requests. Please try again later.',
                    'data'    => null,
                ], 429);
            }

            /* ------------------ HTTP EXCEPTIONS ------------------ */

            if ($e instanceof HttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'HTTP error occurred',
                    'errors'  => $this->debugError($e),
                    'data'    => null,
                ], $e->getStatusCode());
            }

            /* ------------------ FALLBACK (500) ------------------ */

            $exception = "Exception details: <br>";
            $exception .= "Message: " . $e->getMessage() . "<br>";
            $exception .= "Code: " . $e->getCode() . "<br>";
            $exception .= "File: " . $e->getFile() . "<br>";
            $exception .= "Line: " . $e->getLine() . "<br>";
            // Log the actual error for developers
            \Log::error('Unhandled API Exception', [
                'exception' => $exception,
                'url'       => $request->fullUrl(),
                'input'     => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'errors'  => $this->debugError($e),
                'data'    => null,
            ], 500);
        }

        return parent::render($request, $e);
    }
}
