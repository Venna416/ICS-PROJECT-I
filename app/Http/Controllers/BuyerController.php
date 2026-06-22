<?php

namespace App\Http\Controllers;

use App\Models\SellerProfile;

class BuyerController extends Controller
{
    public function showSeller($id)
    {
        $seller = SellerProfile::with('reviews.buyer')->findOrFail($id);

        return view('buyer.seller-details', compact('seller'));
    }
}