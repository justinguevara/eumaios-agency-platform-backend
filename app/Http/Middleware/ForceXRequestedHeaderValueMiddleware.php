<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceXRequestedHeaderValueMiddleware
{
    /**
     * The laravel framework will return a JSON response, as opposed to a redirect response,
     * when the request header X-Requested-With has the value of XMLHttpRequest.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');

        $response = $next($request);

        return $response;
    }
}
