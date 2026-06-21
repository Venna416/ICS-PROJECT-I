@extends('layouts.app')

@section('content')
    <div
        class="max-w-6xl mx-auto mt-10 p-8 rounded-2xl shadow-2xl bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-600 text-white">

        <h2 class="text-4xl font-bold mb-8 text-center">
            🔎 Search Sellers
        </h2>

        <!-- Search Form -->
        <form action="{{ route('buyer.search') }}" method="GET" class="flex justify-center mb-10">

            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Enter seller name, category, or location..."
                class="w-2/3 px-6 py-3 rounded-l-lg border-none text-gray-900">

            <button type="submit" class="px-8 py-3 bg-yellow-400 text-gray-900 font-bold rounded-r-lg">
                Search
            </button>

        </form>

        <!-- Search Results -->
        @if ($sellers->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($sellers as $seller)
                    <div class="bg-gradient-to-r from-green-400 to-blue-500 p-6 rounded-xl shadow-lg">

                        <h3 class="text-2xl font-bold mb-2">
                            {{ $seller->brand_name }}
                        </h3>

                        <p>
                            <strong>Category:</strong>
                            {{ $seller->business_category }}
                        </p>

                        <p>
                            <strong>Location:</strong>
                            {{ $seller->location }}
                        </p>

                        <p>
                            <strong>Phone:</strong>
                            {{ $seller->phone_number }}
                        </p>

                        <!-- Verification Badge -->
                        <p class="mt-2">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $seller->verification_status === 'verified' ? 'bg-yellow-300 text-gray-900' : 'bg-red-500 text-white' }}">
                                {{ ucfirst($seller->verification_status) }}
                            </span>
                        </p>

                        <!-- Trust Score -->
                        <p class="mt-2">
                            <strong>Trust Score:</strong>
                            {{ $seller->trust_score ?? 'Not Available' }}
                        </p>

                        <!-- Risk Level -->
                        <p class="mt-2">
                            <strong>Risk Level:</strong>
                            {{ $seller->risk_level ?? 'Not Available' }}
                        </p>

                        <!-- Actions -->
                        <div class="flex gap-3 mt-4">

                            <a href="{{ route('buyer.seller.details', $seller->id) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                👁️ View Details
                            </a>

                            <a href="{{ route('buyer.reports.create', $seller->id) }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                🚨 Report Fraud
                            </a>

                        </div>

                    </div>
                @endforeach

            </div>
        @elseif(request()->filled('search'))
            <p class="text-center text-lg font-semibold">
                No sellers found.
            </p>
        @endif

    </div>
@endsection
