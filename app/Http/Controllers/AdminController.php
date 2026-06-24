<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use App\Models\SellerProfile;
use App\Models\Review;
use App\Models\FraudReport;




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






$reviewCount = Review::count();



$fraudCount = FraudReport::count();






return view(

'admin.dashboard',

compact(

'pendingCount',

'verifiedCount',

'rejectedCount',

'reviewCount',

'fraudCount'

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
| SELLER DETAILS
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
| UPDATE VERIFICATION
|--------------------------------------------------------------------------
*/


public function updateVerification(Request $request,$id)
{


$seller = SellerProfile::findOrFail($id);




$request->validate([


'status'=>'required|in:verified,rejected',


'risk_score'=>'required|integer|min:1|max:10',


'trust_score'=>'required|integer|min:0|max:100',


'verification_reason'=>'nullable|string|max:1000'


]);







$seller->update([



'verification_status'=>$request->status,


'verified'=>$request->status === 'verified',


'risk_score'=>$request->risk_score,


'trust_score'=>$request->trust_score,


'verification_reason'=>$request->verification_reason



]);







if($request->status === 'rejected'){


return redirect()

->route('admin.rejected')

->with(

'success',

'Rejection updated successfully'

);


}





return redirect()

->route('admin.verified')

->with(

'success',

'Seller verified successfully'

);



}










/*
|--------------------------------------------------------------------------
| EDIT VERIFICATION
|--------------------------------------------------------------------------
*/


public function editVerification($id)
{


$seller = SellerProfile::findOrFail($id);



return view(

'admin.edit-verification',

compact('seller')

);



}









/*
|--------------------------------------------------------------------------
| BUYER REVIEWS
|--------------------------------------------------------------------------
*/


public function reviews(Request $request)
{


$query = Review::query();





if($request->search){


$query->where(function($q) use ($request){


$q->where(

'seller_name',

'like',

'%'.$request->search.'%'

)


->orWhere(

'brand_name',

'like',

'%'.$request->search.'%'

);



});


}





$reviews = $query

->latest()

->get();






return view(

'admin.reviews',

compact('reviews')

);



}









/*
|--------------------------------------------------------------------------
| FRAUD REPORTS
|--------------------------------------------------------------------------
*/


public function fraudReports(Request $request)
{


    $search = $request->search;



    $reports = FraudReport::query()


    ->when($search, function($query) use ($search){


        $query->where(function($q) use ($search){


            $q->where('seller_name','LIKE','%'.$search.'%')

            ->orWhere('brand_name','LIKE','%'.$search.'%');


        });



    })


    ->latest()

    ->get();





    return view(

        'admin.fraud-reports',

        compact(

            'reports',

            'search'

        )

    );


}





public function showFraud($id)
{


$report = FraudReport::findOrFail($id);



return view(

'admin.fraud-show',

compact('report')

);


}



}