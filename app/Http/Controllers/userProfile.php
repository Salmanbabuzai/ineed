<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class userProfile extends Controller
{

     function userDashboard(Request $req)
    {

        if(Auth::check()){

            $get_id = Auth::id();
            $get_email = Auth::user()->email;

            $data = User::where(['email'=>$get_email])->get();

          

            // Myposts Starts Here      
    
            $myNeeds = Post::where(['user_id'=>$get_id])->limit(6)->get();          

            $myOffers = User::join('posts', 'Users.id', '=', 'posts.user_id')
                        ->join('offers', 'offers.post_id', '=', 'posts.id')
                        ->where('offers.user_id', $get_id)
                        ->select(['posts.post_title','offers.offer_amount', 'offers.delivery_time', 'offers.id', 'offers.delivery_charges', 'offers.payment_method', 'offers.offer_date'])->selectRaw('posts.id As postId')->limit(5)->get();   


             // Total Posts              
             $totalPost = Post::where(['user_id'=>$get_id])
                    ->select(Post::raw('count(user_id) as totalPost'))
                    ->get();
            // Total Posts 
            $totalOffer = Offer::where(['user_id'=>$get_id])
                    ->select(Offer::raw('count(user_id) as totalOffer'))
                    ->get();            

            return view("userBoard", ['data'=>$data, 'totalPost'=>$totalPost, 'myNeeds'=>$myNeeds, 'totalOffer'=>$totalOffer, 'myOffers'=>$myOffers]); 
        }       
    }

    function userProfile(Request $req)
    {

        if(Auth::check()){

            $get_email = Auth::user()->email;

            $data = User::where(['email'=>$get_email])->get();

            return view("userProfile", ['data'=>$data]); 
        }       
    }

    function updateUserImage(Request $req)
    {

        if(Auth::check()){
        
        $id = Auth::id();
        $req->validate([
            'imgUpdate' => 'mimes:jpeg,png,jpg|max:2048'
        ]);

        $photo = $req->imgUpdate;

        if($photo)
        {
            // Removing extra characters from profile picture name
            $oldDP = User::where('id', $id)->pluck('user_photo');
            $filter1 = str_replace('"', '', $oldDP);
            $filter2 = str_replace('[', '', $filter1);
            $filter3 = str_replace(']', '', $filter2);

            unlink(public_path('users_profile\\'.$filter3));

                $user = User::find($id);
                $photo_name = rand() . 'dp' . '.' . $req->imgUpdate->extension();
                $photo->move(public_path('users_profile'), $photo_name);
                $user->user_photo = $photo_name;
                $user->save();
                return redirect('userProfile')->with('success','Profile Picture Updated');
        } 
       }
    }

    function userPersonalProfile(Request $req){

        if(Auth::check()){

        $id = Auth::id();

        $req->validate([
            'phone' => 'required|min:11|max:13'
        ]);

        $user = User::find($id);
        $user->user_phone = $req->phone;
        $user->save();

        return back()
            ->with('success','Record Updated Success');
        }
    }

     function userAddressProfile(Request $req){

        if(Auth::check()){

        $id = Auth::id();

        $req->validate([
            'city' => 'required|min:3|max:20',
            'address' => 'required|min:5|max:50'
        ]);

        $user = User::find($id);
        $user->user_city = $req->city;
        $user->user_address = $req->address;
        $user->save();

        return back()
            ->with('success','Record Updated Success');
        }
    }

    function updatePassword(Request $req){

        if(Auth::check()){

            $id = Auth::id();

            $currentPass = Auth::user()->password;
            $currentEmail = Auth::user()->email;
        }

        $req->validate([
            'currentPass' => 'required|min:8|max:20',
            'newPass' => 'required|min:8|max:20',
            'confirmNewPass' => 'required|min:8|same:newPass'
        ]);

        if (hash::check($req->currentPass, $currentPass)) {

        $new_pass = User::find($id);

        $pass = hash::make($req->newPass);
        $new_pass->password = $pass;
        $new_pass->save();

        return back()
            ->with('success','Password Changes Success');
        }
        else{
            return back()
            ->with('warn','Old Password not Matched');
        }
    }

}
