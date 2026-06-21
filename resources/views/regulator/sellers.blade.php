<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Seller Verification Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-3">Brand Name</th>
                        <th class="border p-3">Category</th>
                        <th class="border p-3">Location</th>
                        <th class="border p-3">Status</th>
                        <th class="border p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td class="border p-3">{{ $seller->brand_name }}</td>
                            <td class="border p-3">{{ $seller->business_category }}</td>
                            <td class="border p-3">{{ $seller->location }}</td>
                            <td class="border p-3">
                                {{ ucfirst($seller->verification_status) }}
                            </td>

                            <td class="border p-3 flex gap-2">

                                <form action="{{ route('regulator.sellers.verify', $seller->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button class="bg-green-600 text-white px-3 py-1 rounded">
                                        Verify
                                    </button>
                                </form>

                                <form action="{{ route('regulator.sellers.reject', $seller->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                                        Reject
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
