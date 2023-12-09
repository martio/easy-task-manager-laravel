<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->reportable(reportUsing: function (Throwable $e): void {
        });

        $this->renderable(renderUsing: function (Throwable $e, Request $request): ?JsonResponse {
            if ( ! $request->is(patterns: 'api/*')) {
                return null;
            }

            $status = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
            $errors = [];

            if ($e instanceof NotFoundHttpException) {
                $message = 'http_not_found';
                $status = SymfonyResponse::HTTP_NOT_FOUND;
            } elseif ($e instanceof AuthenticationException) {
                $message = 'unauthenticated';
                $status = SymfonyResponse::HTTP_FORBIDDEN;
            } elseif ($e instanceof AccessDeniedHttpException) {
                $message = 'unauthorized';
                $status = SymfonyResponse::HTTP_FORBIDDEN;
            } elseif ($e instanceof ValidationException) {
                $message = 'invalid_data';
                $status = SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY;
                $errors = $e->validator->errors()->messages();
            } else {
                $message = 'unknown_error';

                if ($e->getCode()) {
                    $status = $e->getCode();
                }
            }

            $data = [
                'status' => 'failure',
                'message' => $message,
            ];

            if ( ! empty($errors)) {
                $data['errors'] = $errors;
            }

            if (app()->environment(['local', 'testing'])) {
                $data['exception'] = [
                    'class' => $e::class,
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ];
            }

            return response()->json(
                data: $data,
                status: $status,
            );
        });
    }
}
