<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;
use App\Models\SellerDocument;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminActivityNotification;



class SellerProfileController extends Controller
{


    public function create()
    {
        return view('seller.profile.create');
    }






    /*
    |--------------------------------------------------------------------------
    | CREATE PROFILE
    |--------------------------------------------------------------------------
    */


    public function store(Request $request)
    {


        $request->validate([


            'profile_photo'=>'nullable|image|max:2048',

            'id_front'=>'nullable|image|max:2048',

            'id_back'=>'nullable|image|max:2048',

            'documents.*'=>'nullable|file|max:5000',


            'brand_name'=>'nullable|string',

            'category'=>'nullable|string',

            'location'=>'nullable|string',

            'phone'=>'nullable|string',

            'social_platform'=>'nullable|string',

            'shop_link'=>'nullable|url',

            'description'=>'nullable|string',


        ]);






        $profile = SellerProfile::create([


            'user_id'=>Auth::id(),


            'brand_name'=>$request->brand_name,


            'business_category'=>$request->category,


            'location'=>$request->location,


            'phone_number'=>$request->phone,


            'social_platform'=>$request->social_platform,


            'shop_link'=>$request->shop_link,


            'description'=>$request->description,




            'profile_photo'=>

            $request->hasFile('profile_photo')

            ?

            $request->file('profile_photo')
            ->store('profiles','public')

            :

            null,






            'id_front'=>

            $request->hasFile('id_front')

            ?

            $request->file('id_front')
            ->store('ids','public')

            :

            null,






            'id_back'=>

            $request->hasFile('id_back')

            ?

            $request->file('id_back')
            ->store('ids','public')

            :

            null,





            'verification_status'=>'pending',


            'verified'=>false,


            'risk_score'=>0,


            'trust_score'=>0,



        ]);









        /*
        |--------------------------------------------------------------------------
        | SAVE EXTRA DOCUMENTS
        |--------------------------------------------------------------------------
        */


        if($request->hasFile('documents'))

        {


            foreach($request->file('documents') as $file)

            {


                SellerDocument::create([


                    'seller_profile_id'=>$profile->id,


                    'document_type'=>'extra_evidence',


                    'file_path'=>

                    $file->store(
                        'seller_documents',
                        'public'
                    )


                ]);


            }


        }








        /*
        |--------------------------------------------------------------------------
        | NOTIFY ADMINS
        |--------------------------------------------------------------------------
        */


        $admins = User::where('role','admin')->get();



        foreach($admins as $admin)

        {


            $admin->notify(

                new AdminActivityNotification(

                    "⏳ New Seller Verification Pending",

                    "Seller {$profile->brand_name} submitted a profile and is waiting for verification."

                )

            );


        }









        return redirect()

        ->route(
            'seller.profile.show',
            $profile->id
        )

        ->with(
            'success',
            'Profile created successfully'
        );


    }












    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */


    public function show($id)
    {


        $profile = SellerProfile::with('documents')

        ->findOrFail($id);



        return view(

            'seller.profile.show',

            compact('profile')

        );


    }









    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */


    public function edit($id)
    {


        $profile = SellerProfile::findOrFail($id);



        return view(

            'seller.profile.edit',

            compact('profile')

        );


    }












    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */


    public function update(Request $request,$id)

    {


        $profile = SellerProfile::findOrFail($id);





        $request->validate([



            'brand_name'=>'nullable|string',


            'business_category'=>'nullable|string',


            'category'=>'nullable|string',


            'location'=>'nullable|string',


            'phone_number'=>'nullable|string',


            'phone'=>'nullable|string',


            'social_platform'=>'nullable|string',


            'shop_link'=>'nullable|url',


            'description'=>'nullable|string',



            'profile_photo'=>'nullable|image|max:2048',


            'id_front'=>'nullable|image|max:2048',


            'id_back'=>'nullable|image|max:2048',



        ]);









        $profile->brand_name = $request->brand_name;





        $profile->business_category =

        $request->business_category

        ??

        $request->category;







        $profile->location =

        $request->location;







        $profile->phone_number =

        $request->phone_number

        ??

        $request->phone;







        $profile->social_platform =

        $request->social_platform;







        $profile->shop_link =

        $request->shop_link;







        $profile->description =

        $request->description;












        if($request->hasFile('profile_photo'))

        {


            $profile->profile_photo =

            $request->file('profile_photo')

            ->store(
                'profiles',
                'public'
            );


        }









        if($request->hasFile('id_front'))

        {


            $profile->id_front =

            $request->file('id_front')

            ->store(
                'ids',
                'public'
            );


        }









        if($request->hasFile('id_back'))

        {


            $profile->id_back =

            $request->file('id_back')

            ->store(
                'ids',
                'public'
            );


        }








        $profile->save();









        if($request->hasFile('documents'))

        {


            foreach($request->file('documents') as $file)

            {


                SellerDocument::create([


                    'seller_profile_id'=>$profile->id,


                    'document_type'=>'extra_evidence',


                    'file_path'=>

                    $file->store(
                        'seller_documents',
                        'public'
                    )


                ]);


            }


        }








        return redirect()

        ->route(
            'seller.profile.show',
            $profile->id
        )

        ->with(

            'success',

            'Profile updated successfully'

        );


    }



}