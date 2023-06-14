<?php

namespace App\Http\Controllers\be;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json([
            'message' => "Data berhasil diambil.",
            'data' => $reviews,
        ]);
    }

    public function single($id)
    {
        $reviews = Review::find($id);
        return response()->json([
            'message' => "Data berhasil diambil.",
            'data' => $reviews,
        ]);
    }

    public function create(Request $request)
    {
        if (!$token = $request->bearerToken()) {
            return response()->json([
                'message ' => "Token required.",
            ], 400);
        }
        
        if (auth()->guard("api")->check() == false) {
            try{
                $token = auth()->guard('api')->refresh();
            } catch (TokenBlacklistedException $e) {
                return response()->json([
                    'message' => "Token diblokir.",
                    'token' => null,
                ], 401);
            } catch(TokenInvalidException $e){
                return response()->json([
                    'message' => "Token tidak valid.",
                    'token' => null,
                ],401);
            }
        }

        $validate = Validator::make($request->all(), [
            'text' => 'required',
            'tourist_id' => 'required',
        ]);

        if($validate->fails()){
            return response()->json(['message' => "Data tidak valid."], 400);
        }

        $payload = auth()->guard('api')->manager()->getJWTProvider()->decode($token);
        $user_id = $payload["id"];
        $newData = [
            'text'=>$request->text,
            'tourist_id'=>$request->tourist_id,
            "user_id" => $user_id,
        ];

        try{
            $review = Review::create($newData);

            return response()->json([
                'message' => "Data berhasil ditambahkan.",
                'data' => $review,
                'token' => $token ?? null,
            ]);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Data gagal ditambahkan.",
            ],400);
        }
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
                    'message' => "Token diblokir.",
                    'token' => null,
                ], 401);
            } catch (TokenInvalidException $e) {
                return response()->json([
                    'message' => "Token tidak valid.",
                    'token' => null,
                ], 401);
            }
        }

        $validate = Validator::make($request->all(), [
            'id' => 'required',
            'text' => 'required',
            'tourist_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['message' => "Data tidak valid."], 400);
        }

        $review = Review::find($request->id);
        if(!$review){
            return response()->json(['message' => "Data tidak ditemukan."], 404);
        }
        
        try{
            $review->update($validate->getData());
            return response()->json([
                'message' => "Data berhasil diperbarui.",
                'data' => Review::find($review->id),
                'token' => $token ?? null,
            ]);
        } catch(QueryException $e){
            return response()->json([
                'message' => "Data gagal diperbarui.",
            ], 400);
        }
    }

    public function delete(Request $request)
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
                    'message' => "Token diblokir.",
                    'token' => null,
                ], 401);
            } catch (TokenInvalidException $e) {
                return response()->json([
                    'message' => "Token tidak valid.",
                    'token' => null,
                ], 401);
            }
        }

        $validate = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['message' => "Data tidak valid."], 400);
        }

        $review = Review::find($request->id);
        if (!$review) {
            return response()->json(['message' => "Data tidak ditemukan."], 404);
        }

        $review->delete();
        return response()->json([
            'message' => "Data berhasil dihapus.",
            'token' => $token ?? null,
        ]);
    }
}
