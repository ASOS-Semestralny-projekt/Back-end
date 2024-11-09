<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'street' => ['required', 'string', 'max:255'],
                'house_number' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'zip_code' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'errors' => $e->getMessage(),
            ])->setStatusCode(400);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'street' => $request->street,
            'house_number' => $request->house_number,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->string('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'message' => 'Registration successful',
        ])->setStatusCode(201);
    }
}
