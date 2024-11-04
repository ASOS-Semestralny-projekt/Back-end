<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

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

    /**
     * @throws ValidationException
     */
    public function updatePassword(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $data = request()->validate([
                'old_password' => 'required',
                'new_password' => ['required', Rules\Password::defaults()],
                'new_password_repeat' => ['required', Rules\Password::defaults(), 'same:new_password'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The new passwords do not match.',
            ])->setStatusCode(400);
        }

        if (!Hash::check($data['old_password'], $user->password)) {
            return response()->json([
                'message' => 'The provided password does not match your current password.'
            ])->setStatusCode(400);
        }

        $user->update([
            'password' => Hash::make(request('new_password'))
        ]);

        return response()->json([
            'message' => 'Password updated successfully.'
        ])->setStatusCode(200);
    }
}
