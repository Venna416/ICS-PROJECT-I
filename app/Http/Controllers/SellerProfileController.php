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
        'profile_photo' => 'nullable|image|max:2048',
        'id_front' => 'nullable|image|max:2048',
        'id_back' => 'nullable|image|max:2048',
        'brand_name' => 'nullable|string|max:255',
        'category' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'social_platform' => 'nullable|string|max:255',
        'shop_link' => 'nullable|url',
        'description' => 'nullable|string',
    ]);

    $profile = SellerProfile::create([
        'user_id' => Auth::id(),
        'brand_name' => $request->brand_name,
        'business_category' => $request->category, // ✅ matches migration
        'location' => $request->location,
        'phone_number' => $request->phone,         // ✅ matches migration
        'social_platform' => $request->social_platform,
        'shop_link' => $request->shop_link,
        'description' => $request->description,
        'profile_photo' => $request->file('profile_photo')?->store('profiles', 'public'),
        'id_front' => $request->file('id_front')?->store('ids', 'public'),
        'id_back' => $request->file('id_back')?->store('ids', 'public'),

        // 🔹 Default verification fields
        'verification_status' => 'pending',
        'verified' => false,
        'risk_score' => null,
        'trust_score' => null,
    ]);

    return redirect()->route('seller.profile.show', $profile->id)
                     ->with('success', 'Profile submitted for verification. Awaiting admin review.');
}



public function show($id)
{
    $profile = SellerProfile::findOrFail($id);
    return view('seller.profile.show', compact('profile'));
}


public function edit($id)
{
    $profile = SellerProfile::findOrFail($id);
    return view('seller.profile.edit', compact('profile'));
}
public function update(Request $request, $id)
{
    $profile = SellerProfile::findOrFail($id);

    // validate but keep everything optional
    $request->validate([
        'brand_name' => 'nullable|string|max:255',
        'business_category' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:20',
        'social_platform' => 'nullable|string|max:255',
        'shop_link' => 'nullable|url',
        'description' => 'nullable|string',
        'profile_photo' => 'nullable|image|max:2048',
        'id_front' => 'nullable|image|max:2048',
        'id_back' => 'nullable|image|max:2048',
    ]);

    // update fields
    $profile->brand_name = $request->brand_name;
    $profile->business_category = $request->business_category;
    $profile->location = $request->location;
    $profile->phone_number = $request->phone_number;
    $profile->social_platform = $request->social_platform;
    $profile->shop_link = $request->shop_link;
    $profile->description = $request->description;

    // handle file uploads if provided
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

    return redirect()->route('seller.profile.show', $profile->id)
                     ->with('success', 'Profile updated successfully!');
}

public function destroy($id)
{
    $profile = SellerProfile::findOrFail($id);
    $profile->delete();

    return redirect()->route('seller.dashboard')->with('success', 'Profile deleted successfully.');
}
}