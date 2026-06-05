<x-app-layout>

    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">
            Create Seller Profile
        </h2>

        <form method="POST" action="{{ route('seller.profile.store') }}">
            @csrf

            <div class="mb-3">
                <label>Brand Name</label>
                <input type="text" name="brand_name" class="border p-2 w-full" required>
            </div>

            <div class="mb-3">
                <label>Business Category</label>
                <input type="text" name="business_category" class="border p-2 w-full" required>
            </div>

            <div class="mb-3">
                <label>Location</label>
                <input type="text" name="location" class="border p-2 w-full" required>
            </div>

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="border p-2 w-full" required>
            </div>

            <div class="mb-3">
                <label>Social Platform</label>
                <select name="social_platform" class="border p-2 w-full" required>
                    <option value="">Select Platform</option>
                    <option value="TikTok">TikTok</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                    <option value="WhatsApp">WhatsApp</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Shop Link</label>
                <input type="text" name="shop_link" class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="border p-2 w-full" rows="4"></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Profile
            </button>

        </form>

    </div>

</x-app-layout>
