<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyerProfile;

class BuyerProfileController extends Controller
{
    // Show create form
    public function create()
    {
        return view('buyer.profile.create');
    }

    // Store new profile
    public function store(Request $request)
    {
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'location'     => 'required|string|max:255',
        ]);

        $profile = Auth::user()->buyerProfile()->create([
            'full_name'    => $request->full_name,
            'phone_number' => $request->phone_number,
            'location'     => $request->location,
            'email'        => Auth::user()->email, // always save email
        ]);

        return redirect()->route('buyer.profile.show', $profile->id)
            ->with('success', 'Profile created successfully.');
    }

    // Show profile
    public function show($id)
    {
        $profile = BuyerProfile::findOrFail($id);
        return view('buyer.profile.show', compact('profile'));
    }

    // Show edit form
    public function edit($id)
    {
        $profile = BuyerProfile::findOrFail($id);
        return view('buyer.profile.edit', compact('profile'));
    }

    // Update profile
    public function update(Request $request, $id)
{
    $request->validate([
        'full_name'    => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'location'     => 'required|string|max:255',
    ]);

    // Always fetch the profile by ID and ensure it belongs to the logged-in user
    $profile = BuyerProfile::where('id', '=', $id, 'and')
        ->where('user_id', '=', Auth::id(), 'and')
        ->firstOrFail();

    $profile->full_name = $request->full_name;
    $profile->phone_number = $request->phone_number;
    $profile->location = $request->location;
    $profile->email = Auth::user()->email; // keep synced
    $profile->save();

    return redirect()->route('buyer.profile.show', $profile->id)
        ->with('success', 'Profile updated successfully.');
}


    // Delete profile
    public function destroy($id)
{
    $profile = BuyerProfile::findOrFail($id);
    $profile->delete();

    return redirect('/')
        ->with('success', 'Profile deleted successfully.');
}
    public function dashboard()
{
    $profile = Auth::user()->buyerProfile;

    if (!$profile) {
        // If no profile exists, force setup
        return redirect()->route('buyer.profile.create');
    }

    // If profile exists, show dashboard
    return view('buyer.dashboard', compact('profile'));
}

}
