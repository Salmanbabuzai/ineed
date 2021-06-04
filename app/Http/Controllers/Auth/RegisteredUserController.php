<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth/register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|max:10|alpha',
            'lname' => 'required|max:10|alpha',
            'email' => 'required|max:50|email|unique:users,email',
            'phone' => 'required|max:20|min:11',
            'password' => [
                'required',
                'min:8',
                'max:20',
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',
            ],
            'confirm_password' => 'required|min:8|same:password',
            'city' => 'required',
            'address' => 'required',
            'user_photo' => 'mimes:jpeg,png,jpg|max:2048'
        ],

        [
            'password.regex' => 'Password must be at least 8 characters with uppercase letters and numbers',

        ]

    );

        $user = new User;

        $user->user_fname = $request->fname;
        $user->user_lname = $request->lname;
        $user->email = $request->email;
        $user->user_phone = $request->phone;
        $user->password = hash::make($request->password);
        $user->user_city = $request->city;
        $user->user_address = $request->address;

        $photo = $request->user_photo;

        if($photo)
        {
                $photo_name = rand() . 'dp' . '.' . $request->user_photo->extension();
                $photo->move(public_path('users_profile'), $photo_name);
                $user->user_photo = $photo_name;
        }

        $user->save();

        Auth::login($user);

       return redirect('userBoard')
           ->with('success','Account Created Successfully. Login Now');
    }
}
