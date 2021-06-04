<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
	function adminHeader(Request $req){
		return view('admin.adminHeader');
	}

    function adminHome(Request $req)
    {
    	$id = Auth::id();
    	$data = User::paginate(10);
        $totalUsers = User::all()->count();
        $totalPosts = Post::all()->count();
        $totalOffers = Offer::all()->count();
    	return view('admin.admin', ['dataa'=>$data, 'totalUsers'=>$totalUsers, 'totalPosts'=>$totalPosts, 'totalOffers'=>$totalOffers]);
    }

    function adminManager(Request $req)
    {
    	$id = Auth::id();
    	$data = User::paginate(10);
    	return view('admin.adminManager', ['dataa'=>$data]);
    }
     function adminPostManager(Request $req, $id)
    {
    	//$id = Auth::id();
    	$data = User::join('posts', 'posts.user_id', '=', 'users.id')->select('posts.*')->where('users.id', '=', $id)->get();
    	$userName = User::where('id', '=', $id)->get('users.user_fname');
    	return view('admin.adminPostManager', ['dataa'=>$data, 'userName'=>$userName]);
    }
    function adminOfferManager(Request $req, $id)
    {
    	//$id = Auth::id();
    	$data = Offer::join('posts', 'posts.id', '=', 'offers.post_id')->join('Users', 'Users.id', '=', 'posts.user_id')->select(['offers.*'])->where('offers.user_id', '=', $id)->get();
    	$userName = User::where('id', '=', $id)->get('users.user_fname');
    	return view('admin.adminOfferManager', ['dataa'=>$data, 'userName'=>$userName]);
    }
    function adminDeleteUser(Request $req, $id)
    {
    	$check = User::find($id);
    	$userId = Auth::id();
    	$deleteUser = User::where('id', '=', $id);
    	//$deletePost = Post::where('user_id', '=', $id);
       // $deletePostOffers = Offer::join('posts', 'posts.id', '=', 'offers.post_id')->where('post.user_id', '=', $id);

    	if ($check){
            $deleteUser->delete();
           // $deletePost->delete();
           // $deletePostOffers->delete();
    		return back()
            ->with('success','User and Related Data Deleted Success');
    	}
    	else{
    		return back()
            ->with('warn','User Not Found');
    	}
    }

    function adminDeletePost(Request $req, $id)
    {
    	//$userId = Auth::id();
 
    	$check = Post::find($id);
    	$deletePost = Post::where('id', '=', $id);
        $deletePostOffers = Offer::where('post_id', '=', $id);

    	if ($check){
            $deletePost->delete();
            $deletePostOffers->delete();
    		return back()
            ->with('success','Post Deleted Success');
    	}
    	else{
    		return back()
            ->with('warn','Post Not Found');
    	}
    }
    function adminDeleteOffer(Request $req, $id)
    {
    	//$userId = Auth::id();
 
    	$check = Offer::where('id', '=', $id);
    	if ($check) {
    		$check->delete();
    		return back()
    		->with('success', 'No More Offering Message Sent');
    	}
    	else{
    		return back()
    		->with('error', 'No Offer Found');
    		}
    	}
    function adminAddUser(Request $request){

    	$request->validate([
            'fname' => 'required|max:10|alpha',
            'lname' => 'required|max:10|alpha',
            'email' => 'required|max:50|email|unique:users,email',
            'phone' => 'max:20',
            'password' => 'required|min:8|max:20',
            'confirm_password' => 'required|min:8|same:password',
            'city' => 'max:20',
            'address' => 'max:50',
            'user_photo' => 'mimes:jpeg,png,jpg|max:4096'
        ]);

        $user = new User;

        $user->user_fname = $request->fname;
        $user->user_lname = $request->lname;
        $user->email = $request->email;
        $user->user_phone = $request->phone;
        $user->password = hash::make($request->password);
        $user->user_city = $request->city;
        $user->user_address = $request->address;

        if($request->user_photo)
        {
	        $photo = $request->user_photo;
	        $photo_name = rand() . 'dp' . '.' . $request->user_photo->extension();
	        $photo->move(public_path('users_profile'), $photo_name);
	        $user->user_photo = $photo_name;
        }
        else
        {
        	$user->user_photo = "defaultUser.png";
        }

        $user->save();
        return redirect('adminManager')
           ->with('success','New User Added');
    }

    function adminUpdateUser(Request $request){

    	$request->validate([
            'fname' => 'required|max:10|alpha',
            'lname' => 'required|max:10|alpha',
            'phone' => 'max:20',
            'newPass' => 'max:20',
            'city' => 'max:20',
            'address' => 'max:50'
        ]);

    	$user = User::find($request->id);
        $user->user_fname = $request->fname;
        $user->user_lname = $request->lname;
        $pass = hash::make($request->newPass);
    	$user->password = $pass;
        $user->user_phone = $request->phone;
        $user->user_city = $request->city;
        $user->user_address = $request->address;
        $user->save();

      
    	return back()
            ->with('success','Updated');
        
     } 

     public function adminAllEmails()
     {
        $data = User::get(['user_fname', 'user_lname', 'email']);
        return view('admin.adminAllEmails', ['dataa'=>$data,]); 
     }

      public function adminAllPhones()
     {
        $data = User::get(['user_fname', 'user_lname', 'user_phone']);
        return view('admin.adminAllPhones', ['dataa'=>$data,]); 
     }
}
