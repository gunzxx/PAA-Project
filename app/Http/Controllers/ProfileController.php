<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view("profile.index",[
            'active'=>'profile',
        ]);
    }

    public function profile(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
        ]);

        User::find(auth()->user()->id)->update($validate);

        return redirect('/admin/profile')->with('success',"Profil berhasil diperbarui!");
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        User::find(auth()->user()->id)->update([
            'password'=>bcrypt($request->password),
        ]);

        return redirect('/admin/profile')->with('success', "Password berhasil diperbarui!");
    }
}
