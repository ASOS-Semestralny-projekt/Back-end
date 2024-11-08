<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            if(auth()->user()){
                throw new AuthenticationException('User already logged in');
            }
            $request->authenticate();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'errors' => $e->getMessage(),
            ])->setStatusCode(400);
        }

        $request->session()->regenerate();

        return response()->json([
            'session_token' => $request->session()->token(),
            'user_id' => auth()->user()->id,
            'first_name' => auth()->user()->first_name,
            'last_name' => auth()->user()->last_name,
        ])->setStatusCode(200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Logout failed',
                'errors' => 'User not logged in'
            ])->setStatusCode(401);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful'
        ])->setStatusCode(200);
    }
}
