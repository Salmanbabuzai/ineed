<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class postControl extends Controller
{
    function needPosting(Request $req)
    {
    	$req->validate([
    		'title' => 'required|min:10|max:40|string',
    		'details' => 'required|min:20|max:500|string',
    		'city' => 'required|min:2|max:20|string',
    		'mainCat' => 'required',
    		'subCat' => 'required',
    		'days' => 'required|numeric',
    		'budget' => 'required|max:1000000|numeric',
           	'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $get_id = Auth::id();

        $post = new Post;
        $post->post_title = $req->title;
		$post->user_id = $get_id;
        $post->post_details = $req->details;
        $post->post_category = $req->mainCat;
        $post->post_subcategory = $req->subCat;
        $post->post_maxdays = $req->days;
        $post->post_budget = $req->budget;
        $post->post_city = $req->city;

        	
    	$photo = $req->image;
    	$photo_name = rand() . 'dp' . '.' . $req->image->extension();
    	$photo->move(public_path('postImages'), $photo_name);
    	$post->post_pic1 = $photo_name;
    	$post->save();

    	// Updating number of posted needs
    	$neednum = Post::where(['user_id'=>$get_id])
            		->select(Post::raw('count(user_id) as neednum'))
            		->get();

        $needUpdate = User::find($get_id);
        foreach ($neednum as  $neednum) {
        $needUpdate->user_needs = $neednum->neednum;
        }
        $needUpdate->save();
        //needs update finishes

        return back()
            ->with('success','Posted Success');
    }

    function homePost(Request $req){

    	
        $data1 = Post::join('Users', 'Users.id', '=', 'posts.user_id')->select(['posts.*', 'Users.user_fname'])->orderBy('post_date', 'DESC')->limit(12)->get();

        $data2 = Post::join('Users', 'Users.id', '=', 'posts.user_id')->select(['posts.*', 'Users.user_fname'])->orderBy('post_date', 'ASC')->limit(12)->get();

        return view("index", ['data1'=>$data1, 'data2'=>$data2]);
    }

    function deleteNeed(Request $req, $id){

    	if(Auth::check()){
            
        $userId = Auth::id();
 
    	$check = Post::find($id);

    	$deletePost = Post::where('id', '=', $id)->where('user_id', '=', $userId);
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
        else{
            return redirect('login')
                    ->with('msg','Login First');
    }
}


function editNeed(Request $req, $id){

    if(Auth::check()){
            
        $userId = Auth::id();
        $check = Post::find($id);

        $data = Post::where('id', '=', $id)->where('user_id', '=', $userId)->get();

        if(Auth::user()->userType == 'admin')
        {
            $data = Post::where('id', '=', $id)->get();
        }

        if(count($data)>0)
        {
        $mainCat = Category::where('p_cat_id', '=', '0')->select(['id', 'cat_name'])->get();
        return view('editNeed',['data'=>$data, 'mainCat'=>$mainCat]);
        }
        else{
            return back()->with('error', 'Post Not Found');
        }

    }
}

function needUpdate(Request $req, $id){

    if(Auth::check())
    {
            
        $userId = Auth::id();
        $check = Post::find($id);

        $data = Post::where('id', '=', $id)->where('user_id', '=', $userId)->get();

        if(Auth::user()->userType == 'admin')
        {
            $data = Post::where('id', '=', $id)->get();
        }

        if(count($data)>0)
        {

        $req->validate([
            'title' => 'required|min:10|max:40|string',
            'details' => 'required|min:20|max:500|string',
            'city' => 'required|min:2|max:20|string',
            'mainCat' => 'required',
            'subCat' => 'required',
            'days' => 'required|numeric',
            'budget' => 'required|max:1000000|numeric',
            'image' => 'mimes:jpeg,png,jpg|max:2048'
        ]);

        $user_id = Auth::id();
        $post = Post::find($id);
        $post->post_title = $req->title;
        $post->post_details = $req->details;
        $post->post_category = $req->mainCat;
        $post->post_subcategory = $req->subCat;
        $post->post_maxdays = $req->days;
        $post->post_budget = $req->budget;
        $post->post_city = $req->city;

        if($req->image)
        {
                    
                $photo = $req->image;
                $photo_name = rand() . 'dp' . '.' . $req->image->extension();
                $photo->move(public_path('postImages'), $photo_name);
                $post->post_pic1 = $photo_name;
        }

        $post->save();

        return back()
            ->with('success','Post Updated Success');

        }
        else{
            return redirect('userBoard')->with('error', 'Post Not Found');
        }

	   
    }
}

function myPosts(Request $req)
{

    $get_id = Auth::id();
    $myNeeds = Post::where(['user_id'=>$get_id])->paginate(6);           

    return view("myPosts", ['myNeeds'=>$myNeeds]); 
}




}
