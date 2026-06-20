@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-gradient-to-br from-pink-400 via-purple-500 to-blue-400">

    <!-- Fixed Header -->
    <header class="bg-gradient-to-r from-pink-400 via-purple-500 to-blue-400 text-white shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <h1 class="text-2xl font-bold">🛒 Buyer Dashboard</h1>
            <nav class="flex space-x-4">
                <a href="{{ route('buyer.dashboard') }}"
                   class="bg-pink-400 hover:bg-pink-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="bg-purple-400 hover:bg-purple-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                        Log Out
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 pt-28 px-6">
        <!-- Welcome Section -->
        <div class="rounded-xl shadow-lg p-8 mb-8 text-center bg-white/20 text-white">
            <h2 class="text-3xl font-bold">
                Welcome, {{ Auth::user()->name ?? 'Buyer' }}
            </h2>
            <p class="mt-3 text-lg">
                This is your personalized dashboard where you can explore trusted sellers, share your experiences, 
                and help keep our marketplace safe. Use the options below to get started.
            </p>
        </div>

        <!-- Responsive Grid for Cards -->
        <div class="dashboard-container grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Search Sellers -->
            <a href="{{ route('buyer.search') }}" 
               class="dashboard-card bg-pink-400 hover:bg-pink-500 text-white rounded-xl shadow-lg p-6 transition duration-200">
                <h3 class="text-xl font-bold mb-2">🔎 Search Sellers</h3>
                <p>Find verified sellers and view trust scores.</p>
            </a>

            <!-- Reviews -->
            <a href="{{ route('buyer.reviews') }}" 
               class="dashboard-card bg-purple-400 hover:bg-purple-500 text-white rounded-xl shadow-lg p-6 transition duration-200">
                <h3 class="text-xl font-bold mb-2">⭐ Write Reviews</h3>
                <p>Share your experiences and help other buyers stay informed.</p>
            </a>

            <!-- Fraud Reports -->
            <a href="{{ route('buyer.reports') }}" 
               class="dashboard-card bg-blue-400 hover:bg-blue-500 text-white rounded-xl shadow-lg p-6 transition duration-200">
                <h3 class="text-xl font-bold mb-2">🚨 Fraud Reports</h3>
                <p>Report scams by entering seller details, your email/phone, and uploading evidence.</p>
            </a>
        </div>
    </main>

    <!-- Fixed Footer -->
    <footer class="bg-gradient-to-r from-pink-400 via-purple-500 to-blue-400 text-white text-center py-4 fixed bottom-0 left-0 right-0 shadow-inner">
        © 2026 Online Seller Verification
    </footer>
</div>
@endsection
