<?php

namespace Modules\Api\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Shared\Requests\LoginRequest;

class LoginController
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('web')->attempt($credentials, true)) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('api')->plainTextToken;

            return new JsonResponse([
                'ok' => true,
                'token' => $token,
            ], 200);
        }

        return new JsonResponse([
            'ok' => false,
            'error' => 'Invalid credentials'
        ], 401);
    }
}
