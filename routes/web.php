<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\VerificationRequestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FraudReportController;
use App\Http\Controllers\BuyerProfileController;
use App\Http\Controllers\AdminController;

use App\Models\SellerProfile;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();


    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }


    if ($user->role === 'seller') {
        return redirect()->route('seller.dashboard');
    }


    return redirect()->route('buyer.dashboard');


})->middleware(['auth','verified'])->name('dashboard');



/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | BUYER
    |--------------------------------------------------------------------------
    */


    Route::get('/buyer/dashboard', function () {

        $user = Auth::user();


        if($user->role !== 'buyer'){
            abort(403);
        }


        if($user->buyerProfile){

            return view(
                'buyer.dashboard',
                ['profile'=>$user->buyerProfile]
            );

        }


        return redirect()
            ->route('buyer.profile.create');


    })->name('buyer.dashboard');



    Route::get('/buyer/reports', function(){

        return view('buyer.reports');

    })->name('buyer.reports');


    Route::post('/buyer/reports',
        [FraudReportController::class,'store']
    )->name('buyer.reports.store');



    Route::get('/buyer/reviews', function(){

        return view('buyer.reviews');

    })->name('buyer.reviews');



    Route::post('/buyer/reviews',
        [ReviewController::class,'store']
    )->name('buyer.reviews.store');




    // Buyer Profile CRUD

    Route::get('/buyer/profile/create',
        [BuyerProfileController::class,'create']
    )->name('buyer.profile.create');


    Route::post('/buyer/profile/store',
        [BuyerProfileController::class,'store']
    )->name('buyer.profile.store');


    Route::get('/buyer/profile/{id}',
        [BuyerProfileController::class,'show']
    )->name('buyer.profile.show');


    Route::get('/buyer/profile/{id}/edit',
        [BuyerProfileController::class,'edit']
    )->name('buyer.profile.edit');


    Route::put('/buyer/profile/{id}',
        [BuyerProfileController::class,'update']
    )->name('buyer.profile.update');


    Route::delete('/buyer/profile/{id}',
        [BuyerProfileController::class,'destroy']
    )->name('buyer.profile.destroy');



    // Buyer Search Sellers

    Route::get('/buyer/search', function(){

        $search = request('search');


        $sellers = SellerProfile::query()

            ->when($search,function($query) use ($search){

                $query->where('brand_name','like',"%$search%")
                ->orWhere('business_category','like',"%$search%")
                ->orWhere('location','like',"%$search%");

            })

            ->get();


        return view(
            'buyer.search',
            compact('sellers')
        );


    })->name('buyer.search');






    /*
    |--------------------------------------------------------------------------
    | SELLER
    |--------------------------------------------------------------------------
    */


    Route::get('/seller/dashboard',
        [SellerDashboardController::class,'index']
    )->name('seller.dashboard');



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



    // Verification

    Route::get('/seller/verification/create',
        [VerificationRequestController::class,'create']
    )->name('seller.verification.create');


    Route::post('/seller/verification/store',
        [VerificationRequestController::class,'store']
    )->name('seller.verification.store');







    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */


    Route::middleware(['is_admin'])->group(function(){


        Route::get('/admin/dashboard',
            [AdminController::class,'index']
        )->name('admin.dashboard');



        Route::post('/admin/sellers/{id}/verify',
            [AdminController::class,'verifySeller']
        )->name('admin.verifySeller');


    });







    /*
    |--------------------------------------------------------------------------
    | PROFILE REDIRECT
    |--------------------------------------------------------------------------
    */


    Route::get('/profile', function(){


        $user = Auth::user();



        if($user->role === 'admin'){

            return redirect()
                ->route('admin.dashboard');

        }



        if($user->role === 'seller'){


            return $user->sellerProfile

            ? redirect()->route(
                'seller.profile.show',
                $user->sellerProfile->id
            )

            : redirect()->route(
                'seller.profile.create'
            );

        }




        if($user->role === 'buyer'){


            return $user->buyerProfile

            ? redirect()->route(
                'buyer.profile.show',
                $user->buyerProfile->id
            )

            : redirect()->route(
                'buyer.profile.create'
            );

        }



        abort(403);


    })->name('profile.edit');





    /*
    |--------------------------------------------------------------------------
    | Profile Update/Delete
    |--------------------------------------------------------------------------
    */


    Route::patch('/profile',
        [ProfileController::class,'update']
    )->name('profile.update');


    Route::delete('/profile',
        [ProfileController::class,'destroy']
    )->name('profile.destroy');


});



require __DIR__.'/auth.php';