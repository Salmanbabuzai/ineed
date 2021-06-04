<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class searchControl extends Controller
{
    
    function searchPage(Request $req)
    {

    	$query = $req->searching;
    	 $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->select(['posts.*', 'Users.user_fname'])->inRandomOrder()->get();

        return view("search", ['data'=>$data, 'query'=>$query]);
    }

    function searchItem(Request $req)
    {
    	$flag = $req->id;

    	$req->validate([
    		'searching' => 'required|min:2|max:200'
        ]);

    	if ($flag=='searchBox')
    	{
    		
        $query = $req->searching;
        $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->select(['posts.*', 'Users.user_fname'])->where('post_title', 'like', '%'.$query.'%')->get();

        return view("search", ['data'=>$data, 'query'=>$query]);
    	}

    	if ($flag=='searchBoxFull')
    	{
    		
        $query1 = $req->searching;
        $query2 = $req->options;

        $data = User::join('posts', 'posts.user_id', '=', 'Users.id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('post_title', 'like', '%'.$query1.'%')->where('p_cat_id', '=', $query2)->get();

        return view("search", ['data'=>$data, 'query'=>$query1]);
    	}
    }


    function searchByCat(Request $req, $id)
    {

    	$get = Category::where('id', '=', $id)->get();

    if(count($get)>0)
    {

    	foreach ($get as $get) {
    		$getName = $get->cat_name;
    	}

    	if($id==1 || $id==13 || $id==24 || $id==36 || $id==48 || $id==56 || $id==66 || $id==76 || $id==85)
    	{
    		$data = User::join('posts', 'posts.user_id', '=', 'Users.id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('p_cat_id', '=', $id)->get();
    		return view("search", ['data'=>$data, 'query'=>$getName]);
    	}
    	else
    	{

    		$data = User::join('posts', 'posts.user_id', '=', 'Users.id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_subcategory', '=', $id)->get();
    		return view("search", ['data'=>$data, 'query'=>$getName]);
    		}
    	}
    	else
    	{
    		return redirect('index')->with('error', 'Invalid Action!');
    	}
    }

    public function mainCat()
    {
        $mainCat = Category::where('p_cat_id', '=', '0')->select(['id', 'cat_name'])->get();
        return view('postNeed', ['mainCat'=>$mainCat]);
    }
     public function subCat($id)
    {
        $subCat = Category::where('p_cat_id', $id)->pluck('cat_name', 'id');
        return json_encode($subCat);
    }

    function searchFiter(Request $request)
    {
        $query = $request->searching;

        $city = $request->city;
        $category = $request->category;
        $categoryId = Category::where('cat_name', '=', $category)->pluck('id');
        $budget = $request->budget;

        switch ($budget) {
            case 'level0':
                $min = 0;
                $max = 100;
                break;
            case 'level1':
                $min = 100;
                $max = 500;
                break;
            case 'level2':
                $min = 500;
                $max = 1500;
                break;
            case 'level3':
                $min = 1500;
                $max = 4000;
                break;
            case 'level4':
                $min = 4000;
                $max = 8000;
                break;
            case 'level5':
                $min = 8000;
                $max = 15000;
                break;
            case 'level6':
                $min = 15000;
                $max = 30000;
                break;
            case 'level7':
                $min = 30000;
                $max = 50000;
                break;
            case 'level8':
                $min = 50000;
                $max = 75000;
                break;
            case 'level9':
                $min = 75000;
                $max = 99999;
                break;
            case 'level10':
                $min = 99999;
                $max = 999999;
                break;
            
            default:
                $min = 0;
                $max = 999999;
                break;
        }


        if($city || $category || $budget)
        {
            if($city && $category && $budget)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_city', $city)->where('posts.post_category', $categoryId)->where('posts.post_budget', '>=', $min)->where('posts.post_budget', '<=', $max)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

            if($city && $category)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_city', $city)->where('posts.post_category', $categoryId)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

            if($city && $budget)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_city', $city)->where('posts.post_budget', '>=', $min)->where('posts.post_budget', '<=', $max)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

            if($category && $budget)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_category', $categoryId)->where('posts.post_budget', '>=', $min)->where('posts.post_budget', '<=', $max)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

            if($category)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_category', $categoryId)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

            if($budget)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_budget', '>=', $min)->where('posts.post_budget', '<=', $max)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

            if($city)
            {
           
            $data = Post::join('Users', 'Users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.post_subcategory')->select(['posts.*', 'Users.user_fname'])->where('posts.post_city', $city)->get();
                return view("search", ['data'=>$data, 'query'=>$query]);
            }

        }
        else{
            return redirect('/search');
        }

}




}
