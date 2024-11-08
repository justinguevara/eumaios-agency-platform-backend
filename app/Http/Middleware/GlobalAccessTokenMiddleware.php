<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GlobalAccessTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->headers->get('Authorization');

        // ~~~ TODO
        if ($access_token !== 'gjg8xxFeivuMSyow1PWtDtaGGwMRSIML') {
            throw new AccessDeniedHttpException();
        }

        $response = $next($request);

        return $response;
    }
}
