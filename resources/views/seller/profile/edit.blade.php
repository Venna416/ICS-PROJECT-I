@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-10">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">✏️ Edit Your Seller Profile</h2>

    <form action="{{ route('seller.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Brand Name -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Brand Name</label>
            <input type="text" name="brand_name" value="{{ old('brand_name', $profile->brand_name) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Business Category -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Business Category</label>
            <input type="text" name="business_category" value="{{ old('business_category', $profile->business_category) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Location -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Location</label>
            <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Social Platform -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Social Platform</label>
            <input type="text" name="social_platform" value="{{ old('social_platform', $profile->social_platform) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Shop Link -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Shop Link</label>
            <input type="url" name="shop_link" value="{{ old('shop_link', $profile->shop_link) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Description</label>
            <textarea name="description" rows="4"
                      class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $profile->description) }}</textarea>
        </div>

        <!-- File Uploads -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Profile Photo</label>
                <input type="file" name="profile_photo" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">National ID (Front)</label>
                <input type="file" name="id_front" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">National ID (Back)</label>
                <input type="file" name="id_back" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer">
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition ease-in-out duration-200">
                💾 Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
