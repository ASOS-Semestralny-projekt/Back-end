<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'users' => User::all()
        ]);
    }

    public function show(): JsonResponse
    {
        return response()->json([
            'user' => auth()->user()
        ]);
    }

    public function update(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->update(request()->all());
        return response()->json([
            'user' => $user
        ]);
    }
}
