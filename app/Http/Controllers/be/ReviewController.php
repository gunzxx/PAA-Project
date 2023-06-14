<?php

namespace App\Http\Controllers\be;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

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
        if(!$request->bearerToken()){
            return response()->json([
                'message '=> "Token required.",
            ],401);
        }

        $validate = Validator::make($request->all(), [
            'text' => 'required',
            'tourist_id' => 'required',
        ]);

        if($validate->fails()){
            return response()->json(['message' => "Data tidak valid."], 400);
        }

        $payload = Auth::guard('api')->parseToken()->getPayload();
        $user_id = $payload->get("id");
        $newData = [
            'text'=>$request->text,
            'tourist_id'=>$request->tourist_id,
            "user_id" => $user_id,
        ];

        try{
            $review = Review::create($newData);

            if (auth()->guard("api")->check() == false) {
                $token = Auth::guard('api')->refresh();
            }
            return response()->json([
                'message' => "Data berhasil ditambahkan.",
                'data' => $review,
                'token' => $token??null,
            ]);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Data gagal ditambahkan.",
            ],400);
        }
    }

    public function update(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'message ' => "Token required.",
            ], 401);
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
            if (auth()->guard("api")->check() == false) {
                $token = Auth::guard('api')->refresh();
            }
            $review->update($validate->getData());
            return response()->json([
                'message' => "Data berhasil diperbarui.",
                'data' => Review::find($review->id),
                'token' => $token??null,
            ]);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Data gagal diperbarui.",
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'message ' => "Token required.",
            ], 401);
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
        if (auth()->guard("api")->check() == false) {
            $token = Auth::guard('api')->refresh();
        }
        return response()->json([
            'message' => "Data berhasil dihapus.",
            'token' => $token??null,
        ]);
    }
}
