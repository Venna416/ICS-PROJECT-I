<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\VerificationRequestController;
use App\Http\Controllers\ReviewController;
use App\Models\SellerProfile;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    return match ($role) {
        'buyer' => redirect()->route('buyer.dashboard'),
        'seller' => redirect()->route('seller.dashboard'),
        'regulator' => redirect()->route('regulator.dashboard'),
        'admin' => redirect()->route('admin.dashboard'),
        default => abort(403, 'Unauthorized'),
    };
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/buyer/dashboard', function () {
        return view('buyer.dashboard');
    })->name('buyer.dashboard');

    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');

    Route::get('/regulator/dashboard', function () {
        return view('regulator.dashboard');
    })->name('regulator.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/seller/profile', [SellerProfileController::class, 'show'])
    ->name('seller.profile.show');

    Route::get('/seller/profile/edit', [SellerProfileController::class, 'edit'])
    ->name('seller.profile.edit');

    Route::put('/seller/profile', [SellerProfileController::class, 'update'])
    ->name('seller.profile.update');

    Route::get('/buyer/seller/{id}', [BuyerController::class, 'showSeller'])
    ->name('buyer.seller.details');

    Route::post('/seller/{seller}/review', [ReviewController::class, 'store'])
    ->name('reviews.store');

    Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])
    ->name('reviews.edit');

    Route::put('/review/{id}', [ReviewController::class, 'update'])
    ->name('reviews.update');

    Route::get('/seller/verification/create', [VerificationRequestController::class, 'create'])->name('seller.verification.create');
    Route::post('/seller/verification/store', [VerificationRequestController::class, 'store'])->name('seller.verification.store');

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
        return view('buyer.search', compact('sellers'));
    })
        ->middleware('auth')
        ->name('buyer.search');

    Route::get('/seller/profile/create', [SellerProfileController::class, 'create'])->name('seller.profile.create');
    Route::post('/seller/profile/store', [SellerProfileController::class, 'store'])->name('seller.profile.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
