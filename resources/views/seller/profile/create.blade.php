@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Complete Your Seller Profile</h2>

    <form action="{{ route('seller.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Profile Photo -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Profile Photo</label>
            <input type="file" name="profile_photo" accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:ring focus:ring-blue-300">
        </div>

        <!-- Business Details -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Brand Name</label>
            <input type="text" name="brand_name"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Business Category</label>
            <input type="text" name="category"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Contact Info -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Social Platform</label>
            <input type="text" name="social_platform"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Shop Link</label>
            <input type="url" name="shop_link"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- ID Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700">National ID (Front)</label>
            <input type="file" name="id_front" accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">National ID (Back)</label>
            <input type="file" name="id_back" accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:ring focus:ring-blue-300">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Business Description</label>
            <textarea name="description" rows="4"
                      class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:ring focus:ring-blue-300">
                Save Profile
            </button>
        </div>
    </form>
</div>
@endsection
