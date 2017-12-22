<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws AuthorizationException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->guard()->user();

        if ($user && $user->is_superadmin) {
            return $next($request);
        }

        throw new AuthorizationException('You must be an admin to do this.');
    }
}
