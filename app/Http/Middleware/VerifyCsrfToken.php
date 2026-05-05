<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, \Closure $next)
    {
        // Add CSRF token to response headers for debugging
        if ($request->isMethod('GET')) {
            $response = $next($request);
            if (method_exists($response, 'header')) {
                $response->header('X-CSRF-Token', csrf_token());
            }
            return $response;
        }

        return parent::handle($request, $next);
    }
}
