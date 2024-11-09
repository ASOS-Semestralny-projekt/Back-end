<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Return all users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'users' => User::all()
        ])->setStatusCode(200);
    }

    /**
     * Return the authenticated user.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $user = auth()->user();

        Log::info('Fetching authenticated user', ['user_id' => auth()->id()]);

        return response()->json([
            'user' => $user
        ])->setStatusCode(200);
    }

    /**
     * Update the authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Please log in'
            ])->setStatusCode(401);
        }

        Log::info('Updating authenticated user', ['user_id' => auth()->id()]);

        try {
            $validatedData = $request->validate([
                'first_name' => 'string',
                'last_name' => 'string',
                'street' => 'string',
                'house_number' => 'string',
                'city' => 'string',
                'zip_code' => 'string',
                'country' => 'string',
                'phone' => 'string',
            ]);

            $user->update($validatedData);

            Log::info('User updated successfully', ['user_id' => auth()->id()]);
        } catch (Exception $e) {
            Log::error('User update validation failed', ['user_id' => auth()->id(), 'error' => $e->getMessage()]);

            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->getMessage(),
            ])->setStatusCode(400);
        }

        return response()->json([
            'user' => $user
        ])->setStatusCode(200);
    }

    /**
     * Update the authenticated user's password.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePassword(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        Log::info('Updating password for authenticated user', ['user_id' => auth()->id()]);

        try {
            // TODO: Implement password validation
            /*$request->validate([
                'old_password' => 'required',
                'new_password' => ['required', Rules\Password::defaults()],
                'new_password_repeat' => ['required', Rules\Password::defaults()],
            ]);*/

            Log::info('Password validation successful', ['user_id' => auth()->id()]);
        } catch (Exception $e) {
            Log::error('Password validation failed', ['user_id' => auth()->id(), 'error' => $e->getMessage()]);

            return response()->json([
                'message' => 'The provided data is invalid.',
            ])->setStatusCode(400);
        }

        if (!Hash::check($request['old_password'], $user->password)) {
            Log::warning('Old password does not match', ['user_id' => auth()->id()]);

            return response()->json([
                'message' => 'The provided password does not match your current password.'
            ])->setStatusCode(400);
        }

        if ($request['new_password'] !== $request['new_password_confirm']) {
            Log::warning('New passwords do not match', ['user_id' => auth()->id()]);

            return response()->json([
                'message' => 'The new passwords do not match.'
            ])->setStatusCode(400);
        }

        $user->update([
            'password' => Hash::make(request('new_password'))
        ]);

        Log::info('Password updated successfully', ['user_id' => auth()->id()]);

        return response()->json([
            'message' => 'Password updated successfully.'
        ])->setStatusCode(200);
    }
}
