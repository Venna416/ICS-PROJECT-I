@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 p-10">


<div class="max-w-7xl mx-auto">





<!-- HEADER -->


<div class="mb-10">


<h1 class="text-4xl font-bold text-gray-800">

Seller Dashboard

</h1>


<p class="text-gray-500 mt-2">

Monitor verification status, trust score and customer activity.

</p>


</div>









<!-- VERIFICATION CARDS -->


<div class="grid md:grid-cols-3 gap-6">





<!-- STATUS -->


<div class="bg-white rounded-3xl shadow-lg p-6">


<p class="text-gray-500">

Verification Status

</p>



@if($sellerProfile->verification_status == 'verified')


<h2 class="text-2xl font-bold text-blue-600 mt-3">

✓ Verified

</h2>



@elseif($sellerProfile->verification_status == 'rejected')


<h2 class="text-2xl font-bold text-red-600 mt-3">

✕ Rejected

</h2>



@else


<h2 class="text-2xl font-bold text-purple-600 mt-3">

⏳ Pending

</h2>


@endif



</div>









<!-- TRUST -->


<div class="bg-white rounded-3xl shadow-lg p-6">


<p class="text-gray-500">

Trust Score

</p>



@if($trustScore !== null)


<h2 class="text-4xl font-bold text-purple-600 mt-3">

{{$trustScore}}%

</h2>



@else


<h2 class="text-3xl font-bold text-gray-400 mt-3">

Pending

</h2>


@endif



</div>









<!-- RISK -->


<div class="bg-white rounded-3xl shadow-lg p-6">


<p class="text-gray-500">

Risk Level

</p>



@if($riskScore !== null)


<h2 class="text-3xl font-bold mt-3">

{{$riskLevel}}

</h2>


<p class="text-gray-500">

{{$riskScore}} / 10

</p>


@else


<h2 class="text-3xl font-bold text-gray-400 mt-3">

Pending

</h2>


@endif



</div>




</div>












<!-- VERIFICATION FEEDBACK -->


<div class="mt-8 bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-2xl font-bold mb-4">

📌 Verification Feedback

</h2>




@if($sellerProfile->verification_reason)


<div class="bg-purple-50 rounded-xl p-5">


<p class="text-gray-700">

{{$sellerProfile->verification_reason}}

</p>


</div>



@else


<p class="text-gray-400">

Waiting for admin review.

</p>


@endif



</div>













<!-- BUYER ACTIVITY -->

<div class="mt-10 grid md:grid-cols-2 gap-8">



<!-- REVIEWS -->

<a href="{{route('seller.reviews')}}"

class="bg-white rounded-3xl shadow-lg p-8 
hover:shadow-xl transition cursor-pointer">


<h2 class="text-2xl font-bold">

⭐ Buyer Reviews

</h2>




<p class="text-5xl font-bold text-purple-600 mt-5">

{{$reviewCount}}

</p>




<p class="text-gray-500 mt-2">

Total reviews received from buyers.

</p>



<p class="mt-5 text-purple-600 font-semibold">

View customer feedback →

</p>



</a>







<!-- REPORTS -->


<div class="bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-2xl font-bold">

🚨 Fraud Reports

</h2>




<p class="text-5xl font-bold text-red-600 mt-5">

{{$fraudCount}}

</p>




<p class="text-gray-500 mt-2">

Reports submitted about your business.

</p>




<p class="text-sm text-gray-400 mt-4">

Report details are confidential and reviewed by the verification team.

</p>



</div>



</div>












<!-- PROFILE -->


<div class="mt-10 bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-2xl font-bold">

👤 Seller Profile

</h2>



<p class="text-gray-500 mt-2">

Manage business details, documents and profile information.

</p>




<a href="{{route('seller.profile.show',$sellerProfile->id)}}"

class="inline-block mt-5 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl">


View Profile


</a>



</div>







</div>


</div>



@endsection