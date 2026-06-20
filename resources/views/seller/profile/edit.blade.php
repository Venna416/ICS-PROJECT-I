@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-10">

        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">
            ✏️ Edit Your Seller Profile
        </h2>

        <form action="{{ route('seller.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold">Brand Name</label>
                <input type="text" name="brand_name" value="{{ old('brand_name', $profile->brand_name) }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold">Business Category</label>
                <input type="text" name="business_category"
                    value="{{ old('business_category', $profile->business_category) }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold">Location</label>
                <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold">Social Platform</label>
                <input type="text" name="social_platform" value="{{ old('social_platform', $profile->social_platform) }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold">Shop Link</label>
                <input type="url" name="shop_link" value="{{ old('shop_link', $profile->shop_link) }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold">Description</label>

                <textarea name="description" rows="4" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('description', $profile->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-semibold">Profile Photo</label>

                    <input type="file" name="profile_photo" class="mt-2 block w-full border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-semibold">National ID (Front)</label>

                    <input type="file" name="id_front" class="mt-2 block w-full border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-semibold">National ID (Back)</label>

                    <input type="file" name="id_back" class="mt-2 block w-full border rounded-lg">
                </div>

            </div>

            <div class="flex justify-end">

                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    💾 Save Changes
                </button>

            </div>

        </form>

    </div>
@endsection
