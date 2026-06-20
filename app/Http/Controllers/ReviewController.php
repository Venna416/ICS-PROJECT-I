<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $sellerId)
    {
        $existingReview = Review::where('buyer_id', '=', Auth::id(), 'and')
            ->where('seller_id', '=', $sellerId, 'and')
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this seller.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'buyer_id' => Auth::id(),
            'seller_id' => $sellerId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        if ($review->buyer_id !== Auth::id()) {
            abort(403);
        }

        return view('buyer.edit-review', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->buyer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()
            ->route('buyer.seller.details', ['id' => $review->seller_id])
            ->with('success', 'Review updated successfully.');
    }
}