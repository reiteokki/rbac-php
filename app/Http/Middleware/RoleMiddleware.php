<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes: ->middleware('role:super')
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Forbidden: not logged in.');
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Forbidden: insufficient permissions.');
    }
}
