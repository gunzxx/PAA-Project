<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->post('email') || !$request->post('password')){
            return response()->json(['message'=>"Data tidak valid!"],400);
        }

        $credentials = [
            'email'=> $request->post('email'),
            'password'=> $request->post('password'),
        ];

        if(!$token = Auth()->guard("api")->attempt($credentials)){
            return response()->json(['message'=>"Login gagal!"], 401);
        }

        return response()->json(['message'=>"Login berhasil",'token'=>$token]);
    }
}
