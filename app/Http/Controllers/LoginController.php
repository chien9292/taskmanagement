<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Login
     * @param  App\Http\Requests\Auth\LoginRequest  $request
     * @return ResponseFactory->json()
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            $user = Auth::user();
            $token = $user->createToken('task', [$user->role.''])->accessToken;
            return response()->json(
                [
                    "message" => "success",
                    'token' => $token,
                    'role' => consts('user.role.admin').''
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Incorrect email or password'
                ]
            );
        }
    }

    /**
     * Logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json([
            'code' => 200
        ]);
    }
}
