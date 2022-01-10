<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $vaidator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|confirmed|min:8|string'
        ]);
        //? another solution
        // $vaidator = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|string|max:255|unique:users',
        //     'password'=>'required|confirmed|min:8|string'
        // ]);
        if ($vaidator->fails()) {
            return response()->json($vaidator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],);
    }
    public function login(Request $request)
    {


        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Hi ' . $user->name . ' ,welcome back', 'access_token' => $token, 'token_type' => 'Bearer'], 200);
    }


    public function logout(Request $request)
    {
        $request->auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
