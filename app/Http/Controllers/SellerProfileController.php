<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;
use Illuminate\Support\Facades\Auth;

class SellerProfileController extends Controller
{
    public function create()
    {
        return view('seller.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required',
            'business_category' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
            'social_platform' => 'required',
        ]);

        SellerProfile::create([
            'user_id' => Auth::id(),
            'brand_name' => $request->brand_name,
            'business_category' => $request->business_category,
            'location' => $request->location,
            'phone_number' => $request->phone_number,
            'social_platform' => $request->social_platform,
            'shop_link' => $request->shop_link,
            'description' => $request->description,
            'verification_status' => 'pending',
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Seller profile created successfully.');
    }

    public function show()
    {
        $profile = SellerProfile::firstWhere('user_id', Auth::id());
        return view('seller.profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = SellerProfile::firstWhere('user_id', Auth::id());

        return view('seller.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = SellerProfile::firstWhere('user_id', Auth::id());

        $validated = $request->validate([
            'brand_name' => 'required|string|max:255',
            'business_category' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'social_platform' => 'required|string|max:255',
            'shop_link' => 'nullable|string|max:255',
        ]);

        $profile->update($validated);

        return redirect()->route('seller.profile.show')->with('success', 'Profile updated successfully!');
    }
}
