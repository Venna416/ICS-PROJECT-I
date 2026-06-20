@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-pink-400 via-purple-500 to-blue-400">
    <div class="bg-white/90 p-8 rounded-xl shadow-2xl w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Edit Buyer Profile</h2>

        <form action="{{ route('buyer.profile.update', $profile->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Email</label>
                <input type="email" name="email" value="{{ $profile->email }}" 
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Phone Number</label>
                <input type="text" name="phone_number" value="{{ $profile->phone_number }}" 
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500">
            </div>

            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Full Name</label>
                <input type="text" name="full_name" value="{{ $profile->full_name }}" 
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500">
            </div>

            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Location</label>
                <input type="text" name="location" value="{{ $profile->location }}" 
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500">
            </div>

            <div class="flex justify-between">
                <!-- Update Button -->
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200">
                    ✏️ Update Profile
                </button>

                <!-- Delete Button -->
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
        </form>
    </div>
</div>
@endsection
