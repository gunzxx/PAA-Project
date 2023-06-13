<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

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
}
