<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

use App\Models\Review;

use App\Models\FraudReport;



class SellerDashboardController extends Controller
{


public function index()
{


$user = Auth::user();



$sellerProfile = $user->sellerProfile;




if(!$sellerProfile){


return redirect()

->route('seller.profile.create');


}







// REVIEWS BY BRAND


$reviews = Review::where(
'seller_id', '=', Auth::id(), 'and'
)
->orderBy('created_at', 'desc')
->get();



$reviewCount = $reviews->count();









// FRAUD REPORTS BY BRAND


$fraudReports = FraudReport::where(

'brand_name',

'=',
$sellerProfile->brand_name,

'and'

)

->latest()

->get();



$fraudCount = $fraudReports->count();










$trustScore = $sellerProfile->trust_score;


$riskScore = $sellerProfile->risk_score;





if($riskScore === null){

$riskLevel="Pending";

}

elseif($riskScore <=3){

$riskLevel="Low";

}

elseif($riskScore <=7){

$riskLevel="Medium";

}

else{

$riskLevel="High";

}







return view(

'seller.dashboard',

compact(


'sellerProfile',


'reviews',


'reviewCount',


'fraudReports',


'fraudCount',


'trustScore',


'riskScore',


'riskLevel'


)

);



}



}