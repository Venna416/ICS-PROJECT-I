<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\SellerProfile;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\VerificationRequestController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FraudReportController;
use App\Http\Controllers\BuyerProfileController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\RegulatorController;


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


    $user = Auth::user();

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
    if ($user->role === 'buyer') {
        return redirect()->route('buyer.dashboard');
    }

    if ($user->role === 'regulator') {
        return redirect()->route('regulator.dashboard');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect('/');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | BUYER DASHBOARD
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
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        if ($user->role === 'buyer') {
            if ($user->buyerProfile) {
                return view('buyer.dashboard', [
                    'profile' => $user->buyerProfile,
                ]);
            }

            return redirect()->route('buyer.profile.create');
        }

        abort(403);
    })->name('buyer.dashboard');

    /*
    |--------------------------------------------------------------------------
    | BUYER PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/profile/create', [BuyerProfileController::class, 'create'])->name('buyer.profile.create');

    Route::post('/buyer/profile/store', [BuyerProfileController::class, 'store'])->name('buyer.profile.store');

    Route::get('/buyer/profile/{id}', [BuyerProfileController::class, 'show'])->name('buyer.profile.show');

    Route::get('/buyer/profile/{id}/edit', [BuyerProfileController::class, 'edit'])->name('buyer.profile.edit');

    Route::put('/buyer/profile/{id}', [BuyerProfileController::class, 'update'])->name('buyer.profile.update');

    Route::get('/buyer/reports/create/{id}', [FraudReportController::class, 'create'])->name('buyer.reports.create');

    Route::post('/buyer/reports', [FraudReportController::class, 'store'])->name('buyer.reports.store');


    Route::delete('/buyer/profile/{id}', [BuyerProfileController::class, 'destroy'])->name('buyer.profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | FRAUD REPORTS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/reports', fn() => view('buyer.reports'))->name('buyer.reports');

    Route::post('/buyer/reports', [FraudReportController::class, 'store'])->name('buyer.reports.store');

    /*
    |--------------------------------------------------------------------------
    | BUYER REVIEWS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/reviews', fn() => view('buyer.reviews'))->name('buyer.reviews');

    Route::post('/buyer/reviews', [ReviewController::class, 'store'])->name('buyer.reviews.store');

    /*
    |--------------------------------------------------------------------------
    | SEARCH SELLERS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/search', function () {
        $search = request('search');


        $sellers = SellerProfile::query()
            ->when($search, function ($query) use ($search) {
                $query
                    ->where('brand_name', 'like', "%{$search}%")
                    ->orWhere('business_category', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
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
    | SELLER DETAILS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/seller/{id}', [BuyerController::class, 'showSeller'])->name('buyer.seller.details');

    /*
    |--------------------------------------------------------------------------
    | REVIEW SYSTEM
    |--------------------------------------------------------------------------
    */
    Route::post('/reviews/{sellerId}', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');

    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');

    /*
    |--------------------------------------------------------------------------
    | SELLER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');

    /*
    |--------------------------------------------------------------------------
    | SELLER PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/seller/profile/create', [SellerProfileController::class, 'create'])->name('seller.profile.create');

    Route::post('/seller/profile/store', [SellerProfileController::class, 'store'])->name('seller.profile.store');

    Route::get('/seller/profile/{id}', [SellerProfileController::class, 'show'])->name('seller.profile.show');

    Route::get('/seller/profile/{id}/edit', [SellerProfileController::class, 'edit'])->name('seller.profile.edit');

    Route::put('/seller/profile/{id}', [SellerProfileController::class, 'update'])->name('seller.profile.update');

    Route::delete('/seller/profile/{id}', [SellerProfileController::class, 'destroy'])->name('seller.profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | VERIFICATION REQUESTS
    |--------------------------------------------------------------------------
    */
    Route::get('/seller/verification/create', [VerificationRequestController::class, 'create'])->name('seller.verification.create');

    Route::post('/seller/verification/store', [VerificationRequestController::class, 'store'])->name('seller.verification.store');

    /*
    |--------------------------------------------------------------------------
    | REGULATOR
    |--------------------------------------------------------------------------
    */
    Route::get('/regulator/dashboard', [RegulatorController::class, 'index'])
    ->name('regulator.dashboard');

    Route::get('/regulator/sellers', [RegulatorController::class, 'sellers'])
    ->name('regulator.sellers');

    Route::post('/regulator/sellers/{id}/approve', [RegulatorController::class, 'approve'])
    ->name('regulator.sellers.approve');

    Route::post('/regulator/sellers/{id}/reject', [RegulatorController::class, 'reject'])
    ->name('regulator.sellers.reject');

    Route::get('/regulator/reports', [RegulatorController::class, 'reports'])
    ->name('regulator.reports');

    Route::patch('/regulator/reports/{id}/resolve', [RegulatorController::class, 'resolveReport'])
    ->name('regulator.reports.resolve');

    Route::delete('/regulator/reports/{id}', [RegulatorController::class, 'deleteReport'])
    ->name('regulator.reports.delete');

    Route::get('/regulator/reviews', [RegulatorController::class, 'reviews'])
    ->name('regulator.reviews');

    Route::patch('/regulator/reviews/{id}/hide', [RegulatorController::class, 'hideReview'])
    ->name('regulator.reviews.hide');

    Route::patch('/regulator/reviews/{id}/restore', [RegulatorController::class, 'restoreReview'])
    ->name('regulator.reviews.restore');

    Route::delete('/regulator/reviews/{id}', [RegulatorController::class, 'deleteReview'])
    ->name('regulator.reviews.delete');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE REDIRECTION
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


        if ($user->role === 'seller') {
            return $user->sellerProfile ? redirect()->route('seller.profile.show', $user->sellerProfile->id) : redirect()->route('seller.profile.create');
        }

        if ($user->role === 'buyer') {
            return $user->buyerProfile ? redirect()->route('buyer.profile.show', $user->buyerProfile->id) : redirect()->route('buyer.profile.create');
        }

        if ($user->role === 'regulator') {
            return redirect()->route('regulator.dashboard');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect('/');
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


    /*
    | JETSTREAM PROFILE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';