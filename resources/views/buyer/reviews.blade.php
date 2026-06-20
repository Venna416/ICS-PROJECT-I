@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-emerald-50">

    <!-- Fixed Header -->
    <header class="bg-emerald-500 text-white shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <h1 class="text-2xl font-bold">⭐ Write a Review</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-6 pt-28">
        <!-- Centered Box -->
        <div class="bg-white rounded-xl shadow-lg p-10 w-full max-w-3xl">
            <h2 class="text-3xl font-bold text-center mb-6 text-emerald-700">Share Your Experience</h2>
            <p class="text-center mb-8 text-gray-600">
                Help other buyers make informed decisions by writing a review.
            </p>

            <form action="{{ route('buyer.reviews.store') }}" method="POST">
                @csrf

                <!-- Seller Name -->
                <div class="mb-6">
                    <label for="seller_name" class="block text-sm font-semibold text-gray-700">Seller Name</label>
                    <input type="text" id="seller_name" name="seller_name"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                           placeholder="Enter seller's name" required>
                </div>

                <!-- Shop Name -->
                <div class="mb-6">
                    <label for="shop_name" class="block text-sm font-semibold text-gray-700">Shop Name</label>
                    <input type="text" id="shop_name" name="shop_name"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                           placeholder="Enter shop name" required>
                </div>

                <!-- Shop Link -->
                <div class="mb-6">
                    <label for="shop_link" class="block text-sm font-semibold text-gray-700">Shop Link</label>
                    <input type="url" id="shop_link" name="shop_link"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                           placeholder="https://example.com/shop" required>
                </div>

                <!-- Rating -->
                <div class="mb-6">
                    <label for="rating" class="block text-sm font-semibold text-gray-700">Rating (1–5)</label>
                    <select id="rating" name="rating"
                            class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400" required>
                        <option value="">Select rating</option>
                        <option value="1">1 - Very Poor</option>
                        <option value="2">2 - Poor</option>
                        <option value="3">3 - Average</option>
                        <option value="4">4 - Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>

                <!-- Review Text -->
                <div class="mb-6">
                    <label for="review" class="block text-sm font-semibold text-gray-700">Your Review</label>
                    <textarea id="review" name="review" rows="5"
                              class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                              placeholder="Write your review here..." required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                            class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Fixed Footer -->
    <footer class="bg-emerald-500 text-white text-center py-4 fixed bottom-0 left-0 right-0">
        © 2026 Online Seller Verification
    </footer>
</div>
@endsection
