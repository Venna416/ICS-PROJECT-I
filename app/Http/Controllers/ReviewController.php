<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Review;
use App\Models\SellerProfile;
use App\Models\User;

use App\Notifications\AdminActivityNotification;



class ReviewController extends Controller
{


/*
|--------------------------------------------------------------------------
| STORE REVIEW
|--------------------------------------------------------------------------
*/


public function store(Request $request)

{


$request->validate([


'seller_name'=>'required|string',

'brand_name'=>'required|string',

'rating'=>'required|integer|min:1|max:5',

'review'=>'required|string',


]);






// CREATE REVIEW


$review = Review::create([



'user_id'=>Auth::id(),



'seller_name'=>$request->seller_name,



'brand_name'=>$request->brand_name,



'rating'=>$request->rating,



'review'=>$request->review,



'status'=>'active'



]);








/*
|--------------------------------------------------------------------------
| FIND SELLER
|--------------------------------------------------------------------------
*/


$seller = SellerProfile::where(

'brand_name',

$request->brand_name

)->first();








/*
|--------------------------------------------------------------------------
| NOTIFY SELLER
|--------------------------------------------------------------------------
*/


if($seller && $seller->user)

{


$seller->user->notify(


new AdminActivityNotification(


"⭐ New Buyer Review",



"A buyer submitted a {$request->rating} star review for your business."



)


);



}









/*
|--------------------------------------------------------------------------
| NOTIFY REGULATORS
|--------------------------------------------------------------------------
*/


$regulators = User::where(

'role',

'regulator'

)->get();





foreach($regulators as $regulator)

{


$regulator->notify(


new AdminActivityNotification(


"⭐ New Buyer Review",



"A buyer submitted a new review for {$request->brand_name}. Please monitor feedback."



)


);



}









/*
|--------------------------------------------------------------------------
| NOTIFY ADMINS
|--------------------------------------------------------------------------
*/


$admins = User::where(

'role',

'admin'

)->get();





foreach($admins as $admin)

{


$admin->notify(


new AdminActivityNotification(


"⭐ New Buyer Review",



"A new buyer review was submitted for {$request->brand_name}."



)


);



}








return redirect()

->route('review.success')

->with(


'success',


'Review submitted successfully.'


);



}










public function success()

{


return view(

'buyer.review-success'

);


}



}