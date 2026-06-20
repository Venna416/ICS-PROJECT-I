@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Seller Dashboard</h2>

    @if($sellerProfile)
        <p><strong>Brand Name:</strong> {{ $sellerProfile->brand_name ?? 'Not Set' }}</p>
        <p><strong>Business Category:</strong> {{ $sellerProfile->category ?? 'N/A' }}</p>
        <p><strong>Location:</strong> {{ $sellerProfile->location ?? 'N/A' }}</p>
        <p><strong>Phone Number:</strong> {{ $sellerProfile->phone ?? 'N/A' }}</p>
        <p><strong>Social Platform:</strong> {{ $sellerProfile->social_platform ?? 'N/A' }}</p>
        <p><strong>Shop Link:</strong> {{ $sellerProfile->shop_link ?? 'N/A' }}</p>
        <p><strong>Description:</strong> {{ $sellerProfile->description ?? 'No description provided' }}</p>

    @else
        <p class="text-red-600">You have not completed your profile yet.</p>
        <a href="{{ route('seller.profile.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
           Complete Profile
        </a>
    @endif
</div>
@endsection
