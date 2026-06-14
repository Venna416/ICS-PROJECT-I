<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SellerProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VerificationRequest extends Model
{
    protected $fillable = [
        'seller_profile_id',
        'document_type',
        'document_path',
        'status',
    ];

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

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }
}