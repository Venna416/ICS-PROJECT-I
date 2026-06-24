@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-100 py-10 px-6">

        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <h1 class="text-4xl font-bold text-gray-800">
                📊 Regulator Dashboard
            </h1>
            <p class="text-gray-600 mt-2">
                Monitor sellers, reviews, fraud reports, and system activity.
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Total Sellers -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">👥 Total Sellers</h2>
                <p class="text-4xl font-bold text-blue-600 mt-3">
                    {{ $totalSellers }}
                </p>
            </div>

            <!-- Verified Sellers -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">✅ Verified Sellers</h2>
                <p class="text-4xl font-bold text-green-600 mt-3">
                    {{ $verifiedSellers }}
                </p>
            </div>

            <!-- Pending Sellers -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">⏳ Pending Sellers</h2>
                <p class="text-4xl font-bold text-yellow-500 mt-3">
                    {{ $pendingSellers }}
                </p>
            </div>

            <!-- Rejected Sellers -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">❌ Rejected Sellers</h2>
                <p class="text-4xl font-bold text-red-600 mt-3">
                    {{ $rejectedSellers }}
                </p>
            </div>

            <!-- Total Reviews -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">⭐ Total Reviews</h2>
                <p class="text-4xl font-bold text-purple-600 mt-3">
                    {{ $totalReviews }}
                </p>
            </div>

            <!-- Pending Reviews -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">📝 Pending Reviews</h2>
                <p class="text-4xl font-bold text-indigo-600 mt-3">
                    {{ $pendingReviews }}
                </p>
            </div>

            <!-- Fraud Reports -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h2 class="text-gray-600 font-medium">🚨 Fraud Reports</h2>
                <p class="text-4xl font-bold text-orange-600 mt-3">
                    {{ $totalFraudReports }}
                </p>
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="max-w-7xl mx-auto mt-10">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    Quick Actions
                </h2>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('regulator.sellers') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-medium transition">
                        Manage Sellers
                    </a>

                    @if (Route::has('regulator.reviews'))
                        <a href="{{ route('regulator.reviews') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg font-medium transition">
                            Moderate Reviews
                        </a>
                    @endif

                    @if (Route::has('regulator.reports'))
                        <a href="{{ route('regulator.reports') }}"
                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-medium transition">
                            View Fraud Reports
                        </a>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
