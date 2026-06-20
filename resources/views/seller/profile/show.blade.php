<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Seller Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">

            <p><strong>Brand Name:</strong> {{ $profile->brand_name }}</p>

            <p><strong>Business Category:</strong> {{ $profile->business_category }}</p>

            <p><strong>Location:</strong> {{ $profile->location }}</p>

            <p><strong>Phone Number:</strong> {{ $profile->phone_number }}</p>

            <p><strong>Social Platform:</strong> {{ $profile->social_platform }}</p>

            <p><strong>Shop Link:</strong> {{ $profile->shop_link }}</p>

            <p><strong>Description:</strong> {{ $profile->description }}</p>

            <p><strong>Verification Status:</strong>
                {{ $profile->verification_status }}
            </p>

            <br>

            <a href="{{ route('seller.profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Edit Profile
            </a>

        </div>
    </div>
</x-app-layout>
