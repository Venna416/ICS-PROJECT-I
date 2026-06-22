<x-app-layout>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Edit Review
            </h2>

            <form action="{{ route('reviews.update', $review->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label>Rating (1-5)</label>

                    <input type="number" name="rating" min="1" max="5"
                        value="{{ old('rating', $review->rating) }}" class="w-full border rounded p-2" required>

                </div>

                <div class="mb-4">

                    <label>Comment</label>

                    <textarea name="comment" rows="4" class="w-full border rounded p-2">{{ old('comment', $review->comment) }}</textarea>

                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">

                    Update Review

                </button>

            </form>

        </div>
    </div>

</x-app-layout>
