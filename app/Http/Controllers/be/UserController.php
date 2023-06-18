<?php

namespace App\Http\Controllers\be;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
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
        
        if(!$user){
            return response()->json([
                'message' => "User tidak ditemukan.",
            ],404);
        }

        $user['profile'] = $user->getFirstMediaUrl('profile') == "" ? "https://paa.gunzxx.my.id/img/profile/default.png" : $user->getFirstMediaUrl('profile');
        return response()->json([
            'message' => "Berhasil.",
            "user" => $user,
            "token" => $token,
        ]);
    }

    public function update(Request $request)
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

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
        ]);
        if ($request->file("profile")) {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                "profile" => "mimetypes:image/*|max:4096",
            ]);
        };

        if ($validate->fails()) {
            return response()->json(['message' => "Data tidak valid."], 400);
        }

        $payload = auth()->guard('api')->manager()->getJWTProvider()->decode($token);
        $id = $payload['id'];
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => "User tidak ditemukan.",
            ], 404);
        }

        try{
            if($request->file("profile")){
                $user->addMediaFromRequest("profile")->toMediaCollection("profile");
                $user = User::find($user->id);
                // return response()->json([
                //     "profile" => $user->getFirstMediaUrl("profile"),
                // ]);
            }

            if($request->latitude && $request->longitude){
                $user->update([
                    "name" => $request->name,
                    "latitude" => $request->latitude,
                    "longitude" => $request->longitude,
                    "address" => $request->address,
                ]);
            }else{
                $user->update([
                    "name" => $request->name,
                    "address" => $request->address,
                ]);
            }
    
            return response()->json([
                'message' => "Data berhasil diperbarui.",
                "user" => $user,
                "token" => $token,
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => "Data gagal diperbarui.",
            ],400);
        } catch(QueryException $e){
            return response()->json([
                'message' => "Data gagal diperbarui.",
            ],400);
        }
    }

    public function changePassword(Request $request)
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

        // return $request->all();
        $validate = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required|confirmed|min:3',
            'new_password_confirmation' => 'required|min:3',
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => "Data tidak valid."], 400);
        }

        $payload = auth()->guard('api')->manager()->getJWTProvider()->decode($token);
        $id = $payload['id'];
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => "User tidak ditemukan.",
            ], 404);
        }

        if(!Hash::check($request->password,$user->password)){
            return response()->json(['message' => "Password salah."], 400);
        }

        try{
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
    
            return response()->json([
                'message' => "Password berhasil diperbarui.",
                "user" => $user,
                "token" => $token,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Password gagal diperbarui.",
            ], 400);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Kesalahan query.",
            ], 400);
        }
    }
}
