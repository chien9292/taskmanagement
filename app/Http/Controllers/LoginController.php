<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public function login(LoginRequest $request, User $userModel)
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            $user = Auth::user();
            //create access_token
            $token = $user->createToken('task', [$user->role.''])->accessToken;
            //update push_token
            $user->update(['push_token', $request->get('push_token')]);
            return response()->json(
                [
                    "message" => "success",
                    'token' => $token,
                    'role' => consts('user.role.admin').'',
                    'id' => $user->id,
                    'name' => $user->name
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
    public function logout(Request $request, User $user)
    {
        $user->update($request->all());
        Auth::user()->token()->revoke();
        return response()->json([
            'code' => 200
        ]);
    }
}
