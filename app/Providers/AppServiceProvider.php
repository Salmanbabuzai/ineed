<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            if (Auth::check()) {
                $userId = Auth::id();
        $postIds = Post::join('users', 'users.id', '=', 'posts.user_id')->where('posts.user_id', '=', $userId)->pluck('posts.id');
        
        $check = Offer::whereIn('post_id', $postIds)->where('notification', '=', '1')->get('notification');

        $postId = Offer::join('posts', 'posts.id', 'offers.post_id')->whereIn('post_id', $postIds)->where('notification', '=', '1')->get('offers.post_id')->take(1);

        if(count($check)>0){ $signal=1; } else {$signal=0;}

        return view::share(['signal'=>$signal, 'postId'=>$postId]);

         }   
        });  


    }
}
