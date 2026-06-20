@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-pink-500 via-purple-600 to-blue-900">
    <div class="bg-white/90 p-8 rounded-xl shadow-2xl w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Buyer Profile</h2>

        <div class="space-y-4">
            <p><strong>Full Name:</strong> {{ $profile->full_name }}</p>
            <p><strong>Email:</strong> {{ $profile->email }}</p>
            <p><strong>Phone Number:</strong> {{ $profile->phone_number }}</p>
            <p><strong>Location:</strong> {{ $profile->location }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex gap-4 justify-center">
            <a href="{{ route('buyer.profile.edit', $profile->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                ✏️ Edit Profile
            </a>

            <form action="{{ route('buyer.profile.destroy', $profile->id) }}" method="POST"
      onsubmit="return confirm('Are you sure you want to delete your profile?');">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200">
        🗑️ Delete Profile
    </button>
</form>

        </div>

        <!-- Dashboard Access -->
        <div class="mt-8 text-center">
            <a href="{{ route('buyer.dashboard') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg">
                🏠 Go to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
