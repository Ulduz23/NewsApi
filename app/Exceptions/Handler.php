<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

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
        });

        
        $this->renderable(function (Throwable $e, $request) {
          
            return response()->json([
                'errors' => [
                    'message' => $e->getMessage(),
                ],
                'success' => [
                    'message' => null,
                ],
                'operation' => false,
                'data' => null,
                'status' => $this->getStatusCode($e)
            ], $this->getStatusCode($e));
        });
    }

    protected function getStatusCode($e)
    {
        if ($e instanceof HttpException) {
            return $e->getStatusCode();
        } elseif ($e instanceof AuthorizationException) {
            return 403;
        } elseif ($e instanceof ValidationException) {
            return 422;
        }

        return 500;
    }
}
