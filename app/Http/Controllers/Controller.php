<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function vue()
    {
    	return view('vue');
    }

    public function __construct()
    {	


        $cat1 = Category::where('p_cat_id', 1)->get();
        $cat2 = Category::where('p_cat_id', 13)->get();
        $cat3 = Category::where('p_cat_id', 24)->get();
        $cat4 = Category::where('p_cat_id', 36)->get();
        $cat5 = Category::where('p_cat_id', 48)->get();
        $cat6 = Category::where('p_cat_id', 56)->get();
        $cat7 = Category::where('p_cat_id', 66)->get();
        $cat8 = Category::where('p_cat_id', 76)->get();
        $cat9 = Category::where('p_cat_id', 85)->get();


        $searchRecom = Post::join('Users', 'Users.id', '=', 'posts.user_id')->select(['posts.*', 'Users.user_fname'])->inRandomOrder()->limit(6)->get();

        $cityList = Post::select('post_city')->groupBy('post_city')->get();
        
        $category = Category::select('cat_name')->where('p_cat_id', '=', '0')->get();

        return view::share(['cat1'=>$cat1, 'cat2'=>$cat2, 'cat3'=>$cat3, 'cat4'=>$cat4, 'cat5'=>$cat5, 'cat6'=>$cat6, 'cat7'=>$cat7, 'cat8'=>$cat8, 'cat9'=>$cat9, 'searchRecom'=>$searchRecom, 'cityList'=>$cityList, 'category'=>$category]);
    }

    public function help()
    {
    	return view('help');
    }

    public function privacyPolicy()
    {
    	return view('privacy-policy');
    }

   	public function contactSupport()
   	{
    	return view('contactSupport');
   	}
}
