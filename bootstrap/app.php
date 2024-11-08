<?php

use \Illuminate\Foundation\Application;
use \Illuminate\Foundation\Configuration\Exceptions;
use \Illuminate\Foundation\Configuration\Middleware;
use \App\Http\Middleware\ForceXRequestedHeaderValueMiddleware;
use \Illuminate\Http\Response;
use \Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use \Illuminate\Auth\AuthenticationException;
use \Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api : __DIR__.'/../routes/api.php',
        apiPrefix : 'api',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('web', []); // TODO review
        $middleware->group('api', [
            // TODO review comment - disable default middleware
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Session\Middleware\StartSession::class,
        ]);

        $middleware->append(ForceXRequestedHeaderValueMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Entity not found'
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        });

        // Illuminate\Database\Eloquent\MassAssignmentException
        $exceptions->render(function (Throwable $e, Request $request) {
            if (env('APP_ENV') === 'local') {
                var_dump($e->getMessage());
                var_dump(get_class($e));
            }

            return response()->json([
                'message' => 'Internal server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();