<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'token' => $request->user()->createToken($request->get('email'))->plainTextToken,
            'message' => 'Success'
        ]);
    }

    public function logout(Request $request) : JsonResponse
    {
        $deleted = $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => $deleted ? 'Success' : 'Error']);
    }
}
