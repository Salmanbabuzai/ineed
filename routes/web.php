<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registration;
use App\Http\Controllers\login;
use App\Http\Controllers\userProfile;
use App\Http\Controllers\postControl;
use App\Http\Controllers\offerControl;
use App\Http\Controllers\searchControl;
use App\Http\Controllers\adminController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('vue', [Controller::class,'vue']);

Route::get("/help", [Controller::class,'help']);
Route::get("/contactSupport", [Controller::class,'contactSupport'])->middleware(['auth', 'verified']);
Route::get("/privacy-policy", [Controller::class,'privacyPolicy']);


Route::post('/sendEmailToSupport', [mailController::class, 'sendEmailToSupport'])->middleware(['auth', 'verified']);


Route::post('/sendUserData/{id}', [mailController::class, 'sendEmail'])->middleware(['auth', 'verified']);
Route::get("/offersIGot/sendEmail", [mailController::class,'index'])->middleware(['auth', 'verified']);
Route::post("/sendEmail", [mailController::class,'getSenderData'])->middleware(['auth', 'verified']);


Route::get("offersIGot/{id}", [offerControl::class, 'offersIGot'])->middleware(['auth', 'verified']);;

Route::get("/gotNotification/{id}", [mailController::class,'gotNotification'])->middleware(['auth', 'verified']);;



Route::get('/', function () {
    return redirect('index');
});

Route::get('index', function () {
    return view('index');
});

Route::get('signOut', function () {
	Session::forget('user');
    return redirect('login');
});

Route::get("index", [postControl::class,'homePost']);



Route::post("updateUserImage", [userProfile::class,'updateUserImage'])->middleware(['auth', 'verified']);
Route::post("userPersonalProfile", [userProfile::class,'userPersonalProfile'])->middleware(['auth', 'verified']);
Route::post("userAddressProfile", [userProfile::class,'userAddressProfile'])->middleware(['auth', 'verified']);
Route::post("updatePassword", [userProfile::class,'updatePassword']);


Route::get("userBoard", [userProfile::class,'userDashboard'])->middleware(['auth', 'verified']);

Route::get("myPosts", [postControl::class,'myPosts'])->middleware(['auth', 'verified']);
Route::get("myOffers", [offerControl::class,'myOffers'])->middleware(['auth', 'verified']);



Route::get("userProfile", [userProfile::class,'userProfile'])->middleware(['auth', 'verified']);



Route::post("needPosting", [postControl::class, 'needPosting']);
Route::get("deleteNeed/{id}", [postControl::class, 'deleteNeed']);
Route::get("postNeed", [searchControl::class, 'mainCat'])->middleware(['auth', 'verified']);;
Route::get("/subCat/{id}", [searchControl::class, 'subCat'])->middleware(['auth', 'verified']);

Route::get("makeOffer/{id}", [offerControl::class, 'makeOffer']);
Route::get("noMoreOffering/{id}", [offerControl::class, 'noMoreOffering']);
Route::post("sendOffer", [offerControl::class, 'sendOffer'])->middleware(['auth', 'verified']);


Route::post("deleteNeed/{id}", [postControl::class, 'deleteNeed']);

Route::post("editNeed/needUpdate/{id}", [postControl::class, 'needUpdate']);

Route::get("editNeed/{id}", [postControl::class, 'editNeed'])->middleware(['auth', 'verified']);

Route::get("search", [searchControl::class, 'searchPage']);
Route::post("search", [searchControl::class, 'searchItem']);
Route::get("search/{id}", [searchControl::class, 'searchByCat']);
Route::get("/searchFiter", [searchControl::class, 'searchFiter']);






Route::view("inbox", 'inbox');




Route::group(['middleware'=>['auth', 'admin']], function(){

	Route::get("/admin", [adminController::class, 'adminHome']);
	Route::get("/adminHeader", [adminController::class, 'adminHeader']);
	Route::get("/adminManager", [adminController::class, 'adminManager']);
	Route::get("/adminPostManager/{id}", [adminController::class, 'adminPostManager']);
	Route::get("/adminOfferManager/{id}", [adminController::class, 'adminOfferManager']);
	Route::get("/adminDeleteUser/{id}", [adminController::class, 'adminDeleteUser']);
	Route::get("/adminDeletePost/{id}", [adminController::class, 'adminDeletePost']);
	Route::get("/adminDeleteOffer/{id}", [adminController::class, 'adminDeleteOffer']);
	Route::post("/adminAddUser", [adminController::class, 'adminAddUser']);
	Route::post("/adminUpdateUser", [adminController::class, 'adminUpdateUser']);
	Route::get("/adminAllEmails", [adminController::class, 'adminAllEmails']);
	Route::get("/adminAllPhones", [adminController::class, 'adminAllPhones']);
});




Route::view("admin-board", 'admin/admin-board');






require __DIR__.'/auth.php';
