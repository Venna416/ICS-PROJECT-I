@extends('layouts.app')

@section('content')

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Card -->
        <div class="bg-white p-6 rounded-lg shadow space-y-4">

            <p><strong>Brand Name:</strong> {{ $profile->brand_name ?? 'N/A' }}</p>
            <p><strong>Business Category:</strong> {{ $profile->business_category ?? 'N/A' }}</p>
            <p><strong>Location:</strong> {{ $profile->location ?? 'N/A' }}</p>
            <p><strong>Phone Number:</strong> {{ $profile->phone_number ?? 'N/A' }}</p>
            <p><strong>Social Platform:</strong> {{ $profile->social_platform ?? 'N/A' }}</p>

            <p><strong>Shop Link:</strong>
                @if($profile->shop_link)
                    <a href="{{ $profile->shop_link }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ $profile->shop_link }}
                    </a>
                @else
                    N/A
                @endif
            </p>

            <p><strong>Description:</strong> {{ $profile->description ?? 'No description provided.' }}</p>

            <!-- Verification Badge -->
            <p>
                <strong>Verification Status:</strong>
                <span class="px-2 py-1 rounded
                    {{ $profile->verification_status === 'verified'
                        ? 'bg-green-200 text-green-800'
                        : ($profile->verification_status === 'rejected'
                            ? 'bg-red-200 text-red-800'
                            : 'bg-yellow-200 text-yellow-800') }}">
                    {{ ucfirst($profile->verification_status ?? 'Pending') }}
                </span>
            </p>

            <!-- Profile Photo -->
            @if($profile->profile_photo)
                <div>
                    <strong>Profile Photo:</strong><br>
                    <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                         class="w-32 h-32 rounded-full mt-2">
                </div>
            @endif

        </div>

        <!-- ACTION BUTTONS -->
        <div class="mt-6 flex gap-4">

            <a href="{{ route('seller.profile.edit', $profile->id) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ✏️ Edit Profile
            </a>

            <form action="{{ route('seller.profile.destroy', $profile->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete your profile?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    🗑️ Delete Profile
                </button>

            </form>

        
</div>

@endsection