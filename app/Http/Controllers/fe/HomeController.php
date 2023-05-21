<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index',[
            'active' => "home",
            'user' => auth()->user(),
        ]);
    }
}
