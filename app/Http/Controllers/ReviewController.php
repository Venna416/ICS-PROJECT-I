<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:seller_profiles,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Prevent duplicate reviews
        $existingReview = Review::where('buyer_id', '=', Auth::id(), 'and')->where('seller_id', '=', $request->seller_id, 'and')->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this seller.');
        }

        Review::create([
            'buyer_id' => Auth::id(),
            'seller_id' => $request->seller_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'active',
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }
}
