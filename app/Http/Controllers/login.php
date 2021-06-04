<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{

    function login(Request $req)
    {

        $Admin = Admin::where(['email'=>$req->email])->first();

        if ($req->email=="" || $req->password=="") {
            return back()
            ->with('warn','Email or Password must not be Empty');
        }
        else if (!$Admin) {
            return back()
            ->with('warn','User Not Found');
        }
        else if (!$Admin || !Hash::check($req->password, $Admin->password)) {
            return back()
            ->with('error','Invalid Email or Password');
        }
        else{
            $Admin = Admin::where(['email'=>$req->email])->first();
            $req->session()->put('admin', $admin);
            return redirect('/admin');
        }
    }
}
