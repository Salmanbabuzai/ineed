<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class registration extends Controller
{
    function registration(Request $req)
    {
    		$req->validate([
    		'fname' => 'required|max:10|alpha',
    		'lname' => 'required|max:10|alpha',
    		'email' => 'required|max:50|email|unique:users,email',
    		'phone' => 'required|max:20|min:11',
    		'password' => 'required|min:8|max:20',
    		'confirm_password' => 'required|min:8|same:password',
    		'city' => 'required',
    		'address' => 'required',
            'user_photo' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

    	$user = new User;

    	$user->user_fname = $req->fname;
    	$user->user_lname = $req->lname;
    	$user->email = $req->email;
    	$user->user_phone = $req->phone;
    	$user->password = hash::make($req->password);
    	$user->user_city = $req->city;
    	$user->user_address = $req->address;


    	$photo = $req->user_photo;
    	$photo_name = rand() . 'dp' . '.' . $req->user_photo->extension();
    	$photo->move(public_path('users_profile'), $photo_name);
    	$user->user_photo = $photo_name;
    	$user->save();

    	return view('login')
            ->with('success','Account Created Successfully. Login Now');
    }
}
