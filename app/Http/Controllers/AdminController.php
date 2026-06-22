<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with all sellers grouped by status.
     */
    public function index()
    {
        $pendingSellers = SellerProfile::where('verification_status', '=', 'pending', 'and')->get();
        $verifiedSellers = SellerProfile::where('verification_status', '=', 'verified', 'and')->get();
        $rejectedSellers = SellerProfile::where('verification_status', '=', 'rejected', 'and')->get();

        // ✅ compact must be written correctly
        return view('admin.dashboard', compact('pendingSellers', 'verifiedSellers', 'rejectedSellers'));
    }

    /**
     * Verify or reject a seller and assign scores.
     */
    public function verifySeller(Request $request, $id)
    {
        $seller = SellerProfile::findOrFail($id);

        // Update verification status
        $seller->verification_status = $request->status; // 'verified' or 'rejected'
        $seller->verified = $request->status === 'verified';

        // Assign scores
        $seller->risk_score = $request->risk_score;
        $seller->trust_score = $request->trust_score;

        $seller->save();

        return redirect()->route('admin.dashboard')->with('success', 'Seller updated successfully.');
    }
}

