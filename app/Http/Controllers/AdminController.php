<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;
use App\Models\Review;
use App\Models\FraudReport;
use App\Notifications\SellerVerificationStatus;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $pendingCount = SellerProfile::where('verification_status', '=', 'pending', 'and')->count('*');
        $verifiedCount = SellerProfile::where('verification_status', '=', 'verified', 'and')->count('*');
        $rejectedCount = SellerProfile::where('verification_status', '=', 'rejected', 'and')->count('*');
        $reviewCount = Review::count('*');
        $fraudCount = FraudReport::count('*');

        return view('admin.dashboard', compact(
            'pendingCount',
            'verifiedCount',
            'rejectedCount',
            'reviewCount',
            'fraudCount'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PENDING SELLERS
    |--------------------------------------------------------------------------
    */
    public function pending()
    {
        $sellers = SellerProfile::with('user')
            ->where('verification_status', '=', 'pending', 'and')
            ->get();

        return view('admin.pending', compact('sellers'));
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFIED SELLERS
    |--------------------------------------------------------------------------
    */
    public function verified()
    {
        $sellers = SellerProfile::with('user')
            ->where('verification_status', '=', 'verified', 'and')
            ->get();

        return view('admin.verified', compact('sellers'));
    }

    /*
    |--------------------------------------------------------------------------
    | REJECTED SELLERS
    |--------------------------------------------------------------------------
    */
    public function rejected()
    {
        $sellers = SellerProfile::with('user')
            ->where('verification_status', '=', 'rejected', 'and')
            ->get();

        return view('admin.rejected', compact('sellers'));
    }

    /*
    |--------------------------------------------------------------------------
    | SELLER DETAILS
    |--------------------------------------------------------------------------
    */
    public function showSeller($id)
    {
        $seller = SellerProfile::with(['user', 'documents'])->findOrFail($id);

        return view('admin.seller-show', compact('seller'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE VERIFICATION STATUS (FIXED COMPLIANCE ARRAY CRASH)
    |--------------------------------------------------------------------------
    */
    public function updateVerification(Request $request, $id)
    {
        $seller = SellerProfile::findOrFail($id);

        $trust = 0;
        $risk = 0;
        $reasons = [];

        /* --- TRUST SCORE CALCULATION --- */
        if ($request->valid_documents) {
            $trust += 20;
        } else {
            $reasons[] = 'No valid documents were provided.';
        }

        if ($request->complete_profile) {
            $trust += 10;
        } else {
            $reasons[] = 'Seller profile information is incomplete.';
        }

        if ($request->business_license) {
            $trust += 20;
        } else {
            $reasons[] = 'Business license has not been verified.';
        }

        if ($request->good_reviews) {
            $trust += 20;
        } elseif ($request->limited_reviews) {
            $trust += 10;
            $reasons[] = 'Seller has less than 3 reviews or average rating is below 4 stars.';
        } else {
            $reasons[] = 'Seller does not have enough positive buyer reviews.';
        }

        /* --- RISK SCORE CALCULATION --- */
        if ($request->missing_documents) {
            $risk += 3;
            $reasons[] = 'Risk increased because documents are missing.';
        }

        if ($request->fraud_reports) {
            $risk += 4;
            $reasons[] = 'Risk increased because fraud reports were received.';
        }

        if ($request->poor_reviews) {
            $risk += 2;
            $reasons[] = 'Risk increased because customer reviews are poor.';
        }

        if ($request->incomplete_information) {
            $risk += 2;
            $reasons[] = 'Risk increased because business information is incomplete.';
        }

        // Hard cap risk at a maximum value of 10
        if ($risk > 10) {
            $risk = 10;
        }

        /* --- AUTOMATIC STATUS DECISION --- */
        if ($risk >= 6 || $trust < 40) {
            $status = 'rejected';
            $verified = 0; // Stored as tinyint(1)
            $reasons[] = 'Seller rejected because risk is high or trust score is too low.';
        } elseif ($trust >= 70 && $risk <= 4) {
            $status = 'verified';
            $verified = 1; // Stored as tinyint(1)
            $reasons[] = 'Seller passed verification requirements.';
        } else {
            $status = 'pending';
            $verified = 0;
            $reasons[] = 'Seller requires more verification.';
        }

        /* --- SAVE TO DATABASE (Only keeping elements matching your actual DB Columns) --- */
        $seller->update([
            'trust_score'         => $trust,
            'risk_score'          => $risk,
            'verification_status' => $status,
            'verified'            => $verified,
            'verification_reason' => implode(' ', $reasons),
        ]);

        // SEND SELLER NOTIFICATION
        if ($seller->user) {
            $seller->user->notify(new SellerVerificationStatus($seller));
        }

        return redirect()
            ->route('admin.seller.show', $seller->id)
            ->with('success', 'Seller verification calculated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT VERIFICATION
    |--------------------------------------------------------------------------
    */
    public function editVerification($id)
    {
        $seller = SellerProfile::findOrFail($id);

        return view('admin.edit-verification', compact('seller'));
    }

    /*
    |--------------------------------------------------------------------------
    | BUYER REVIEWS
    |--------------------------------------------------------------------------
    */
    public function reviews(Request $request)
    {
        $query = Review::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                // If search input matches against linked names
                $q->where('comment', 'like', '%' . $request->search . '%');
            });
        }

        $reviews = $query->latest()->get();

        return view('admin.reviews', compact('reviews'));
    }

    /*
    |--------------------------------------------------------------------------
    | FRAUD REPORTS
    |--------------------------------------------------------------------------
    */
    public function fraudReports(Request $request)
    {
        $search = $request->search;

        $reports = FraudReport::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('reason', 'LIKE', '%' . $search . '%')
                      ->orWhere('description', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return view('admin.fraud-reports', compact('reports', 'search'));
    }

    public function showFraud($id)
    {
        $report = FraudReport::findOrFail($id);

        return view('admin.fraud-show', compact('report'));
    }
}