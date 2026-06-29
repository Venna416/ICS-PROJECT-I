<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SellerProfile;
use App\Models\BuyerProfile;



class CheckProfileCompleted
{


public function handle(Request $request, Closure $next)
{


$user = Auth::user();



if(!$user)
{

return redirect()->route('login');

}





// SELLER

if($user->role == 'seller')
{


$profile = SellerProfile::query()->firstWhere(

'user_id',

$user->id

);



if(!$profile)
{


return redirect()

->route('seller.profile.create')

->with(

'error',

'Please complete your seller profile first.'

);


}


}






// BUYER

if($user->role == 'buyer')
{


$profile = BuyerProfile::query()->firstWhere(

'user_id',

$user->id

);



if(!$profile)
{


return redirect()

->route('buyer.profile.create')

->with(

'error',

'Please complete your buyer profile first.'

);


}


}






return $next($request);



}


}