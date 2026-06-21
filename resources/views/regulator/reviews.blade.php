<x-app-layout>

    <div class="max-w-7xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Review Moderation
        </h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Buyer</th>
                    <th class="p-3">Rating</th>
                    <th class="p-3">Comment</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($reviews as $review)
                    <tr class="border">

                        <td class="p-3">
                            {{ $review->buyer->name ?? 'Unknown' }}
                        </td>

                        <td class="p-3">
                            ⭐ {{ $review->rating }}
                        </td>

                        <td class="p-3">
                            {{ $review->comment }}
                        </td>

                        <td class="p-3">
                            {{ ucfirst($review->status) }}
                        </td>

                        <td class="p-3">

                            @if ($review->status == 'active')
                                <form class="inline" action="{{ route('regulator.reviews.hide', $review->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button class="bg-yellow-500 text-white px-3 py-1 rounded">
                                        Hide
                                    </button>
                                </form>
                            @else
                                <form class="inline" action="{{ route('regulator.reviews.restore', $review->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button class="bg-green-500 text-white px-3 py-1 rounded">
                                        Restore
                                    </button>
                                </form>
                            @endif

                            <form class="inline" action="{{ route('regulator.reviews.delete', $review->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</x-app-layout>
