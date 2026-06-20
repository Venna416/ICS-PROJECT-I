<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SellerProfile;
use App\Models\Review;
use App\Models\FraudReport;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $sellerProfile = $user->sellerProfile;

        // Redirect if profile not created
        if (!$sellerProfile) {
            return redirect()->route('seller.profile.create')
                ->with('warning', 'Please complete your profile first.');
        }

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD METRICS
        |--------------------------------------------------------------------------
        | Later these will connect to real tables (reviews, fraud reports, etc.)
        */

      $reviewCount = Review::where('seller_name', '=', $sellerProfile->brand_name)->count();
      $fraudCount = FraudReport::where('seller_name', '=', $sellerProfile->brand_name)->count();
        // Buyer searches (you can implement tracking later)
        $searchCount = 0;

        /*
        |--------------------------------------------------------------------------
        | TRUST SCORE LOGIC (simple starter version)
        |--------------------------------------------------------------------------
        */
        $trustScore = 50;

        if ($sellerProfile->verification_status === 'verified') {
            $trustScore += 30;
        } elseif ($sellerProfile->verification_status === 'pending') {
            $trustScore += 10;
        }

        if ($reviewCount > 5) {
            $trustScore += 10;
        }

        if ($fraudCount > 0) {
            $trustScore -= 20;
        }

        // Clamp score between 0 and 100
        $trustScore = max(0, min(100, $trustScore));

        /*
        |--------------------------------------------------------------------------
        | RISK LEVEL
        |--------------------------------------------------------------------------
        */
        $riskLevel = match (true) {
            $trustScore >= 80 => 'Low',
            $trustScore >= 50 => 'Medium',
            default => 'High',
        };

        return view('seller.dashboard', compact(
            'sellerProfile',
            'reviewCount',
            'fraudCount',
            'searchCount',
            'trustScore',
            'riskLevel'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_photo'      => 'required|image|max:2048',
            'id_front'           => 'required|image|max:2048',
            'id_back'            => 'required|image|max:2048',
            'brand_name'         => 'required|string|max:255',
            'business_category'  => 'required|string|max:255',
            'location'           => 'required|string|max:255',
            'phone_number'       => 'required|string|max:20',
            'social_platform'    => 'nullable|string|max:255',
            'shop_link'          => 'nullable|url',
            'description'        => 'nullable|string',
        ]);

        $profile = Auth::user()->sellerProfile()->create([
            'brand_name'         => $request->brand_name,
            'business_category'  => $request->business_category,
            'location'           => $request->location,
            'phone_number'       => $request->phone_number,
            'social_platform'    => $request->social_platform,
            'shop_link'          => $request->shop_link,
            'description'        => $request->description,
            'profile_photo'      => $request->file('profile_photo')->store('profiles', 'public'),
            'id_front'           => $request->file('id_front')->store('ids', 'public'),
            'id_back'            => $request->file('id_back')->store('ids', 'public'),
            'verification_status'=> 'pending',
        ]);

        return redirect()->route('seller.profile.show', $profile->id)
            ->with('success', 'Profile submitted for verification.');
    }
}
