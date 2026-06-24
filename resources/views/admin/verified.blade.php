@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 p-10">


<div class="max-w-7xl mx-auto">



<!-- HEADER -->

<div class="mb-10">


<h1 class="text-4xl font-bold text-gray-800">

✅ Verified Seller Applications

</h1>


<p class="text-gray-500 mt-3">

Sellers approved and verified by the verification team.

</p>


</div>







@if(session('success'))

<div class="mb-8 bg-purple-100 border border-purple-200 text-purple-700 px-6 py-4 rounded-2xl shadow-sm">

✓ {{session('success')}}

</div>

@endif







@if($sellers->count())



<div class="grid md:grid-cols-2 gap-8">





@foreach($sellers as $seller)





<div class="bg-white rounded-3xl shadow-xl p-7 border border-gray-100">







<!-- PROFILE HEADER -->


<div class="flex items-center gap-5 mb-7">



@if($seller->profile_photo)


<img

src="{{asset('storage/'.$seller->profile_photo)}}"

class="w-24 h-24 rounded-full object-cover shadow-md">


@else


<div class="w-24 h-24 rounded-full bg-purple-100 flex items-center justify-center text-4xl">

👤

</div>


@endif





<div>


<h2 class="text-2xl font-bold text-gray-800">

{{$seller->brand_name}}

</h2>


<p class="text-gray-500">

Owner:
{{$seller->user->name}}

</p>



<p class="text-sm text-gray-400">

{{$seller->user->email}}

</p>


</div>



</div>










<!-- BUSINESS DETAILS -->


<div class="grid grid-cols-2 gap-4 mb-6">


<div class="bg-blue-50 rounded-xl p-4">


<p class="text-sm text-gray-500">

Category

</p>


<p class="font-semibold">

{{$seller->business_category}}

</p>


</div>





<div class="bg-purple-50 rounded-xl p-4">


<p class="text-sm text-gray-500">

Location

</p>


<p class="font-semibold">

{{$seller->location}}

</p>


</div>




<div class="bg-pink-50 rounded-xl p-4">


<p class="text-sm text-gray-500">

Phone

</p>


<p class="font-semibold">

{{$seller->phone_number}}

</p>


</div>




<div class="bg-blue-50 rounded-xl p-4">


<p class="text-sm text-gray-500">

Social Platform

</p>


<p class="font-semibold">

{{$seller->social_platform}}

</p>


</div>



</div>









<!-- SHOP LINK -->


@if($seller->shop_link)


<a

href="{{$seller->shop_link}}"

target="_blank"

class="block text-center bg-blue-100 text-blue-700 py-3 rounded-xl mb-6 font-semibold hover:bg-blue-200">


🌐 Visit Seller Shop

</a>


@endif











<!-- VERIFICATION NOTE -->


@if($seller->verification_reason)


<div class="bg-purple-50 rounded-2xl p-5 mb-6">


<h3 class="font-bold text-purple-700 mb-2">

Verification Note

</h3>


<p class="text-gray-700">

{{$seller->verification_reason}}

</p>


</div>


@endif










<!-- SCORE -->


<div class="grid grid-cols-2 gap-5 mb-6">



<div class="bg-gray-50 rounded-xl p-4 text-center">


<p class="text-sm text-gray-500">

Trust Score

</p>


<p class="text-2xl font-bold text-blue-600">

{{$seller->trust_score ?? 'N/A'}} / 100

</p>


</div>






<div class="bg-gray-50 rounded-xl p-4 text-center">


<p class="text-sm text-gray-500">

Risk Score

</p>


<p class="text-2xl font-bold text-purple-600">

{{$seller->risk_score ?? 'N/A'}} / 10

</p>


</div>



</div>









<!-- FOOTER -->


<div class="flex justify-between items-center">


<span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-full font-bold">


✓ Verified

</span>





<a

href="{{route('admin.editVerification',$seller->id)}}"

class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl shadow hover:opacity-90">


✏️ Edit Decision

</a>



</div>






</div>





@endforeach





</div>







@else



<div class="bg-white rounded-3xl shadow p-10 text-center">


<h2 class="text-xl font-bold text-gray-700">

No verified sellers yet

</h2>


<p class="text-gray-500 mt-2">

Approved sellers will appear here.

</p>


</div>



@endif






</div>


</div>



@endsection