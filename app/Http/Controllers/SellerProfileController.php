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
            'brand_name' => 'required|string|max:255',
            'business_category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'social_platform' => 'required|string|max:255',
            'shop_link' => 'nullable|url',
            'description' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
            'id_front' => 'nullable|image|max:2048',
            'id_back' => 'nullable|image|max:2048',
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
            'profile_photo' => $request->file('profile_photo')?->store('profiles', 'public'),
            'id_front' => $request->file('id_front')?->store('ids', 'public'),
            'id_back' => $request->file('id_back')?->store('ids', 'public'),
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
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'social_platform' => 'required|string|max:255',
            'shop_link' => 'nullable|url',
            'description' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
            'id_front' => 'nullable|image|max:2048',
            'id_back' => 'nullable|image|max:2048',
        ]);

        $profile->update($validated);

        if ($request->hasFile('profile_photo')) {
            $profile->profile_photo = $request->file('profile_photo')->store('profiles', 'public');
        }

        if ($request->hasFile('id_front')) {
            $profile->id_front = $request->file('id_front')->store('ids', 'public');
        }

        if ($request->hasFile('id_back')) {
            $profile->id_back = $request->file('id_back')->store('ids', 'public');
        }

        $profile->save();

        return redirect()->route('seller.profile.show')->with('success', 'Profile updated successfully!');
    }
}
