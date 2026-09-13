<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
            /** @var User $user */
            $user = Auth::user();

            if (in_array($user->getRole(), $roles, true)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access.');
    }
}
