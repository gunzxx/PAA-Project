<?php

namespace App\Http\Controllers\be;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => "Sukses",
            "user" => $users,
        ]);
    }

    public function single(Request $request, $id)
    {
        if (!$token = $request->bearerToken()) {
            return response()->json([
                'message ' => "Token required.",
            ], 400);
        }

        if (auth()->guard("api")->check() == false) {
            try {
                $token = auth()->guard('api')->refresh();
            } catch (TokenBlacklistedException $e) {
                return response()->json([
                    'message' => "Token telah diblokir.",
                    'token' => null,
                ], 401);
            } catch (TokenInvalidException $e) {
                return response()->json([
                    'message' => "Token tidak valid.",
                    'token' => null,
                ], 401);
            } catch (JWTException $e) {
                return response()->json([
                    'message' => "Token tidak valid.",
                    'token' => null,
                ], 401);
            }
        }

        $user = User::find($id);
        $user['profile'] = $user->getFirstMediaUrl('profile') == "" ? "https://paa.gunzxx.my.id/img/profile/default.png" : $user->getFirstMediaUrl('profile');
        
        if(!$user){
            return response()->json([
                'message' => "User tidak ditemukan.",
            ],404);
        }
        return response()->json([
            'message' => "Berhasil.",
            "user" => $user,
        ]);
    }

    public function create(Request $request)
    {
        
    }
}
