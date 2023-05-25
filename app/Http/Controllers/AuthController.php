<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserTokenResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        return new UserTokenResource($user);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return (new UserTokenResource($user))->response()->setStatusCode(201);
    }

    public function logout(Request $request)
    {
        if (! $request->user()) {
            return response()->json([
                'message' => 'Not logged in',
            ], 404);
        }

        auth()->user()->tokens()->delete();

        return response()->noContent();
    }
}
