<?php

use \Illuminate\Foundation\Application;
use \Illuminate\Foundation\Configuration\Exceptions;
use \Illuminate\Foundation\Configuration\Middleware;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use \Illuminate\Http\Response;
use \Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use \Illuminate\Auth\AuthenticationException;
use \Illuminate\Validation\ValidationException;
use \Illuminate\Http\Exceptions\HttpResponseException;
use \App\Exceptions\RateLimitedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api : __DIR__.'/../routes/api.php',
        apiPrefix : 'api'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'force-api-header' => \App\Http\Middleware\ForceXRequestedHeaderValueMiddleware::class,
            'run-csrf-check' => \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class
        ]);

        $middleware->group('web', [
            // disable defaults
            // \Illuminate\Cookie\Middleware\EncryptCookies
            // \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse
            // \Illuminate\Session\Middleware\StartSession
            // \Illuminate\View\Middleware\ShareErrorsFromSession
            // \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken
            // \Illuminate\Routing\Middleware\SubstituteBindings
        ]);
        $middleware->group('api', [
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // model binding
            \Illuminate\Session\Middleware\StartSession::class, // auth
            'force-api-header',
        ]);
    })->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 419) { // 419 - Laravel specific CSRF error code
                return response()->json([
                    'message' => 'Invalid CSRF token.'
                ], Response::HTTP_FORBIDDEN);
            } else {
                throw new Exception($e->getMessage(), $e->getStatusCode(), $e);
            }
        });
     
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Entity not found.'
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function (RateLimitedException $e, Request $request) {
            return response()->json([
                'message' => 'Rate limited.'
            ], Response::HTTP_TOO_MANY_REQUESTS);
        });

        // Exceptions to consider:
        // Illuminate\Database\Eloquent\MassAssignmentException
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($e->getCode() === Response::HTTP_NOT_FOUND) {
                return response()->json([
                    'message' => 'Unknown route.',
                ], Response::HTTP_NOT_FOUND);
            }

            if (env('APP_ENV') === 'local') {
                var_dump($e->getMessage());
                var_dump($e->getCode());
                var_dump($e->getLine());
                var_dump($e->getFile());
                var_dump(get_class($e));
            }

            return response()->json([
                'message' => 'Internal server error.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();