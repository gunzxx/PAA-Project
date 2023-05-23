<?php

namespace App\Http\Controllers\fe;

use App\Models\Tourist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TouristController extends Controller
{
    public function index()
    {
        $tourists = Tourist::all();
        return view('home.tourist.index',[
            'tourists'=>$tourists,
            'active'=>'tourist',
        ]);
    }
}