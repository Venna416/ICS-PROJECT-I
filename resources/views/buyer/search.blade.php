<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            Search Sellers
        </h1>

        <form method="GET" action="{{ route('buyer.search') }}">

            <input type="text" name="search" placeholder="Search by Brand Name, Location or Category"
                class="border p-2 w-full mb-4" value="{{ request('search') }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Search
            </button>

        </form>

        @if (isset($sellers))

            <table class="table-auto w-full mt-6 border">

                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Brand Name</th>
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Location</th>
                        <th class="border p-2">Verification Status</th>
                        <th class="border p-2">Trust Score</th>
                        <th class="border p-2">Risk Level</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($sellers as $seller)
                        <tr>
                            <td class="border p-2">{{ $seller->brand_name }}</td>
                            <td class="border p-2">{{ $seller->business_category }}</td>
                            <td class="border p-2">{{ $seller->location }}</td>
                            <td class="border p-2">{{ $seller->verification_status }}</td>
                            <td class="border p-2">{{ $seller->trust_score }}</td>
                            <td class="border p-2">{{ $seller->risk_level }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        @endif

    </div>

</x-app-layout>
