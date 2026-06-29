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




$totalReviews = Review::count();



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
| SELLERS LIST
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
| SELLER INVESTIGATION PAGE
|--------------------------------------------------------------------------
*/


public function showSeller($id)

{


$seller = SellerProfile::with([

'user',

'documents'

])->findOrFail($id);





$regulatorReview = RegulatorReview::where(

'seller_id',

$id

)

->latest()

->first();





return view(

'regulator.seller-show',

compact(

'seller',

'regulatorReview'

)

);



}








/*
|--------------------------------------------------------------------------
| REGULATOR REVIEW
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


'reviewed'=>true



]);










// IF NOT FAIR SEND ADMIN NOTIFICATION


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


"A regulator has questioned a seller verification decision."


)

);


}



}







return redirect()

->route('regulator.sellers')

->with(

'success',

'Regulator review submitted successfully.'

);



}









/*
|--------------------------------------------------------------------------
| APPROVE / REJECT
|--------------------------------------------------------------------------
*/


public function verify($id): RedirectResponse

{


$seller = SellerProfile::findOrFail($id);



$seller->update([


'verification_status'=>'verified'


]);



return back()->with(

'success',

'Seller approved successfully.'

);


}





public function reject($id): RedirectResponse

{


$seller = SellerProfile::findOrFail($id);



$seller->update([


'verification_status'=>'rejected'


]);



return back()->with(

'success',

'Seller rejected successfully.'

);


}









/*
|--------------------------------------------------------------------------
| FRAUD REPORTS
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| FRAUD REPORT TABLE
|--------------------------------------------------------------------------
*/


public function reports()
{


$reports = FraudReport::with([

'user',

'sellerProfile'

])

->latest()

->get();



return view(

'regulator.reports',

compact('reports')

);


}








/*
|--------------------------------------------------------------------------
| OPEN INVESTIGATION
|--------------------------------------------------------------------------
*/


public function investigate($id)
{


$report = FraudReport::with([

'user',

'sellerProfile'

])

->findOrFail($id);



return view(

'regulator.investigate',

compact('report')

);


}










/*
|--------------------------------------------------------------------------
| SAVE INVESTIGATION
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
| SELLER NOTIFICATION
|--------------------------------------------------------------------------
*/


$seller = $report->sellerProfile;



if($seller && $seller->user)

{


$seller->user->notify(

new AdminActivityNotification(

"⚠️ Business Compliance Notice",

"A buyer reported your business. Regulator decision: {$request->decision}. Action taken: {$request->action_taken}. Reason: {$report->description}"

)

);


}







return redirect()

->route('regulator.reports')

->with(

'success',

'Investigation submitted successfully.'

);



}




public function resolveReport(Request $request,$id)
{


$request->validate([

'decision'=>'required',

'action_taken'=>'required',

'regulator_note'=>'required|string'

]);



$report = FraudReport::findOrFail($id);



$report->update([


'status'=>'resolved',

'decision'=>$request->decision,

'action_taken'=>$request->action_taken,

'regulator_note'=>$request->regulator_note


]);







/*
|--------------------------------------------------------------------------
| NOTIFY BUYER
|--------------------------------------------------------------------------
*/


if($report->user)

{

$report->user->notify(

new AdminActivityNotification(

"🚨 Fraud Report Update",

"Your fraud report against {$report->brand_name} has been reviewed. Decision: {$request->decision}"

)

);

}







/*
|--------------------------------------------------------------------------
| NOTIFY SELLER
|--------------------------------------------------------------------------
*/


$seller = $report->sellerProfile;



if($seller && $seller->user)

{


if(
$request->action_taken == "Seller Warned"
||
$request->action_taken == "Suspend Seller"
)

{


$seller->user->notify(

new AdminActivityNotification(

"⚠️ Seller Compliance Notice",

"A regulator reviewed a fraud report against your business. Action taken: {$request->action_taken}"

)

);


}




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







return back()->with(

'success',

'Fraud investigation completed successfully.'

);


}




public function deleteReport($id)

{


$report = FraudReport::findOrFail($id);


$report->delete();



return back()->with(

'success',

'Report deleted successfully.'

);


}









/*
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
*/


public function reviews()

{


$reviews = Review::latest()->get();



return view(

'regulator.reviews',

compact('reviews')

);



}





public function hideReview($id)

{


$review = Review::findOrFail($id);


$review->status='hidden';


$review->save();



return back()->with(

'success',

'Review hidden successfully.'

);


}






public function restoreReview($id)

{


$review = Review::findOrFail($id);


$review->status='active';


$review->save();



return back()->with(

'success',

'Review restored successfully.'

);


}





public function deleteReview($id)

{


$review = Review::findOrFail($id);


$review->delete();



return back()->with(

'success',

'Review deleted successfully.'

);


}









/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/


public function showProfile()

{


$user = Auth::user();



return view(

'regulator.profile',

compact('user')

);



}






public function updateProfile(Request $request)

{


$user = Auth::user();



$request->validate([


'name'=>'required',

'email'=>'required|email',

'password'=>'nullable|min:8'


]);




$user->name=$request->name;


$user->email=$request->email;



if($request->filled('password'))

{


$user->password=bcrypt($request->password);


}



$user->save();



return back()->with(

'success',

'Profile updated successfully.'

);


}

/*
|--------------------------------------------------------------------------
| EDIT REGULATOR REVIEW
|--------------------------------------------------------------------------
*/


public function editReview($id)

{


$review = RegulatorReview::findOrFail($id);



return view(

'regulator.edit-review',

compact('review')

);


}








/*
|--------------------------------------------------------------------------
| UPDATE REGULATOR REVIEW
|--------------------------------------------------------------------------
*/


public function updateReview(Request $request,$id)

{


$request->validate([


'is_fair'=>'required',


'reason'=>'required|string'


]);





$review = RegulatorReview::findOrFail($id);





$review->update([


'is_fair'=>$request->is_fair,


'reason'=>$request->reason



]);





return redirect()

->route(

'regulator.seller.show',

$review->seller_id

)

->with(

'success',

'Regulator review updated successfully.'

);


}


}