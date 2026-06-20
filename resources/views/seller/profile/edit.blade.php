<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Seller Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">

            <form method="POST" action="{{ route('seller.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Brand Name</label>
                    <input type="text"
                           name="brand_name"
                           value="{{ old('brand_name', $profile->brand_name) }}"
                           class="w-full rounded">
                </div>

                <div class="mb-4">
                    <label>Business Category</label>
                    <input type="text"
                           name="business_category"
                           value="{{ old('business_category', $profile->business_category) }}"
                           class="w-full rounded">
                </div>

                <div class="mb-4">
                    <label>Location</label>
                    <input type="text"
                           name="location"
                           value="{{ old('location', $profile->location) }}"
                           class="w-full rounded">
                </div>

                <div class="mb-4">
                    <label>Phone Number</label>
                    <input type="text"
                           name="phone_number"
                           value="{{ old('phone_number', $profile->phone_number) }}"
                           class="w-full rounded">
                </div>

                <div class="mb-4">
                    <label>Social Platform</label>
                    <input type="text"
                           name="social_platform"
                           value="{{ old('social_platform', $profile->social_platform) }}"
                           class="w-full rounded">
                </div>

                <div class="mb-4">
                    <label>Shop Link</label>
                    <input type="text"
                           name="shop_link"
                           value="{{ old('shop_link', $profile->shop_link) }}"
                           class="w-full rounded">
                </div>

                <div class="mb-4">
                    <label>Description</label>
                    <textarea name="description"
                              class="w-full rounded">{{ old('description', $profile->description) }}</textarea>
                </div>

                <button class="bg-green-500 text-white px-4 py-2 rounded">
                    Update Profile
                </button>

            </form>

        </div>
    </div>
</x-app-layout>