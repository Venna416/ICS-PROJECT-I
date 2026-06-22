<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;


class AdminController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $pendingCount = SellerProfile::where(
            'verification_status',
            'pending'
        )->count();



        $verifiedCount = SellerProfile::where(
            'verification_status',
            'verified'
        )->count();




        $rejectedCount = SellerProfile::where(
            'verification_status',
            'rejected'
        )->count();




        return view(
            'admin.dashboard',
            compact(
                'pendingCount',
                'verifiedCount',
                'rejectedCount'
            )
        );

    }








    /*
    |--------------------------------------------------------------------------
    | PENDING SELLERS
    |--------------------------------------------------------------------------
    */


    public function pending()
    {


        $sellers = SellerProfile::with('user')

        ->where(
            'verification_status',
            'pending'
        )

        ->get();



        return view(
            'admin.pending',
            compact('sellers')
        );


    }








    /*
    |--------------------------------------------------------------------------
    | VERIFIED SELLERS
    |--------------------------------------------------------------------------
    */


    public function verified()
    {


        $sellers = SellerProfile::with('user')

        ->where(
            'verification_status',
            'verified'
        )

        ->get();



        return view(
            'admin.verified',
            compact('sellers')
        );


    }









    /*
    |--------------------------------------------------------------------------
    | REJECTED SELLERS
    |--------------------------------------------------------------------------
    */


    public function rejected()
    {


        $sellers = SellerProfile::with('user')

        ->where(
            'verification_status',
            'rejected'
        )

        ->get();



        return view(
            'admin.rejected',
            compact('sellers')
        );


    }









    /*
    |--------------------------------------------------------------------------
    | SHOW FULL SELLER APPLICATION
    |--------------------------------------------------------------------------
    */


    public function showSeller($id)
    {


        $seller = SellerProfile::with([

            'user',

            'documents'

        ])

        ->findOrFail($id);




        return view(

            'admin.seller-show',

            compact('seller')

        );


    }









    /*
    |--------------------------------------------------------------------------
    | VERIFY / REJECT SELLER
    |--------------------------------------------------------------------------
    */


    public function verifySeller(Request $request, $id)
    {


        $seller = SellerProfile::findOrFail($id);



        $request->validate([


            'status' => 'required|in:verified,rejected',


            'risk_score' => 'required|integer|min:1|max:10',


            'trust_score' => 'required|integer|min:0|max:100',


            'verification_reason' => 'nullable|string|max:1000',


        ]);






        $seller->verification_status = $request->status;




        $seller->verified = 

            $request->status === 'verified';





        $seller->risk_score = $request->risk_score;



        $seller->trust_score = $request->trust_score;



        $seller->verification_reason = 

            $request->verification_reason;





        $seller->save();







        return redirect()

            ->route('admin.dashboard')

            ->with(

                'success',

                'Seller verification updated successfully.'

            );


    }




}