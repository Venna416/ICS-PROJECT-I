@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 to-pink-50 p-8">


<div class="max-w-7xl mx-auto">



<h1 class="text-4xl font-bold text-gray-800 mb-10">

Admin Dashboard

</h1>





<div class="grid md:grid-cols-3 gap-6">





<!-- PENDING -->

<a href="{{route('admin.pending')}}"

class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">

Pending Sellers

</h2>


<p class="text-5xl font-bold text-yellow-500 mt-4">

{{$pendingCount}}

</p>


<p class="mt-3 text-gray-500">

Review applications →

</p>


</a>








<!-- VERIFIED -->


<a href="{{route('admin.verified')}}"

class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">

Verified Sellers

</h2>


<p class="text-5xl font-bold text-green-500 mt-4">

{{$verifiedCount}}

</p>


<p class="mt-3 text-gray-500">

View approved sellers →

</p>


</a>








<!-- REJECTED -->


<a href="{{route('admin.rejected')}}"

class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">

Rejected Sellers

</h2>


<p class="text-5xl font-bold text-red-500 mt-4">

{{$rejectedCount}}

</p>


<p class="mt-3 text-gray-500">

View rejected sellers →

</p>


</a>







<!-- REVIEWS -->


<a href="{{route('admin.reviews')}}"

class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">

⭐ Buyer Reviews

</h2>


<p class="text-5xl font-bold text-purple-600 mt-4">

{{$reviewCount}}

</p>


<p class="text-gray-500 mt-3">

View buyer reviews →

</p>


</a>







<!-- FRAUD REPORTS -->


<a href="{{route('admin.fraudReports')}}"

class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">

🚨 Fraud Reports

</h2>


<p class="text-5xl font-bold text-red-600 mt-4">

{{$fraudCount}}

</p>


<p class="text-gray-500 mt-3">

View reports →

</p>


</a>






</div>





</div>


</div>


@endsection