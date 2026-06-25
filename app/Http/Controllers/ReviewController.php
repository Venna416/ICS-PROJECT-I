<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Review;
use App\Models\User;
use App\Notifications\AdminActivityNotification;



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



            // buyer who wrote review

            'user_id'=>Auth::id(),



            'seller_name'=>$request->seller_name,



            'brand_name'=>$request->brand_name,



            'rating'=>$request->rating,



            'review'=>$request->review,



            'status'=>'active',



        ]);










        // Notify admins


        $admins = User::where('role','admin')->get();



        foreach($admins as $admin)

        {


            $admin->notify(


                new AdminActivityNotification(


                    "⭐ New Buyer Review",


                    "A new review was submitted for ".$request->brand_name


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


        return view('buyer.review-success');


    }





}