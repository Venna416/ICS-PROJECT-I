<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Submit Verification Request
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('seller.verification.store') }}" enctype="multipart/form-data">

                @csrf

                <!-- Document Type -->
                <div class="mb-4">
                    <label class="block font-medium">
                        Document Type
                    </label>

                    <select name="document_type" class="w-full border rounded p-2" required>

                        <option value="">Select Document</option>

                        <option value="National ID">
                            National ID
                        </option>

                        <option value="Business Permit">
                            Business Permit
                        </option>

                        <option value="KRA Certificate">
                            KRA Certificate
                        </option>

                    </select>
                </div>

                <!-- Upload Document -->
                <div class="mb-4">
                    <label class="block font-medium">
                        Upload Document
                    </label>

                    <input type="file" name="document" class="w-full border rounded p-2" required>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Submit Verification
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
