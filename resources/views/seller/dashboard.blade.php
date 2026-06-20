@extends('layouts.app')

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm uppercase">
                    Verification Status
                </h3>
                <p class="text-2xl font-bold mt-2">
                    @if($sellerProfile->verification_status == 'verified')
                        <span class="text-green-600">✅ Verified</span>
                    @elseif($sellerProfile->verification_status == 'rejected')
                        <span class="text-red-600">❌ Rejected</span>
                    @else
                        <span class="text-yellow-600">⏳ Pending</span>
                    @endif
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm uppercase">
                    Trust Score
                </h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $trustScore ?? 75 }}%
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm uppercase">
                    Risk Level
                </h3>
                <p class="text-2xl font-bold mt-2">
                    <span class="text-green-600">
                        {{ $riskLevel ?? 'Low' }}
                    </span>
                </p>
            </div>

        </div>

        <!-- Analytics -->
        <div class="mt-8">
            <h3 class="text-lg font-bold mb-4">
                📊 Analytics
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Reviews</p>
                    <h4 class="text-3xl font-bold">
                        {{ $reviewCount ?? 0 }}
                    </h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Fraud Reports</p>
                    <h4 class="text-3xl font-bold">
                        {{ $fraudCount ?? 0 }}
                    </h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Buyer Searches</p>
                    <h4 class="text-3xl font-bold">
                        {{ $searchCount ?? 0 }}
                    </h4>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">
                🔔 Notifications
            </h3>
            <ul class="space-y-2">
                <li>Your verification request is under review.</li>
                <li>No new fraud reports.</li>
                <li>No new buyer reviews.</li>
            </ul>
        </div>

    </div>
</div>

@endsection
