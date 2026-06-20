
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seller_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:2000',
        ]);

        DB::table('reviews')->insert([
            'user_id' => Auth::id(),
            'seller_name' => $validated['seller_name'],
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('buyer.reviews')->with('success', 'Review submitted successfully!');
    }
}

