<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Models\SellerProfile;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\VerificationRequestController;

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\BuyerProfileController;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FraudReportController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegulatorController;



/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/


Route::get('/', function(){

    return view('welcome');

});





/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/


Route::get('/dashboard', function(){


    $user = Auth::user();



    return match($user->role){


        'admin' => redirect()->route('admin.dashboard'),


        'seller' => redirect()->route('seller.dashboard'),


        'buyer' => redirect()->route('buyer.dashboard'),


        'regulator' => redirect()->route('regulator.dashboard'),



        default => abort(403)

    };



})->middleware(['auth','verified'])

->name('dashboard');










/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function(){







/*
|--------------------------------------------------------------------------
| BUYER
|--------------------------------------------------------------------------
*/



Route::get('/buyer/dashboard',function(){


$user = Auth::user();



if($user->role !== 'buyer'){

abort(403);

}



return view(
'buyer.dashboard',
[
'profile'=>$user->buyerProfile
]
);



})->name('buyer.dashboard');








Route::get('/buyer/profile/create',
[BuyerProfileController::class,'create'])

->name('buyer.profile.create');





Route::post('/buyer/profile/store',
[BuyerProfileController::class,'store'])

->name('buyer.profile.store');





Route::get('/buyer/profile/{id}',
[BuyerProfileController::class,'show'])

->name('buyer.profile.show');





Route::get('/buyer/profile/{id}/edit',
[BuyerProfileController::class,'edit'])

->name('buyer.profile.edit');





Route::put('/buyer/profile/{id}',
[BuyerProfileController::class,'update'])

->name('buyer.profile.update');





Route::delete('/buyer/profile/{id}',
[BuyerProfileController::class,'destroy'])

->name('buyer.profile.destroy');









/*
|--------------------------------------------------------------------------
| BUYER SEARCH
|--------------------------------------------------------------------------
*/



Route::get('/buyer/search',function(){

    $search = request('search');


    $sellers = SellerProfile::where(
        'verification_status',
        'verified'
    )


    ->when($search, function($query) use ($search){


        $query->where(function($q) use ($search){


            $q->where(
                'brand_name',
                'LIKE',
                "%".$search."%"
            )

            ->orWhere(
                'business_category',
                'LIKE',
                "%".$search."%"
            )

            ->orWhere(
                'location',
                'LIKE',
                "%".$search."%"
            );


        });


    })


    ->get();



    return view(
        'buyer.search',
        compact('sellers')
    );


})->name('buyer.search');



/*
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
*/


Route::get('/buyer/reviews',function(){


return view('buyer.reviews');


})->name('buyer.reviews');





Route::post('/buyer/reviews',

[ReviewController::class,'store']

)->name('buyer.reviews.store');





Route::get('/review/success',

[ReviewController::class,'success']

)->name('review.success');



/*
|--------------------------------------------------------------------------
| REPORTS
|--------------------------------------------------------------------------
*/


Route::get('/buyer/reports',

function(){

    return view('buyer.reports');

}

)->name('buyer.reports');





Route::post('/buyer/reports',

[FraudReportController::class,'store']

)->name('buyer.reports.store');





/*
|--------------------------------------------------------------------------
| FRAUD REPORT SUCCESS PAGE
|--------------------------------------------------------------------------
*/


Route::get('/buyer/report/success',

function(){

    return view('buyer.report-success');

}

)->name('buyer.report.success');


/*
|--------------------------------------------------------------------------
| SELLER
|--------------------------------------------------------------------------
*/


Route::get('/seller/dashboard',

[SellerDashboardController::class,'index']

)->name('seller.dashboard');





/*
|--------------------------------------------------------------------------
| SELLER REVIEWS
|--------------------------------------------------------------------------
*/


Route::get('/seller/reviews',

function(){


    $seller = Auth::user()->sellerProfile;


    $reviews = \App\Models\Review::where(

        'brand_name',

        $seller->brand_name

    )

    ->latest()

    ->get();



    return view(

        'seller.reviews',

        compact('reviews')

    );


}

)->name('seller.reviews');







/*
|--------------------------------------------------------------------------
| SELLER PROFILE
|--------------------------------------------------------------------------
*/


Route::get('/seller/profile/create',

[SellerProfileController::class,'create']

)->name('seller.profile.create');





Route::post('/seller/profile/store',

[SellerProfileController::class,'store']

)->name('seller.profile.store');






Route::get('/seller/profile/{id}',

[SellerProfileController::class,'show']

)->name('seller.profile.show');






Route::get('/seller/profile/{id}/edit',

[SellerProfileController::class,'edit']

)->name('seller.profile.edit');






Route::put('/seller/profile/{id}',

[SellerProfileController::class,'update']

)->name('seller.profile.update');






Route::delete('/seller/profile/{id}',

[SellerProfileController::class,'destroy']

)->name('seller.profile.destroy');









/*
|--------------------------------------------------------------------------
| VERIFICATION
|--------------------------------------------------------------------------
*/


Route::get('/seller/verification/create',

[VerificationRequestController::class,'create']

)->name('seller.verification.create');




Route::post('/seller/verification/store',

[VerificationRequestController::class,'store']

)->name('seller.verification.store');









/*
|--------------------------------------------------------------------------
| SELLER DETAILS FOR BUYERS
|--------------------------------------------------------------------------
*/


Route::get('/buyer/seller/{id}',

[BuyerController::class,'showSeller']

)->name('buyer.seller.details');



/*
|--------------------------------------------------------------------------
| BUYER VIEW SELLER REVIEWS
|--------------------------------------------------------------------------
*/


Route::get('/buyer/seller/{id}/reviews',

function($id){


    $seller = SellerProfile::findOrFail($id);



    $reviews = \App\Models\Review::where(

        'brand_name',

        $seller->brand_name

    )

    ->latest()

    ->get();



    return view(

        'buyer.seller-reviews',

        compact(

            'seller',

            'reviews'

        )

    );


}

)->name('buyer.seller.reviews');







/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/


Route::middleware('is_admin')->group(function(){



    // Dashboard

    Route::get('/admin/dashboard',

    [AdminController::class,'index'])

    ->name('admin.dashboard');




    // Pending sellers

    Route::get('/admin/pending',

    [AdminController::class,'pending'])

    ->name('admin.pending');




    // Verified sellers

    Route::get('/admin/verified',

    [AdminController::class,'verified'])

    ->name('admin.verified');




    // Rejected sellers

    Route::get('/admin/rejected',

    [AdminController::class,'rejected'])

    ->name('admin.rejected');





    // Full seller review

    Route::get('/admin/seller/{id}',

    [AdminController::class,'showSeller'])

    ->name('admin.seller.show');





    // Approve / reject

    Route::post('/admin/sellers/{id}/verify',

    [AdminController::class,'verifySeller'])

    ->name('admin.verifySeller');






    // Edit verification

    Route::get('/admin/seller/{id}/edit',

    [AdminController::class,'editVerification'])

    ->name('admin.editVerification');






    // Update verification

    Route::put('/admin/seller/{id}/update',

    [AdminController::class,'updateVerification'])

    ->name('admin.updateVerification');
   
    // Buyer Reviews

Route::get('/admin/reviews',

[AdminController::class,'reviews'])

->name('admin.reviews');





// Fraud Reports

Route::get('/admin/fraud-reports',

[AdminController::class,'fraudReports'])

->name('admin.fraudReports');


Route::get('/admin/fraud-report/{id}',

[AdminController::class,'showFraud'])

->name('admin.fraud.show');

});







/*
|--------------------------------------------------------------------------
| REGULATOR
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| REGULATOR
|--------------------------------------------------------------------------
*/



Route::get('/regulator/dashboard',

[RegulatorController::class,'index']

)->name('regulator.dashboard');





Route::get('/regulator/sellers',

[RegulatorController::class,'sellers']

)->name('regulator.sellers');





Route::get('/regulator/reports',

[RegulatorController::class,'reports']

)->name('regulator.reports');





Route::get('/regulator/reviews',

[RegulatorController::class,'reviews']

)->name('regulator.reviews');









/*
|--------------------------------------------------------------------------
| PROFILE REDIRECT
|--------------------------------------------------------------------------
*/



Route::get('/profile',function(){


$user=Auth::user();



return match($user->role){


'admin'=>redirect()->route('admin.dashboard'),


'seller'=> $user->sellerProfile

? redirect()->route(
'seller.profile.show',
$user->sellerProfile->id
)

: redirect()->route(
'seller.profile.create'
),



'buyer'=> $user->buyerProfile

? redirect()->route(
'buyer.profile.show',
$user->buyerProfile->id
)

: redirect()->route(
'buyer.profile.create'
),



'regulator'=>redirect()->route('regulator.dashboard'),



default=>abort(403)


};



})->name('profile.edit');








Route::patch('/profile',

[ProfileController::class,'update']

)->name('profile.update');




Route::delete('/profile',

[ProfileController::class,'destroy']

)->name('profile.destroy');



});






require __DIR__.'/auth.php';