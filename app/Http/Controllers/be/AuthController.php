<?php

namespace App\Http\Controllers\be;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->guard("api")->check()) {
            return response()->json(['message' => "You are authenticate",], 400);
        }
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => "Data tidak valid"], 400);
        }
        
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'message' => 'Login gagal',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        $user['profile'] = $user->getFirstMediaUrl('profile') ?? "";
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function register(Request $request)
    {
        if (auth()->guard("api")->check() == true) {
            return response()->json(['message' => "You are authenticate",], 400);
        }

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['message'=>"Data tidak valid"],400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            $user->assignRole('visitor');
            
            return response()->json([
                'message' => 'Register berhasil',
                'user' => $user,
            ],201);
        }catch(QueryException $e){
            $message = "Queri error";
            if($e->errorInfo[1] == 1062){
                $message = "Email duplikat";
            }
            return response()->json([
                'message' => $message,
            ],400);
        }
        // catch(QueryException $e){}
    }

    public function logout(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'message ' => "Token required.",
            ], 401);
        }

        if (auth()->guard("api")->check() == false) {
            return response()->json(['message' => "Not authenticate",], 401);
        }
        
        Auth::guard('api')->logout();

        return response()->json(['message'=>"Logout berhasil"]);
    }

    public function refresh(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'message ' => "Token required.",
            ], 401);
        }
        return response()->json([
            'message' => 'Token refresh.',
            'token' => Auth::guard('api')->refresh(),
        ],400);
    }
}
