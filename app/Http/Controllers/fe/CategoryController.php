<?php

namespace App\Http\Controllers\fe;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('home.category.index', [
            'active' => "category",
            'categories' => $categories,
        ]);
    }
}
