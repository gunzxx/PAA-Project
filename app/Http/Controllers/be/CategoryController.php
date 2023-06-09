<?php

namespace App\Http\Controllers\be;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Method untuk mengambil semua data category
     */
    public function index()
    {
        $category = Category::all();

        return response()->json([
            'message'=>"Berhasil",
            'data'=>$category,
        ]);
    }

    /**
     * Method untuk mengambil satu kategory
     */
    public function single($id)
    {
        $category = Category::find($id);
        if (!$category){
            return response()->json([
                'message'=>"Data tidak ditemukan",
                'data'=>[],
                'pariwisata'=>0,
            ],404);
        }
        
        $touristCount = $category->tourist->count();

        return response()->json([
            'message'=>"Berhasil",
            'data'=>$category,
            "pariwisata" => $touristCount,
        ]);
    }

    /**
     * Method untuk menambah kategori
     */
    public function store(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json(['message' => "Token required."], 401);
        }
        else{
            if (auth()->guard("api")->check() == false) {
                return response()->json(['message' => "Token invalid",], 401);
            }
            
            if(!auth()->guard("api")->user()->hasRole('admin')){
                return response()->json(['message'=>"Anda bukan admin"],403);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => "Data tidak valid"], 400);
            }
    
            $category = Category::create($request->only('name'));
            
            return response()->json([
                'message'=>"Data berhasil ditambah",
                'category'=>$category,
            ],201);
        }
    }

    /**
     * Method untuk memperbarui kategori
     */
    public function update(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json(['message' => "Token required."], 401);
        } else {
            if (auth()->guard("api")->check() == false) {
                return response()->json(['message' => "Token invalid",], 401);
            }
            
            if (!auth()->guard("api")->user()->hasRole('admin')) {
                return response()->json(['message' => "Anda bukan admin"], 403);
            }
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => "Data tidak valid"], 400);
            }
    
            $id = $request->input("id");
            $data = $request->only('name');
            Category::find($id)->update($data);
            
            return response()->json([
                'message'=>"Data berhasil diperbarui",
            ]);
        }
    }

    /**
     * Method untuk menghapus kategori
     */
    public function delete(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json(['message' => "Token required."], 401);
        } else {
            if (auth()->guard("api")->check() == false) {
                return response()->json(['message' => "Token invalid",], 401);
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
    
            $id = $request->input("id");
            $category = Category::find($id);
            if(!$category){
                return response()->json([
                    'message'=>"Data tidak ditemukan",
                ],404);
            }
    
            $category->delete();
            return response()->json([
                'message'=>"Data berhasil dihapus",
            ]);
        }
    }
}
