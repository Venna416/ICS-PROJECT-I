<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\SellerProfile;
use App\Models\Review;
use App\Models\FraudReport;
use App\Models\RegulatorReview;
use App\Models\User;

use App\Notifications\SellerVerificationStatus;
use App\Notifications\AdminActivityNotification;



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





// ONLY ACTIVE REVIEWS

$reviewCount = Review::where(

'status',

'active'

)->count();





$fraudCount = FraudReport::count();





$regulatorConcerns = RegulatorReview::where(

'is_fair',

0

)->count();






return view(

'admin.dashboard',

compact(

'pendingCount',

'verifiedCount',

'rejectedCount',

'reviewCount',

'fraudCount',

'regulatorConcerns'

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



$trust = 0;

$risk = 0;

$reasons = [];





// TRUST


if($request->valid_documents)

{

$trust +=20;

}

else

{

$reasons[]="No valid documents were provided.";

}





if($request->complete_profile)

{

$trust +=10;

}

else

{

$reasons[]="Seller profile incomplete.";

}





if($request->business_license)

{

$trust +=20;

}

else

{

$reasons[]="Business license not verified.";

}





if($request->good_reviews)

{

$trust +=20;

}

elseif($request->limited_reviews)

{

$trust +=10;

$reasons[]="Limited reviews.";

}

else

{

$reasons[]="Not enough positive reviews.";

}





// RISK


if($request->missing_documents)

{

$risk +=3;

$reasons[]="Missing documents.";

}



if($request->fraud_reports)

{

$risk +=4;

$reasons[]="Fraud reports received.";

}



if($request->poor_reviews)

{

$risk +=2;

$reasons[]="Poor reviews.";

}



if($request->incomplete_information)

{

$risk +=2;

$reasons[]="Incomplete information.";

}




if($risk > 10)

{

$risk = 10;

}





// DECISION


if($risk >=6 || $trust <40)

{

$status="rejected";

$verified=0;

$reasons[]="Seller rejected due to high risk.";

}



elseif($trust >=70 && $risk <=4)

{

$status="verified";

$verified=1;

$reasons[]="Seller passed verification.";

}



else

{

$status="pending";

$verified=0;

$reasons[]="More verification required.";

}







// SAVE


$seller->update([


'valid_documents'=>$request->has('valid_documents'),

'complete_profile'=>$request->has('complete_profile'),

'business_license'=>$request->has('business_license'),

'good_reviews'=>$request->has('good_reviews'),

'limited_reviews'=>$request->has('limited_reviews'),


'missing_documents'=>$request->has('missing_documents'),

'fraud_reports'=>$request->has('fraud_reports'),

'poor_reviews'=>$request->has('poor_reviews'),

'incomplete_information'=>$request->has('incomplete_information'),


'trust_score'=>$trust,

'risk_score'=>$risk,

'verification_status'=>$status,

'verified'=>$verified,

'verification_reason'=>implode(" ",$reasons)


]);






// SELLER NOTIFICATION


if($seller->user)

{


$seller->user->notify(

new SellerVerificationStatus($seller)

);


}







// REGULATOR NOTIFICATION


$regulators = User::where(

'role',

'regulator'

)->get();



foreach($regulators as $regulator)

{


$regulator->notify(

new AdminActivityNotification(

"🛡️ Seller Verification Update",

"Seller {$seller->brand_name} has been {$status}."

)

);


}







// CHECK IF FROM REGULATOR CONCERN


$regulatorConcern = RegulatorReview::where(

'seller_id',

$seller->id

)

->where(

'is_fair',

0

)

->where(

'reviewed',

false

)

->latest()

->first();





if($regulatorConcern)

{


$regulatorConcern->update([

'reviewed'=>true

]);



return redirect()

->route('admin.regulator.concerns')

->with(

'success',

'Regulator concern reviewed successfully.'

);


}







return redirect()

->route(

'admin.seller.show',

$seller->id

)

->with(

'success',

'Seller verification updated successfully.'

);


}







/*
|--------------------------------------------------------------------------
| EDIT VERIFICATION
|--------------------------------------------------------------------------
*/


public function editVerification(Request $request,$id)

{


$seller = SellerProfile::findOrFail($id);


$fromRegulator = $request->get('from') === 'regulator';



return view(

'admin.edit-verification',

compact(

'seller',

'fromRegulator'

)

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




if($request->search)

{


$query->where(function($q) use ($request){


$q->where(

'brand_name',

'like',

'%'.$request->search.'%'

)


->orWhere(

'seller_name',

'like',

'%'.$request->search.'%'

)


->orWhere(

'review',

'like',

'%'.$request->search.'%'

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

'admin.reviews',

compact('reviews')

);


}







/*
|--------------------------------------------------------------------------
| FRAUD REPORTS
|--------------------------------------------------------------------------
*/


public function fraudReports()

{


$reports = FraudReport::latest()->get();



return view(

'admin.fraud-reports',

compact('reports')

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








/*
|--------------------------------------------------------------------------
| REGULATOR CONCERNS
|--------------------------------------------------------------------------
*/


public function regulatorConcerns()

{


$concerns = RegulatorReview::with([

'seller',

'regulator'

])

->where(

'is_fair',

0

)

->latest()

->get();





return view(

'admin.regulator-concerns',

compact('concerns')

);


}



}