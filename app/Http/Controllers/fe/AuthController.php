<?php

namespace App\Http\Controllers\fe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!$token = Auth::guard('api')->attempt($validate)) {
            return redirect('/login')->with("error", 'Login gagal');
        }

        if (!Auth::guard('web')->attempt($validate)) {
            return redirect('/login')->with("error", 'Login gagal');
        }

        session(['jwt' => $token]);
        $domain = request()->getHost() != "127.0.0.1" ? 'gunzxx.my.id' : null;

        return redirect('/admin/home')->with("success",'Login berhasil')->cookie('jwt',$token,1440,"/",null,false,false);
    }

    public function logout()
    {
        if(!session("jwt")){
            return response()->json('Data tidak valid');
        }
        session()->forget('jwt');
        
        Auth::guard('web')->logout();

        return redirect('/');
    }
}
