<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class offerControl extends Controller
{
    function makeOffer(Request $req, $id)
    {
	    	$post_id = $req->id;
	    	
	    	POST::findOrfail($post_id);

	    	$userId = Auth::id();

	    	$data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->where('posts.id', $id)->get(['posts.*','Users.user_fname', 'Users.user_lname']);


	    	$mainCatId = Post::where('id', '=', $post_id)->pluck('post_category');
	    	$SubCatId = Post::where('id', '=', $post_id)->pluck('post_subcategory');

	    	$getMainCat = Category::where('id', '=', $mainCatId)->get('cat_name');
	    	$getSubCat = Category::where('id', '=', $SubCatId)->get('cat_name');
	    	


	    	$reOffer = Offer::where('post_id', '=', $post_id)->where('user_id', '=', $userId)->count();

	    	$sent = 'Offer Sent Already';
	    	$nosent = 'Send Offer Now!';


	    	$searchRecom = Post::join('Users', 'Users.id', '=', 'posts.user_id')->select(['posts.id', 'posts.post_title', 'posts.post_city', 'Users.user_fname', 'posts.post_pic1'])->orderBy('post_date', 'DESC')->limit(6)->get();


			if ($reOffer>0) {
			    return view("makeOffer", ['data'=>$data, 'getMainCat'=>$getMainCat, 'getSubCat'=>$getSubCat, 'sent'=>$sent]);    
			}else{

	    		return view("makeOffer", ['data'=>$data, 'getMainCat'=>$getMainCat, 'getSubCat'=>$getSubCat, 'sent'=>$nosent, 'searchRecom'=>$searchRecom]);
	    	}
	}

    function sendOffer(Request $req)
    {
    	if(Auth::check()){
    		
	    	$userId = Auth::id();
    		$post_id = $req->id;

    		$check = Post::where('id', '=', $post_id)->get();

    		foreach ($check as $check) {
    			$checkId = $check->user_id;
    		}

    		// Reoffer checking
    		$reOffer = Offer::where('post_id', '=', $post_id)->where('user_id', '=', $userId)->count();

		    if ($checkId!=$userId) {

		    	if ($reOffer>0) {
		    		 return back()
		            ->with('error','Offer Already Sent! Checkout More');
		    	}else{
		    			
		    	$req->validate([
		    		'offerAmount' => 'required',
		    		'deliveryTime' => 'required',
		    		'deliveryCharges' => 'required',
		    		'paymentMethod' => 'required'
		        ]);

		        $offer = new Offer;
		        $offer->user_id = $userId;
		        $offer->post_id = $post_id;
		        $offer->offer_amount = $req->offerAmount;
		        $offer->delivery_time = $req->deliveryTime;
		        $offer->delivery_charges = $req->deliveryCharges;
		        $offer->payment_method = $req->paymentMethod;
		        $offer->notification = "1";
		        $offer->save();


		        // Updating number of posted offers
		    	$offernum = Offer::where(['user_id'=>$userId])
		            		->select(Post::raw('count(user_id) as offernum'))
		            		->get();

		        $offerUpdate = User::find($userId);
		        foreach ($offernum as  $offernum) {
		        $offerUpdate->user_offers = $offernum->offernum;
		        }
		        $offerUpdate->save();
		        //offers update finishes


		        return back()
		            ->with('success','Offer Sent Success');
		        }
		    }
		        else{
		        	return back()
		            ->with('warn','Do not Send Offer to Your Own Posts');
		            }
		}
		else{
			return back()
		            ->with('error','Please login to send offers');
		}
    }

    function noMoreOffering(Request $req, $id)
    {
    	if(Auth::check()){

    	$post_id = Offer::where('id', '=', $id);
    	if ($post_id) {
    		$post_id->delete();
    		return back()
    		->with('success', 'Offer Removed');
    	}
    	else{
    		return back()
    		->with('error', 'No Offer Found');
    		}
   		 }
	}

	function offersIGot(Request $req, $id)
	{
		if(Auth::check()){
	    $userId = Auth::id();
    	$check = Post::where('id', '=', $id)->get();
    	$checkRec = Offer::where('post_id', '=', $id)->get();

    if(count($checkRec)>0)
    {	

    	if(count($check)>0)
    		{
    	
    	    	foreach ($check as $check)
    	    	{
    	    		$checkId = $check->user_id;
    	    	}
    	
    			if ($checkId!=$userId)
    			{
    				return redirect('index')->with('error', 'Invalid Action!');
    			}
    		} 

    	$postDetails = Post::where('posts.id', $id)->get();

    	$getIdWhoOffered = Offer::where('post_id', $id)->get('user_id');
    	$userContact = User::whereIn('id', $getIdWhoOffered)->select(['user_fname', 'user_lname', 'email', 'user_phone'])->get();

		$data = Offer::join('posts', 'posts.id', '=', 'offers.post_id')->join('Users', 'Users.id', '=', 'posts.user_id')->where('offers.post_id', $id)->select('offers.*')->get();

		return view('offersIGot', ['data'=>$data, 'postDetails'=>$postDetails, 'userContact'=>$userContact]);
	}
	else
	{
		return redirect('userBoard')->with('warn', 'No Offers Recieved!');
	}}
	else
	{
		return redirect('index')->with('msg', 'Please Login First');
	}

}

function myOffers(Request $req)
{

    $get_id = Auth::id();       

		$myOffers = User::join('posts', 'Users.id', '=', 'posts.user_id')
                        ->join('offers', 'offers.post_id', '=', 'posts.id')
                        ->where('offers.user_id', $get_id)
                        ->select(['posts.post_title','offers.offer_amount', 'offers.delivery_time', 'offers.id', 'offers.delivery_charges', 'offers.payment_method', 'offers.offer_date'])->selectRaw('posts.id As postId')->paginate(6);

    return view("myOffers", ['myOffers'=>$myOffers]); 
}



}
