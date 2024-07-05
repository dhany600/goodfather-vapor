<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the current route is the login route
        // dd($request->routeIs('login.index'));
        if ($request->routeIs('login.index')) {
            return $next($request);
        }

        $user = Auth::user();
        // dd($user->role);
        if (!$user) {
            \Log::warning('Unauthorized access: No authenticated user.');
            return Redirect::route('login'); // Redirect to login route
        }

        if (!in_array($user->role, $roles)) {
            \Log::warning("Unauthorized access: User {$user->id} does not have any of the required roles.");
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
