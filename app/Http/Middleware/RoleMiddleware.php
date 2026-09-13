<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
       
        if (Auth::check()) {
            /** @var Client $client */
            $client = Auth::user();

            if (in_array($client->getRole(), $roles, true)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access.');
    }
    
}
