<?php

namespace App\Http\Controllers;

use App\Models\FraudReport;
use App\Models\SellerProfile;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegulatorController extends Controller
{
    public function dashboard(): View
    {
        $totalSellers = SellerProfile::count('*');

        $verifiedSellers = SellerProfile::where('verification_status', '=','verified', 'and')->count('*');

        $pendingSellers = SellerProfile::where('verification_status', '=', 'pending', 'and')->count('*');

        $rejectedSellers = SellerProfile::where('verification_status', '=', 'rejected', 'and')->count('*');

        $totalReviews = Review::count('*');

        $pendingReviews = Review::where('status', '=', 'pending', 'and')->count('*');

        $totalFraudReports = FraudReport::count('*');

        return view('regulator.dashboard', compact('totalSellers', 'verifiedSellers', 'pendingSellers', 'rejectedSellers', 'totalReviews', 'pendingReviews', 'totalFraudReports'));
    }

    public function sellers(): View
    {
        $sellers = SellerProfile::query()->orderByDesc('created_at')->get();

        return view('regulator.sellers', compact('sellers'));
    }

    public function approve(int $id): RedirectResponse
    {
        $seller = SellerProfile::findOrFail($id);

        $seller->update([
            'verification_status' => 'verified',
        ]);

        return back()->with('success', 'Seller approved successfully.');
    }

    public function reject(int $id): RedirectResponse
    {
        $seller = SellerProfile::findOrFail($id);

        $seller->update([
            'verification_status' => 'rejected',
        ]);

        return back()->with('success', 'Seller rejected successfully.');
    }

    public function reports()
    {
        $reports = FraudReport::latest('created_at')->get();
        return view('regulator.reports', compact('reports'));
    }

    public function resolveReport($id)
    {
        $report = FraudReport::findOrFail($id);
        $report->status = 'resolved';
        $report->save();

        return back()->with('success', 'Report resolved successfully.');
    }

    public function reviews()
    {
        $reviews = Review::latest('created_at')->get();
        return view('regulator.reviews', compact('reviews'));
    }

    public function hideReview($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'hidden';
        $review->save();

        return back()->with('success', 'Review hidden successfully.');
    }

    public function restoreReview($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'active';
        $review->save();

        return back()->with('success', 'Review restored successfully.');
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }

    public function deleteReport($id)
    {
        $report = FraudReport::findOrFail($id);
        $report->delete();

        return back()->with('success', 'Report deleted successfully.');
    }
}
