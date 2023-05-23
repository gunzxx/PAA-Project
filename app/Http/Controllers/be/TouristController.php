<?php

namespace App\Http\Controllers\be;

use App\Models\Tourist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TouristController extends Controller
{
    /**
     * Method untuk mengambil semua data pariwisata
     */
    public function index()
    {
        $tourists = Tourist::with(['tourist'])->get();

        return response()->json([
            'message' => "Berhasil",
            'data' => $tourists,
        ]);
    }

    /**
     * Method untuk mengambil satu pariwisata
     */
    public function single($id)
    {
        if (auth()->guard("api")->check() == false) {
            return response()->json(['message' => "Not authenticate",], 401);
        }
        
        $tourist = Tourist::find($id);
        if (!$tourist) {
            return response()->json([
                'message' => "Data tidak ditemukan",
                'data'=>[],
            ], 404);
        }

        return response()->json([
            'message' => "Berhasil",
            'data' => $tourist,
        ]);
    }

    /**
     * Method untuk menambah pariwisata
     */
    public function store(Request $request)
    {
        if (auth()->guard("api")->check() == false) {
            return response()->json(['message' => "Not authenticate",], 401);
        }
        
        if (!auth()->guard("api")->user()->hasRole('admin')) {
            return response()->json(['message' => "Anda bukan admin"], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => "Data tidak valid"], 400);
        }

        $tourist = Tourist::create($request->only('name','description','location','location_id'));

        return response()->json([
            'message' => "Data berhasil ditambah",
            'tourist' => $tourist,
        ]);
    }

    /**
     * Method untuk memperbarui pariwisata
     */
    public function update(Request $request)
    {
        if (auth()->guard("api")->check() == false) {
            return response()->json(['message' => "Not authenticate",], 401);
        }

        if (!auth()->guard("api")->user()->hasRole('admin')) {
            return response()->json(['message' => "Anda bukan admin"], 403);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => "Data tidak valid"], 400);
        }

        $id = $request->input("id");
        $tourist = Tourist::find($id);
        
        if (!$tourist) {
            return response()->json([
                'message' => "Data tidak ditemukan",
            ], 404);
        }

        $tourist->update($request->only('name', 'description', 'location', 'location_id'));

        return response()->json([
            'message' => "Data berhasil diubah",
        ]);
    }

    /**
     * Method untuk menghapus pariwisata
     */
    public function delete(Request $request)
    {
        if (auth()->guard("api")->check() == false) {
            return response()->json(['message' => "Not authenticate",], 401);
        }
        
        if (!auth()->guard("api")->user()->hasRole('admin')) {
            return response()->json(['message' => "Anda bukan admin"], 403);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => "Data tidak valid"], 400);
        }

        $tourist = Tourist::find($request->input("id"));
        if (!$tourist) {
            return response()->json([
                'message' => "Data tidak ditemukan",
            ], 404);
        }

        $tourist->delete();
        return response()->json([
            'message' => "Data berhasil dihapus",
        ]);
    }
}
