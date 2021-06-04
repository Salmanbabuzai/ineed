<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\mailSend;
use App\Models\User;
use App\Models\Offer;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DB;


class mailController extends Controller
{
	public function index()
	{
		return view('sendEmail');
	}

	public function getSenderData(Request $req)
	{
    	$check = Offer::where('id', $req->id)->pluck('emailSent');
    	
    	if($check[0]==1)
    	{
    		return redirect("/userBoard")->with('warn', 'Email Already Sent');
    	}

    	else
    	{
	    $offerId = $req->id;
    	$getIdWhoOffered = Offer::where('id', $offerId)->pluck('user_id');
    	$data = User::where('id', $getIdWhoOffered)->select(['id', 'user_fname', 'user_lname', 'email', 'user_phone'])->get();
		return view('/sendEmail', ['data'=>$data]);	
		}
	}

    public function sendEmail(Request $req, $id)
    {
    	$details = [
    		'flag'=>'toUser',
    		'title' => $req->title,
    		'body' => $req->body,
    		'name' => $req->name,
    		'phone' => $req->phone,
    		'email' => $req->email
    	];    

    

    	$getEmail = User::where('id', $id)->pluck('email');

    	Mail::to($getEmail)->send(new mailSend($details));

    	$getPostId = Offer::where('user_id', $id)->pluck('post_id');

    	$check = Offer::whereIn('post_id', $getPostId)->where('user_id', $id)->first();

    	$check->emailSent = '1';
    	$check->save();

    	return redirect("/userBoard")->with('success', 'Email Sent Sucess');
    }

    public function sendEmailToSupport(Request $req)
    {
    	if(Auth::check()){
    	$getEmail = User::where('id', Auth::id())->pluck('email');

    	$req->validate([
    		'options' => 'required|alpha',
    		'subject' => 'required|max:50|alpha',
    		'details' => 'required|max:200|alpha',
        ]);

    	$details = [
    		'flag'=>'toSupport',
    		'options' => $req->options,
    		'subject' => $req->subject,
    		'details' => $req->details,
    		'userEmail'=> $getEmail
    	];

    	Mail::to('babuzaikhantutu@gmail.com')->send(new mailSend($details));

    	$details = [
    		'flag'=>'toMe',
    		'options' => $req->options,
    		'subject' => $req->subject,
    		'details' => $req->details,
    		'userEmail'=> $getEmail
    	];

    	Mail::to($getEmail)->send(new mailSend($details));


    	return redirect("/userBoard")->with('success', 'Email Sent Sucess');
    	}
    }

    public function gotNotification(Request $req, $id)
    {
    	if(Auth::check()){

    	$userId = Auth::id();

    	$post = Post::join('users', 'users.id', '=', 'posts.user_id')->where('posts.user_id', '=', $userId)->pluck('posts.id');

         DB::table('Offers')->whereIn('post_id', $post)->update(array('notification' => '0'));  


    	return redirect('offersIGot/'.$id);

    	}
    }
}
