<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserTokenResource;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->authenticate($validated);

        return new UserTokenResource($user);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->register($validated);

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
