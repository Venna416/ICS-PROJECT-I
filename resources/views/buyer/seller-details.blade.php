<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Seller Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <p><strong>Brand Name:</strong> {{ $seller->brand_name }}</p>

            <p>
                <strong>Business Category:</strong>
                {{ $seller->business_category }}
            </p>

            <p>
                <strong>Location:</strong>
                {{ $seller->location }}
            </p>

            <p>
                <strong>Description:</strong>
                {{ $seller->description }}
            </p>

            <p>
                <strong>Social Platform:</strong>
                {{ $seller->social_platform }}
            </p>

            <p>
                <strong>Shop Link:</strong>
                {{ $seller->shop_link }}
            </p>

            <p>
                <strong>Verification Status:</strong>
                {{ $seller->verification_status }}
            </p>

            <hr class="my-6">

            @php
                $averageRating = $seller->reviews->avg('rating') ?? 0;
            @endphp

            <p class="text-lg font-bold">
                Average Rating:

                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($averageRating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor

                ({{ number_format($averageRating, 1) }}/5)
            </p>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Leave a Review
            </h2>

            <form action="{{ route('reviews.store', $seller->id) }}" method="POST">

                @csrf

                <div class="mb-4">
                    <label>Rating (1-5)</label>

                    <input type="number" name="rating" min="1" max="5" class="w-full border rounded p-2"
                        required>
                </div>

                <div class="mb-4">
                    <label>Comment</label>

                    <textarea name="comment" rows="4" class="w-full border rounded p-2"></textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Submit Review
                </button>

            </form>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Reviews
            </h2>

            @if ($seller->reviews->count())

                @foreach ($seller->reviews as $review)
                    <div class="border rounded p-4 mb-4">

                        <p>
                            <strong>Buyer:</strong>
                            {{ $review->buyer->name }}
                        </p>

                        <p>
                            <strong>Rating:</strong>

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor

                            ({{ $review->rating }}/5)
                        </p>

                        <p>
                            <strong>Comment:</strong>
                            {{ $review->comment }}
                        </p>

                        @if ($review->buyer_id == auth()->id())
                            <div class="mt-3">

                                <a href="{{ route('reviews.edit', $review->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit Review

                                </a>

                            </div>
                        @endif

                    </div>
                @endforeach
            @else
                <p>No reviews yet.</p>

            @endif

        </div>
    </div>
</x-app-layout><x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Seller Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <p><strong>Brand Name:</strong> {{ $seller->brand_name }}</p>

            <p>
                <strong>Business Category:</strong>
                {{ $seller->business_category }}
            </p>

            <p>
                <strong>Location:</strong>
                {{ $seller->location }}
            </p>

            <p>
                <strong>Description:</strong>
                {{ $seller->description }}
            </p>

            <p>
                <strong>Social Platform:</strong>
                {{ $seller->social_platform }}
            </p>

            <p>
                <strong>Shop Link:</strong>
                {{ $seller->shop_link }}
            </p>

            <p>
                <strong>Verification Status:</strong>
                {{ $seller->verification_status }}
            </p>

            <hr class="my-6">

            @php
                $averageRating = $seller->reviews->avg('rating') ?? 0;
            @endphp

            <p class="text-lg font-bold">
                Average Rating:

                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($averageRating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor

                ({{ number_format($averageRating, 1) }}/5)
            </p>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Leave a Review
            </h2>

            <form action="{{ route('reviews.store', $seller->id) }}" method="POST">

                @csrf

                <div class="mb-4">
                    <label>Rating (1-5)</label>

                    <input type="number" name="rating" min="1" max="5" class="w-full border rounded p-2"
                        required>
                </div>

                <div class="mb-4">
                    <label>Comment</label>

                    <textarea name="comment" rows="4" class="w-full border rounded p-2"></textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Submit Review
                </button>

            </form>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Reviews
            </h2>

            @if ($seller->reviews->count())

                @foreach ($seller->reviews as $review)
                    <div class="border rounded p-4 mb-4">

                        <p>
                            <strong>Buyer:</strong>
                            {{ $review->buyer->name }}
                        </p>

                        <p>
                            <strong>Rating:</strong>

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor

                            ({{ $review->rating }}/5)
                        </p>

                        <p>
                            <strong>Comment:</strong>
                            {{ $review->comment }}
                        </p>

                        @if ($review->buyer_id == auth()->id())
                            <div class="mt-3">

                                <a href="{{ route('reviews.edit', $review->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit Review

                                </a>

                            </div>
                        @endif

                    </div>
                @endforeach
            @else
                <p>No reviews yet.</p>

            @endif

        </div>
    </div>
</x-app-layout>
