<x-app-layout>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Seller Dashboard
    </h1>

    <a
        href="{{ route('seller.profile.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded"
    >
        Create Seller Profile
    </a>

</div>

</x-app-layout>