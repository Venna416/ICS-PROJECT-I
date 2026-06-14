<?php

namespace App\Http\Controllers;
use App\Models\VerificationRequest;
use App\Models\SellerProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VerificationRequestController extends Controller
{
    public function create()
    {
        return view('seller.verification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required',
            'document' => 'required|file',
        ]);

        $sellerProfile = SellerProfile::where(
            'user_id',
            '=',
            Auth::id(),
            'and'
        )->first();

        if (!$sellerProfile) {
            return redirect()
                ->route('seller.profile.create')
                ->with('error', 'Seller profile not found.');
        }

        $filePath = $request->file('document')
            ->store('verification_documents', 'public');

        VerificationRequest::create([
            'seller_profile_id' => $sellerProfile->id,
            'document_type' => $request->document_type,
            'document_path' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('seller.dashboard')
            ->with(
                'success',
                'Verification request submitted successfully.'
            );
    }
}
