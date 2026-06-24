<?php

namespace App\Http\Controllers;

use App\Models\SellerProfile;
use App\Models\Review;

class BuyerController extends Controller
{
    public function showSeller($id)
    {
        $seller = SellerProfile::findOrFail($id);

        $reviews = Review::where('seller_id', '=', $seller->id, 'and')
            ->where('status', 'active')

            ->latest()

            ->get();

        return view(
            'buyer.seller-details',

            compact(
                'seller',

                'reviews',
            ),
        );
    }
}
