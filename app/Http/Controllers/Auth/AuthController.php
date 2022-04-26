<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */


    public function login(Request $request): JsonResponse
    {
        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential)) {
            return response()->json(Auth::user(), 200);
        }
        throw new AuthenticationException();
    }

    public function register(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate) {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'Account created successfully',
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unable to register an user.'
            ], 401);
        }

    }


    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

}
