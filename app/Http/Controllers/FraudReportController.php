<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\FraudReport;
use App\Models\SellerProfile;
use App\Models\User;
use App\Notifications\AdminActivityNotification;


class FraudReportController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | SHOW REPORT FORM
    |--------------------------------------------------------------------------
    */


    public function create($id)
    {


        $seller = SellerProfile::findOrFail($id);


        return view(

            'buyer.reports',

            compact('seller')

        );


    }






    /*
    |--------------------------------------------------------------------------
    | STORE FRAUD REPORT
    |--------------------------------------------------------------------------
    */


    public function store(Request $request)
    {



        $validated = $request->validate([



            'seller_name' => 'required|string|max:255',



            'brand_name' => 'required|string|max:255',



            'shop_link' => 'required|url',



            'description' => 'required|string|max:2000',



            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',



            'contact' => 'required|string|max:255',



        ]);







        $evidencePath = null;





        if($request->hasFile('evidence')){


            $evidencePath = $request

            ->file('evidence')

            ->store('evidence','public');


        }







        FraudReport::create([




            'user_id' => Auth::id(),



            'seller_name' => $validated['seller_name'],



            'brand_name' => $validated['brand_name'],



            'shop_link' => $validated['shop_link'],



            'description' => $validated['description'],



            'evidence' => $evidencePath,



            'contact' => $validated['contact'],



            'status' => 'pending',



        ]);

$admins = User::where('role','admin')->get();



foreach($admins as $admin)

{

$admin->notify(

new AdminActivityNotification(

"🚨 New Fraud Report",

"A new fraud report has been submitted and requires review."

)

);

}








        return redirect()

->route('buyer.report.success')

->with(

'success',

'Your fraud report has been submitted successfully. Thank you for helping protect buyers.'

);



    }






}