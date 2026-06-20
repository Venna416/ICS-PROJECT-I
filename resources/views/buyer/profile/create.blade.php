@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-pink-500 via-purple-600 to-blue-900">
    <div class="bg-white/90 p-8 rounded-xl shadow-2xl w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Buyer Profile Setup</h2>

        <form action="{{ route('buyer.profile.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Email</label>
                <input type="email" name="email" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Phone Number</label>
                <input type="text" name="phone_number" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500">
            </div>
            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Full Name</label>
                <input type="text" name="full_name" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500">
            </div>
            <div class="mb-4">
                <label class="block text-blue-900 mb-2 font-semibold">Location</label>
                <input type="text" name="location" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
