@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-emerald-50">

    <!-- Fixed Header -->
    <header class="bg-emerald-500 text-white shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <h1 class="text-2xl font-bold">🚨 Report Fraud</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-6 pt-28">
        <!-- Centered Box -->
        <div class="bg-white rounded-xl shadow-lg p-10 w-full max-w-3xl">
            <h2 class="text-3xl font-bold text-center mb-6 text-red-600">Help Protect Buyers</h2>
            <p class="text-center mb-8 text-gray-600">
                Report fraudulent sellers by providing details and evidence.
            </p>

            <form action="{{ route('buyer.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Seller Name -->
                <div class="mb-6">
                    <label for="seller_name" class="block text-sm font-semibold text-gray-700">Seller Name</label>
                    <input type="text" id="seller_name" name="seller_name"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                           placeholder="Enter seller's name" required>
                </div>

                <!-- Shop Name -->
                <div class="mb-6">
                    <label for="shop_name" class="block text-sm font-semibold text-gray-700">Shop Name</label>
                    <input type="text" id="shop_name" name="shop_name"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                           placeholder="Enter shop name" required>
                </div>

                <!-- Shop Link -->
                <div class="mb-6">
                    <label for="shop_link" class="block text-sm font-semibold text-gray-700">Shop Link</label>
                    <input type="url" id="shop_link" name="shop_link"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                           placeholder="https://example.com/shop" required>
                </div>

                <!-- Fraud Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700">Fraud Description</label>
                    <textarea id="description" name="description" rows="5"
                              class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                              placeholder="Describe what happened..." required></textarea>
                </div>

                <!-- Evidence Upload -->
                <div class="mb-6">
                    <label for="evidence" class="block text-sm font-semibold text-gray-700">Upload Evidence</label>
                    <input type="file" id="evidence" name="evidence"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                           accept="image/*,.pdf,.doc,.docx">
                    <p class="text-sm text-gray-500 mt-2">Accepted formats: images, PDF, Word documents</p>
                </div>

                <!-- Buyer Contact -->
                <div class="mb-6">
                    <label for="contact" class="block text-sm font-semibold text-gray-700">Your Contact (Email/Phone)</label>
                    <input type="text" id="contact" name="contact"
                           class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                           placeholder="Enter your email or phone" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition">
                        Submit Fraud Report
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
