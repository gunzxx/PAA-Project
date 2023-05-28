<?php

namespace App\Http\Controllers\fe;

use App\Models\Tourist;
use App\Models\Category;
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

    public function create()
    {
        $categories = Category::all();
        return view('home.tourist.create',[
            'categories'=>$categories,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'latitude' => 'required|decimal:0,20',
            'longitude' => 'required|decimal:0,20',
        ]);

        $tourist = Tourist::create($validate);

        if ($request->file('thumb')) {
            $request->validate([
                'thumb' => 'mimetypes:image/*|max:2096',
            ]);
            $tourist->addMediaFromRequest("thumb")->toMediaCollection("thumb");
            $tourist->update([
                'thumb' => $tourist->getFirstMediaUrl("thumb"),
            ]);
        }

        return redirect("/admin/tourist")->with('success',"Data berhasil ditambah!");
    }

    public function edit($id)
    {
        $tourist = Tourist::find($id);
        $categories = Category::all();

        return view('home.tourist.edit',[
            'tourist'=>$tourist,
            'categories'=>$categories,
            'active'=>'tourist',
        ]);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'location'=>'required',
            'latitude'=>'required|decimal:0,20',
            'longitude'=>'required|decimal:0,20',
            'tourist_preview'=>'required',
        ]);

        $request->validate([
            'id' => 'required',
        ]);

        $tourist = Tourist::find($request->post('id'));
        $tourist->update($validate);

        if($request->file('thumb')){
            $request->validate([
                'thumb' => 'mimetypes:image/*|max:2096',
            ]);
            $tourist->addMediaFromRequest("thumb")->toMediaCollection("thumb");
            $tourist->update([
                'thumb'=> $tourist->getFirstMediaUrl("thumb"),
            ]);
        }

        if($request->file('tourist_preview')){
            $request->validate([
                'tourist_preview.*' => 'mimetypes:image/*|max:2096',
            ]);

            $tourist->getMedia('preview')->each->delete();

            foreach($request->file('tourist_preview') as $file){
                $tourist->addMedia($file)->toMediaCollection("preview");
            }
        }

        return redirect("/admin/tourist")->with('success',"Data berhasil diedit!");
    }
}