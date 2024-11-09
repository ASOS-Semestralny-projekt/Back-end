<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserLoggedIn
{
    /**
     * Check if the user is logged in.
     * If not, return a 401 response.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Please log in'
            ])->setStatusCode(401);
        }

        return $next($request);
    }
}
