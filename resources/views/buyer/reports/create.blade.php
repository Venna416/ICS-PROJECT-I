@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded p-8">

        <h2 class="text-3xl font-bold mb-6">
            🚨 Report Seller
        </h2>

        <form action="{{ route('buyer.reports.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="seller_profile_id" value="{{ $seller->id }}">

            <div class="mb-4">
                <label class="font-bold">Seller Name</label>

                <input type="text" value="{{ $seller->brand_name }}" class="w-full border rounded p-2 bg-gray-100"
                    readonly>
            </div>

            <div class="mb-4">
                <label class="font-bold">Shop Link</label>

                <input type="text" value="{{ $seller->shop_link }}" class="w-full border rounded p-2 bg-gray-100"
                    readonly>
            </div>

            <div class="mb-4">
                <label class="font-bold">
                    Describe the Fraud
                </label>

                <textarea name="description" rows="5" class="w-full border rounded p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="font-bold">
                    Upload Evidence
                </label>

                <input type="file" name="evidence" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="font-bold">
                    Contact Information
                </label>

                <input type="text" name="contact" class="w-full border rounded p-2" required>
            </div>


            <button class="bg-red-600 text-white px-6 py-3 rounded">
                Submit Report
            </button>

        </form>

    </div>
@endsection
