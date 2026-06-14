<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Seller Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Brand Name -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-gray-700 mb-2">Brand Name</h3>
                    <p class="text-lg">
                        {{ $profile->brand_name ?? 'Not Set' }}
                    </p>
                </div>

                <!-- Verification Status -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-gray-700 mb-2">Verification Status</h3>
                    <p class="text-lg capitalize">
                        {{ $profile->verification_status ?? 'Pending' }}
                    </p>
                </div>

                <!-- Trust Score -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-gray-700 mb-2">Trust Score</h3>
                    <p class="text-lg">
                        {{ $profile->trust_score ?? 0 }}
                    </p>
                </div>

                <!-- Risk Level -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-gray-700 mb-2">Risk Level</h3>
                    <p class="text-lg capitalize">
                        {{ $profile->risk_level ?? 'Medium' }}
                    </p>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">

                <h3 class="text-lg font-bold mb-4">
                    Quick Actions
                </h3>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('seller.profile.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update Profile
                    </a>

                    <a href="{{ route('buyer.search') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Search Sellers
                    </a>

                </div>

            </div>

            <!-- Seller Information -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">

                <h3 class="text-lg font-bold mb-4">
                    Seller Information
                </h3>

                <div class="space-y-2">

                    <p>
                        <strong>Business Category:</strong>
                        {{ $profile->business_category ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Location:</strong>
                        {{ $profile->location ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Phone Number:</strong>
                        {{ $profile->phone_number ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Social Platform:</strong>
                        {{ $profile->social_platform ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Shop Link:</strong>
                        {{ $profile->shop_link ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Description:</strong>
                        {{ $profile->description ?? 'No description provided.' }}
                    </p>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
