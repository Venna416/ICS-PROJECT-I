<?php

namespace App\Http\Controllers;


use App\Models\FraudReport;
use App\Models\SellerProfile;
use App\Models\Review;
use App\Models\RegulatorReview;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Notifications\AdminActivityNotification;



class RegulatorController extends Controller
{


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/


public function dashboard(): View
{


$totalSellers = SellerProfile::count();


$verifiedSellers = SellerProfile::where(
'verification_status',
'verified'
)->count();


$pendingSellers = SellerProfile::where(
'verification_status',
'pending'
)->count();


$rejectedSellers = SellerProfile::where(
'verification_status',
'rejected'
)->count();




$totalReviews = Review::where(
'status',
'active'
)->count();




$pendingReviews = Review::where(
'status',
'pending'
)->count();




$totalFraudReports = FraudReport::count();




return view(

'regulator.dashboard',

compact(

'totalSellers',
'verifiedSellers',
'pendingSellers',
'rejectedSellers',
'totalReviews',
'pendingReviews',
'totalFraudReports'

)

);


}






/*
|--------------------------------------------------------------------------
| SELLERS
|--------------------------------------------------------------------------
*/


public function sellers(): View
{


$sellers = SellerProfile::latest()->get();



return view(

'regulator.sellers',

compact('sellers')

);


}






/*
|--------------------------------------------------------------------------
| FRAUD REPORTS
|--------------------------------------------------------------------------
*/


public function reports()
{


$reports = FraudReport::with(

'user'

)

->latest()

->get();



return view(

'regulator.reports',

compact('reports')

);


}







/*
|--------------------------------------------------------------------------
| INVESTIGATION PAGE
|--------------------------------------------------------------------------
*/


public function investigate($id)
{


$report = FraudReport::with(

'user'

)

->findOrFail($id);



return view(

'regulator.investigate',

compact('report')

);


}







/*
|--------------------------------------------------------------------------
| COMPLETE INVESTIGATION
|--------------------------------------------------------------------------
*/


public function updateInvestigation(Request $request,$id)
{


$request->validate([


'decision'=>'required',

'action_taken'=>'required',

'regulator_note'=>'required|string'


]);





$report = FraudReport::findOrFail($id);





$report->update([


'decision'=>$request->decision,

'action_taken'=>$request->action_taken,

'regulator_note'=>$request->regulator_note,

'status'=>'resolved',

'reviewed'=>true


]);







/*
|--------------------------------------------------------------------------
| BUYER NOTIFICATION
|--------------------------------------------------------------------------
*/


if($report->user)

{


$report->user->notify(

new AdminActivityNotification(

"🚨 Fraud Report Reviewed",

"Your fraud report against {$report->brand_name} was reviewed. Decision: {$request->decision}. Action: {$request->action_taken}"

)

);


}








/*
|--------------------------------------------------------------------------
| FIND SELLER
|--------------------------------------------------------------------------
*/


$seller = SellerProfile::where(

'brand_name',

$report->brand_name

)->first();







/*
|--------------------------------------------------------------------------
| SELLER NOTIFICATION
|--------------------------------------------------------------------------
*/


if($seller && $seller->user)

{


$seller->user->notify(

new AdminActivityNotification(

"⚠️ Fraud Investigation Result",

"Your business {$seller->brand_name} was investigated. Decision: {$request->decision}. Action taken: {$request->action_taken}."

)

);



}





/*
|--------------------------------------------------------------------------
| INCREASE RISK IF FRAUD CONFIRMED
|--------------------------------------------------------------------------
*/


if($request->decision == "Fraud Confirmed")

{


if($seller)

{


$seller->update([


'risk_score'=>($seller->risk_score ?? 0)+2


]);


}


}





return redirect()

->route('regulator.reports')

->with(

'success',

'Investigation completed successfully.'

);


}








/*
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
*/


public function reviews(Request $request)
{


$query = Review::query();



if($request->filled('search'))

{


$search=$request->search;



$query->where(function($q) use($search){


$q->where(
'brand_name',
'like',
"%$search%"
)


->orWhere(
'seller_name',
'like',
"%$search%"
)


->orWhere(
'review',
'like',
"%$search%"
);


});


}





$reviews = $query

->where(
'status',
'active'
)

->latest()

->get();




return view(

'regulator.reviews',

compact('reviews')

);


}








public function hideReview($id)
{


$review = Review::findOrFail($id);


$review->update([

'status'=>'hidden'

]);


return back()->with(

'success',

'Review hidden.'

);


}







public function restoreReview($id)
{


$review = Review::findOrFail($id);


$review->update([

'status'=>'active'

]);



return back()->with(

'success',

'Review restored.'

);


}







public function deleteReview($id)
{


$review = Review::findOrFail($id);


$review->delete();



return back()->with(

'success',

'Review deleted.'

);


}







/*
|--------------------------------------------------------------------------
| REGULATOR SELLER CONCERN
|--------------------------------------------------------------------------
*/


public function storeReview(Request $request,$id)
{


$request->validate([


'is_fair'=>'required',

'reason'=>'required|string'


]);




RegulatorReview::create([


'seller_id'=>$id,

'regulator_id'=>Auth::id(),

'is_fair'=>$request->is_fair,

'reason'=>$request->reason,

'reviewed'=>false


]);







if($request->is_fair == 0)

{


$admins = User::where(

'role',

'admin'

)->get();



foreach($admins as $admin)

{


$admin->notify(

new AdminActivityNotification(

"🚨 Regulator Concern",

"A regulator questioned a seller verification decision."

)

);


}


}





return back()->with(

'success',

'Concern submitted.'

);


}





}