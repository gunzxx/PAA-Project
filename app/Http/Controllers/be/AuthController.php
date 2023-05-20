<?php

namespace App\Http\Controllers\be;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(!$request->post('email') || !$request->post('password')){
            return response()->json(['message'=>"Data tidak valid!"],400);
        }
        
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login gagal',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('api')->logout();

        return response()->json(['message'=>"Logout berhasil"]);
    }
}
