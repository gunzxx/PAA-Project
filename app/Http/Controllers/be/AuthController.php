<?php

namespace App\Http\Controllers\be;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
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
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        if(!$request->post('name') || !$request->post('email') || !$request->post('password') || !$request->post('address')){
            return response()->json(['message'=>"Data tidak valid!"],400);
        }

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'address' => $request->address,
            ]);
            
            return response()->json([
                'message' => 'Register berhasil',
                'user' => $user,
            ]);
        }catch(QueryException $e){
            return response()->json([
                'message' => 'Query error',
                'error'=>$e->errorInfo,
            ],401);
        }
        // }catch(QueryException $e){}
    }

    public function logout(Request $request)
    {
        Auth::guard('api')->logout();

        return response()->json(['message'=>"Logout berhasil"]);
    }
}
