<?php

use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\TrackVisitor;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /*
        |--------------------------------------------------------------------------
        | Route middleware aliases
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Global web middleware
        |--------------------------------------------------------------------------
        */

        $middleware->web(append: [
            TrackVisitor::class,
            ContentSecurityPolicy::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
        |--------------------------------------------------------------------------
        | Exceptions that should not be reported
        |--------------------------------------------------------------------------
        |
        | These exceptions normally occur because of user actions and generally
        | do not need to be written to the Laravel error log.
        |
        */

        $exceptions->dontReport([
            AuthenticationException::class,
            AuthorizationException::class,
            ValidationException::class,
            TokenMismatchException::class,
            NotFoundHttpException::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Determine when JSON should be returned
        |--------------------------------------------------------------------------
        */

        $exceptions->shouldRenderJsonWhen(function (
            Request $request,
            \Throwable $exception
        ): bool {
            return $request->is('api/*')
                || $request->expectsJson();
        });

        /*
        |--------------------------------------------------------------------------
        | Authentication error: 401
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthenticationException $exception,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Authentication is required.',
                ], 401);
            }

            return redirect()
                ->guest(route('login'))
                ->with(
                    'error',
                    'Please log in to access this page.'
                );
        });

        /*
        |--------------------------------------------------------------------------
        | Authorization error: 403
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthorizationException $exception,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'You are not authorized to perform this action.',
                ], 403);
            }

            return response()->view('errors.403', [
                'message' =>
                    'You do not have permission to access this resource.',
            ], 403);
        });

        /*
        |--------------------------------------------------------------------------
        | CSRF/session expired error: 419
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            TokenMismatchException $exception,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'Your session has expired. Please refresh the page.',
                ], 419);
            }

            return response()->view('errors.419', [], 419);
        });

        /*
        |--------------------------------------------------------------------------
        | Database query errors
        |--------------------------------------------------------------------------
        |
        | SQL queries, database names, credentials and exception messages must
        | never be displayed to users in the production environment.
        |
        */

        $exceptions->render(function (
            QueryException $exception,
            Request $request
        ) {
            if (! app()->environment('production')) {
                return null;
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'We could not process your request at this time.',
                ], 500);
            }

            return response()->view('errors.500', [
                'reference' => $request->attributes->get(
                    'error_reference'
                ),
            ], 500);
        });

        /*
        |--------------------------------------------------------------------------
        | HTTP errors: 404, 405, 429, 503 etc.
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            HttpExceptionInterface $exception,
            Request $request
        ) {
            if (! app()->environment('production')) {
                return null;
            }

            $status = $exception->getStatusCode();

            $message = match ($status) {
                400 => 'The request could not be understood.',
                401 => 'Authentication is required.',
                403 => 'You are not authorized to access this resource.',
                404 => 'The requested resource was not found.',
                405 => 'This request method is not allowed.',
                408 => 'The request took too long to complete.',
                419 => 'Your session has expired.',
                422 => 'The submitted information is invalid.',
                429 => 'Too many requests. Please try again later.',
                500 => 'An unexpected server error occurred.',
                503 => 'The service is temporarily unavailable.',
                default => 'The request could not be completed.',
            };

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], $status);
            }

            if (view()->exists("errors.{$status}")) {
                return response()->view(
                    "errors.{$status}",
                    [],
                    $status
                );
            }

            return response()->view('errors.generic', [
                'statusCode' => $status,
                'title' => Response::$statusTexts[$status]
                    ?? 'Request Error',
                'message' => $message,
            ], $status);
        });

        /*
        |--------------------------------------------------------------------------
        | Unexpected server errors
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            \Throwable $exception,
            Request $request
        ) {
            if (! app()->environment('production')) {
                return null;
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'An unexpected error occurred. Please try again.',
                ], 500);
            }

            return response()->view('errors.500', [], 500);
        });
    })
    ->create();
