<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthLoginRequest;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        $user->meals()->createMany([
            ['type' => '🌅 Breakfast'],
            ['type' => '☀️ Lunch'],
            ['type' => '🌙 Dinner'],
        ]);

        return response()->json([
            'user' => $user
        ], 201);
    }

    public function login(AuthLoginRequest $request)
    {
        $data = $request->only('email', 'password');

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Incorrect login or password.'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken("token for {$user->name}")->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token successful deleted.'
        ], 204);
    }
}
