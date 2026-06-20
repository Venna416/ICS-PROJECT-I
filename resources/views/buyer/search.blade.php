@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-8 rounded-2xl shadow-2xl bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-600 text-white">
    <h2 class="text-4xl font-bold mb-8 text-center">🔎 Search Sellers</h2>

    <!-- Search Form -->
    <form action="{{ route('buyer.search') }}" method="GET" class="flex justify-center mb-10">
        <input type="text" name="search" placeholder="Enter seller name, category, or location..."
               class="w-2/3 px-6 py-3 rounded-l-lg border-none focus:ring-4 focus:ring-yellow-300 text-gray-900">
        <button type="submit"
                class="px-8 py-3 bg-yellow-400 text-gray-900 font-bold rounded-r-lg hover:bg-yellow-500 transition">
            Search
        </button>
    </form>

    <!-- Search Results -->
    @if($sellers->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($sellers as $seller)
                <div class="bg-gradient-to-r from-green-400 to-blue-500 p-6 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold mb-2">{{ $seller->brand_name }}</h3>
                    <p class="mb-1"><strong>Category:</strong> {{ $seller->category ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Location:</strong> {{ $seller->location ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $seller->phone ?? 'N/A' }}</p>

                    <!-- Verification Badge -->
                    <p class="mt-2">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $seller->verification_status === 'verified' ? 'bg-yellow-300 text-gray-900' : 'bg-red-500 text-white' }}">
                            {{ ucfirst($seller->verification_status) }}
                        </span>
                    </p>

                    <!-- Trust Score -->
                    <p class="mt-2"><strong>Trust Score:</strong> {{ $seller->trust_score ?? 'Not Available' }}</p>

                    <!-- Actions -->
                    <div class="flex space-x-3 mt-4">
                        <a href="{{ route('seller.profile.show', $seller->id) }}"
                           class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                           👁️ View Profile
                        </a>
                        <a href="{{ route('buyer.report.create', $seller->id) }}"
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                           🚨 Report Fraud
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-lg font-semibold">No sellers found. Try another search.</p>
    @endif
</div>
@endsection
