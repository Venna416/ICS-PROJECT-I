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




if(!$sellerProfile)

{

abort(404,'Seller profile not found');

}






// ONLY ACTIVE REVIEWS

$reviews = Review::where(

'brand_name',

$sellerProfile->brand_name

)

->where(

'status',

'active'

)

->latest()

->get();






$reviewCount = $reviews->count();






// Fraud reports

$fraudCount = FraudReport::where(

'brand_name',

$sellerProfile->brand_name

)

->count();






$trustScore = $sellerProfile->trust_score;


$riskScore = $sellerProfile->risk_score;






if($riskScore === null)

{

$riskLevel = "Pending";

}

elseif($riskScore <= 3)

{

$riskLevel = "Low";

}

elseif($riskScore <= 6)

{

$riskLevel = "Medium";

}

else

{

$riskLevel = "High";

}






return view(

'seller.dashboard',

compact(

'sellerProfile',

'reviews',

'reviewCount',

'fraudCount',

'trustScore',

'riskScore',

'riskLevel'

)

);



}



}