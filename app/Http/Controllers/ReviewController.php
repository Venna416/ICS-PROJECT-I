<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Review;



class ReviewController extends Controller
{


public function store(Request $request)
{


$request->validate([


'seller_name'=>'required|string',

'brand_name'=>'required|string',

'rating'=>'required|integer|min:1|max:5',

'review'=>'required|string',


]);





Review::create([


'user_id'=>Auth::id(),


'seller_name'=>$request->seller_name,


'brand_name'=>$request->brand_name,


'rating'=>$request->rating,


'review'=>$request->review,


'status'=>'active',


]);





return redirect()

->route('buyer.reviews.thanks')

->with(

'success',

'Thank you for your feedback!'

);



}



}