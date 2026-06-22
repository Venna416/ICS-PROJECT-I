<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Regulator Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-blue-500 text-white p-6 rounded shadow">
                <h3 class="text-lg font-bold">Total Sellers</h3>
                <p class="text-3xl">{{ $totalSellers }}</p>
            </div>

            <div class="bg-green-500 text-white p-6 rounded shadow">
                <h3 class="text-lg font-bold">Verified Sellers</h3>
                <p class="text-3xl">{{ $verifiedSellers }}</p>
            </div>

            <div class="bg-yellow-500 text-white p-6 rounded shadow">
                <h3 class="text-lg font-bold">Pending Sellers</h3>
                <p class="text-3xl">{{ $pendingSellers }}</p>
            </div>

            <div class="bg-red-500 text-white p-6 rounded shadow">
                <h3 class="text-lg font-bold">Rejected Sellers</h3>
                <p class="text-3xl">{{ $rejectedSellers }}</p>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('regulator.sellers') }}" class="bg-blue-600 text-white px-6 py-3 rounded shadow">
                    Manage Sellers
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
