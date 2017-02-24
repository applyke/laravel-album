<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->hasRole($role) === false) {
            return response()->json([
                'error' => "There were some problems with your role"
            ], 401);
        }

        return $next($request);
    }

}
