<?php

namespace App\Http\Controllers;


use App\Models\VerificationRequest;
use App\Models\SellerProfile;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Notifications\AdminVerificationNotification;



class VerificationRequestController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | SHOW VERIFICATION FORM
    |--------------------------------------------------------------------------
    */


    public function create()
    {

        return view('seller.verification.create');

    }







    /*
    |--------------------------------------------------------------------------
    | STORE VERIFICATION REQUEST
    |--------------------------------------------------------------------------
    */


    public function store(Request $request)
    {


        $request->validate([


            'document_type'=>'required',


            'document'=>'required|file',



        ]);








        $sellerProfile = SellerProfile::where(

            'user_id',

            Auth::id()

        )->first();






        if(!$sellerProfile)

        {


            return redirect()

            ->route('seller.profile.create')

            ->with(

                'error',

                'Seller profile not found.'

            );


        }









        // upload document


        $filePath = $request->file('document')

        ->store(

            'verification_documents',

            'public'

        );









        // create verification request


        VerificationRequest::create([



            'seller_profile_id'=>$sellerProfile->id,


            'document_type'=>$request->document_type,


            'document_path'=>$filePath,


            'status'=>'pending',



        ]);










        /*
        |--------------------------------------------------------------------------
        | UPDATE SELLER STATUS TO PENDING
        |--------------------------------------------------------------------------
        */


        $sellerProfile->update([


            'verification_status'=>'pending'


        ]);









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


                new AdminVerificationNotification(



                    "⏳ New Seller Verification Request",



                    "Seller ".$sellerProfile->brand_name." submitted verification documents and is waiting for review."



                )


            );



        }









        return redirect()

        ->route('seller.dashboard')

        ->with(


            'success',


            'Verification request submitted successfully.'



        );



    }



}