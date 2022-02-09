<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class AuthController extends Controller{
    function login(LoginRequest $request){
        try{
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => $user,
                'role' => $user->getRoleNames(),
                'token' => $token
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 200);
        }
    }

    function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'response' => true,
        ], 200);
    }
}
