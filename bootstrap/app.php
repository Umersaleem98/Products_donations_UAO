<?php

use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SecurityHeaders;
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

return Application::configure(
    basePath: dirname(__DIR__)
)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /*
        |--------------------------------------------------------------------------
        | Route Middleware Aliases
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Global Web Middleware
        |--------------------------------------------------------------------------
        |
        | SecurityHeaders adds:
        |
        | - X-Frame-Options
        | - X-Content-Type-Options
        | - Referrer-Policy
        | - Permissions-Policy
        |
        | ContentSecurityPolicy adds:
        |
        | - Content-Security-Policy-Report-Only
        |
        */

        $middleware->web(append: [
            SecurityHeaders::class,
            ContentSecurityPolicy::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
        |--------------------------------------------------------------------------
        | Exceptions That Should Not Be Reported
        |--------------------------------------------------------------------------
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
        | Determine When JSON Should Be Returned
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
        | Authentication Error: 401
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthenticationException $exception,
            Request $request
        ) {
            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
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
        | Authorization Error: 403
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthorizationException $exception,
            Request $request
        ) {
            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
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
        | CSRF or Session Expired Error: 419
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            TokenMismatchException $exception,
            Request $request
        ) {
            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'Your session has expired. Please refresh the page.',
                ], 419);
            }

            if (view()->exists('errors.419')) {
                return response()->view(
                    'errors.419',
                    [],
                    419
                );
            }

            return response(
                'Your session has expired. Please refresh the page.',
                419
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Validation Errors: 422
        |--------------------------------------------------------------------------
        |
        | Normal web form validation will continue to redirect back with errors.
        | JSON requests will receive a safe JSON response.
        |
        */

        $exceptions->render(function (
            ValidationException $exception,
            Request $request
        ) {
            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'The submitted information is invalid.',
                    'errors' => $exception->errors(),
                ], 422);
            }

            return null;
        });

        /*
        |--------------------------------------------------------------------------
        | Database Query Errors
        |--------------------------------------------------------------------------
        |
        | Database and SQL information will not be displayed in production.
        | In the local environment, returning null allows Laravel to display
        | the original exception for debugging.
        |
        */

        $exceptions->render(function (
            QueryException $exception,
            Request $request
        ) {
            if (! app()->environment('production')) {
                return null;
            }

            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'We could not process your request at this time.',
                ], 500);
            }

            if (view()->exists('errors.500')) {
                return response()->view('errors.500', [
                    'reference' => $request->attributes->get(
                        'error_reference'
                    ),
                ], 500);
            }

            return response(
                'An internal server error occurred.',
                500
            );
        });

        /*
        |--------------------------------------------------------------------------
        | HTTP Errors
        |--------------------------------------------------------------------------
        |
        | Handles 400, 404, 405, 408, 419, 422, 429, 503 and other HTTP errors.
        |
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

            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], $status);
            }

            if (view()->exists("errors.{$status}")) {
                return response()->view(
                    "errors.{$status}",
                    [
                        'message' => $message,
                    ],
                    $status
                );
            }

            if (view()->exists('errors.generic')) {
                return response()->view('errors.generic', [
                    'statusCode' => $status,
                    'title' => Response::$statusTexts[$status]
                        ?? 'Request Error',
                    'message' => $message,
                ], $status);
            }

            return response(
                $message,
                $status
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Unexpected Server Errors
        |--------------------------------------------------------------------------
        |
        | This is the final fallback handler for unexpected exceptions.
        |
        */

        $exceptions->render(function (
            \Throwable $exception,
            Request $request
        ) {
            if (! app()->environment('production')) {
                return null;
            }

            if (
                $request->is('api/*')
                || $request->expectsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'An unexpected error occurred. Please try again.',
                ], 500);
            }

            if (view()->exists('errors.500')) {
                return response()->view(
                    'errors.500',
                    [],
                    500
                );
            }

            return response(
                'An unexpected server error occurred.',
                500
            );
        });
    })
    ->create();
