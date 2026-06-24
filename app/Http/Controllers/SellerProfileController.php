<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;
use App\Models\SellerDocument;
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

            'documents.*' => 'nullable|file|max:5000',

            'brand_name' => 'nullable|string|max:255',

            'category' => 'nullable|string|max:255',

            'location' => 'nullable|string|max:255',

            'phone' => 'nullable|string|max:20',

            'social_platform' => 'nullable|string|max:255',

            'shop_link' => 'nullable|url',

            'description' => 'nullable|string',
        ]);

        // CREATE SELLER PROFILE

        $profile = SellerProfile::create([
            'user_id' => Auth::id(),

            'brand_name' => $request->brand_name,

            'business_category' => $request->category,

            'location' => $request->location,

            'phone_number' => $request->phone,

            'social_platform' => $request->social_platform,

            'shop_link' => $request->shop_link,

            'description' => $request->description,

            'profile_photo' => $request->file('profile_photo') ? $request->file('profile_photo')->store('profiles', 'public') : null,

            'id_front' => $request->file('id_front') ? $request->file('id_front')->store('ids', 'public') : null,

            'id_back' => $request->file('id_back') ? $request->file('id_back')->store('ids', 'public') : null,

            'verification_status' => 'pending',

            'verified' => false,

            'risk_score' => null,

            'trust_score' => null,
        ]);

        // SAVE EXTRA DOCUMENTS

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                SellerDocument::create([
                    'seller_profile_id' => $profile->id,

                    'document_type' => 'extra_evidence',

                    'file_path' => $file->store('seller_documents', 'public'),
                ]);
            }
        }

        return redirect()
            ->route('seller.profile.show', $profile->id)

            ->with('success', 'Profile submitted for verification. Awaiting admin review.');
    }

    public function show($id)
    {
        $profile = SellerProfile::with('documents')->findOrFail($id);

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

            'documents.*' => 'nullable|file|max:5000',
        ]);

        // UPDATE TEXT DETAILS

        $profile->brand_name = $request->brand_name;

        $profile->business_category = $request->business_category;

        $profile->location = $request->location;

        $profile->phone_number = $request->phone_number;

        $profile->social_platform = $request->social_platform;

        $profile->shop_link = $request->shop_link;

        $profile->description = $request->description;

        // UPDATE IMAGES

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

        // ADD NEW EVIDENCE DOCUMENTS

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                SellerDocument::create([
                    'seller_profile_id' => $profile->id,

                    'document_type' => 'extra_evidence',

                    'file_path' => $file->store('seller_documents', 'public'),
                ]);
            }
        }

        return redirect()
            ->route('seller.profile.show', $profile->id)

            ->with('success', 'Profile updated successfully!');
    }

    public function index(Request $request)
    {
        $search = $request->input('query');

        $sellerQuery = SellerProfile::query();

        if (!empty($search)) {
            $sellerQuery->where(function ($builder) use ($search) {
                $builder->where('brand_name', 'like', "%{$search}%")
                    ->orWhere('business_category', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $sellers = $sellerQuery
            ->where('verified', true)
            ->get();

        return view('seller.profile.search', compact('sellers', 'search'));
    }
}
