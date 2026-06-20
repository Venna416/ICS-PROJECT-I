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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('profile.edit');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | BUYER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/dashboard', function () {

        $user = Auth::user();

        if ($user->role === 'buyer') {

            if ($user->buyerProfile) {
                return view('buyer.dashboard', [
                    'profile' => $user->buyerProfile
                ]);
            }

            return redirect()->route('buyer.profile.create');
        }

        abort(403, 'Unauthorized');

    })->name('buyer.dashboard');

    /*
    |--------------------------------------------------------------------------
    | BUYER PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/profile/create', [BuyerProfileController::class, 'create'])
        ->name('buyer.profile.create');

    Route::post('/buyer/profile/store', [BuyerProfileController::class, 'store'])
        ->name('buyer.profile.store');

    Route::get('/buyer/profile/{id}', [BuyerProfileController::class, 'show'])
        ->name('buyer.profile.show');

    Route::get('/buyer/profile/{id}/edit', [BuyerProfileController::class, 'edit'])
        ->name('buyer.profile.edit');

    Route::put('/buyer/profile/{id}', [BuyerProfileController::class, 'update'])
        ->name('buyer.profile.update');

    /*
    |--------------------------------------------------------------------------
    | FRAUD REPORTS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/reports', fn() => view('buyer.reports'))
        ->name('buyer.reports');

    Route::post('/buyer/reports', [FraudReportController::class, 'store'])
        ->name('buyer.reports.store');

    /*
    |--------------------------------------------------------------------------
    | BUYER REVIEWS PAGE
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/reviews', fn() => view('buyer.reviews'))
        ->name('buyer.reviews');

    Route::post('/buyer/reviews', [ReviewController::class, 'store'])
        ->name('buyer.reviews.store');

    /*
    |--------------------------------------------------------------------------
    | SEARCH SELLERS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/search', function () {

        $search = request('search');

        $sellers = SellerProfile::query()
            ->when($search, function ($query) use ($search) {
                $query->where('brand_name', 'like', "%{$search}%")
                    ->orWhere('business_category', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->get();

        return view('buyer.search', compact('sellers'));

    })->name('buyer.search');

    /*
    |--------------------------------------------------------------------------
    | SELLER DETAILS
    |--------------------------------------------------------------------------
    */
    Route::get('/buyer/seller/{id}', [BuyerController::class, 'showSeller'])
        ->name('buyer.seller.details');

    /*
    |--------------------------------------------------------------------------
    | REVIEW SYSTEM
    |--------------------------------------------------------------------------
    */
    Route::post('/reviews/{sellerId}', [ReviewController::class, 'store'])
        ->name('reviews.store');

    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])
        ->name('reviews.edit');

    Route::put('/reviews/{id}', [ReviewController::class, 'update'])
        ->name('reviews.update');

    /*
    |--------------------------------------------------------------------------
    | SELLER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])
        ->name('seller.dashboard');

    /*
    |--------------------------------------------------------------------------
    | SELLER PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/seller/profile/create', [SellerProfileController::class, 'create'])
        ->name('seller.profile.create');

    Route::post('/seller/profile/store', [SellerProfileController::class, 'store'])
        ->name('seller.profile.store');

    Route::get('/seller/profile/{id}', [SellerProfileController::class, 'show'])
        ->name('seller.profile.show');

    Route::get('/seller/profile/{id}/edit', [SellerProfileController::class, 'edit'])
        ->name('seller.profile.edit');

    Route::put('/seller/profile/{id}', [SellerProfileController::class, 'update'])
        ->name('seller.profile.update');

    Route::delete('/seller/profile/{id}', [SellerProfileController::class, 'destroy'])
        ->name('seller.profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | VERIFICATION REQUESTS
    |--------------------------------------------------------------------------
    */
    Route::get('/seller/verification/create',
        [VerificationRequestController::class, 'create'])
        ->name('seller.verification.create');

    Route::post('/seller/verification/store',
        [VerificationRequestController::class, 'store'])
        ->name('seller.verification.store');

    /*
    |--------------------------------------------------------------------------
    | REGULATOR
    |--------------------------------------------------------------------------
    */
    Route::get('/regulator/dashboard', function () {
        return view('regulator.dashboard');
    })->name('regulator.dashboard');

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
    Route::get('/profile', function () {

        $user = Auth::user();

        if ($user->role === 'seller') {

            return $user->sellerProfile
                ? redirect()->route('seller.profile.show', $user->sellerProfile->id)
                : redirect()->route('seller.profile.create');
        }

        if ($user->role === 'buyer') {

            return $user->buyerProfile
                ? redirect()->route('buyer.profile.show', $user->buyerProfile->id)
                : redirect()->route('buyer.profile.create');
        }

        return redirect()->route('dashboard');

    })->name('profile.edit');

    /*
    |--------------------------------------------------------------------------
    | JETSTREAM PROFILE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';