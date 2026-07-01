@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-10">


<div class="max-w-5xl mx-auto px-5">


<div class="bg-white rounded-3xl shadow-xl overflow-hidden">





<!-- HEADER -->

<div class="bg-gradient-to-r from-blue-600 to-purple-600 p-10 text-white">


<div class="flex flex-col md:flex-row items-center gap-8">


@if($profile->profile_photo)

<img

src="{{asset('storage/'.$profile->profile_photo)}}"

class="w-36 h-36 rounded-full border-4 border-white shadow-lg object-cover">


@else


<div class="w-36 h-36 rounded-full bg-white/30 flex items-center justify-center text-6xl">

👤

</div>


@endif





<div class="text-center md:text-left">


<h1 class="text-4xl font-bold">

{{$profile->brand_name}}

</h1>


<p class="mt-3 text-lg opacity-90">

{{Auth::user()->name}}

</p>


<p class="opacity-80">

{{Auth::user()->email}}

</p>


</div>



</div>


</div>










<!-- BUSINESS PROFILE -->


<div class="p-10">



<h2 class="text-3xl font-bold text-gray-800 mb-8">

🏪 Business Profile

</h2>





<div class="grid md:grid-cols-2 gap-6">






<div class="bg-blue-50 rounded-2xl p-6">


<div class="text-blue-600 text-3xl mb-3">

🏷️

</div>


<h3 class="font-bold text-gray-700">

Business Category

</h3>


<p class="mt-2 text-gray-600">

{{$profile->business_category ?? 'Not provided'}}

</p>


</div>







<div class="bg-purple-50 rounded-2xl p-6">


<div class="text-purple-600 text-3xl mb-3">

📍

</div>


<h3 class="font-bold text-gray-700">

Location

</h3>


<p class="mt-2 text-gray-600">

{{$profile->location ?? 'Not provided'}}

</p>


</div>








<div class="bg-pink-50 rounded-2xl p-6">


<div class="text-pink-600 text-3xl mb-3">

📞

</div>


<h3 class="font-bold text-gray-700">

Contact Number

</h3>


<p class="mt-2 text-gray-600">

{{$profile->phone_number ?? 'Not provided'}}

</p>


</div>







<div class="bg-green-50 rounded-2xl p-6">


<div class="text-green-600 text-3xl mb-3">

🌐

</div>


<h3 class="font-bold text-gray-700">

Social Platform

</h3>


<p class="mt-2 text-gray-600">

{{$profile->social_platform ?? 'Not provided'}}

</p>


</div>





</div>



</div>









<!-- SHOP LINK -->


@if($profile->shop_link)

<div class="px-10 pb-5">


<h2 class="text-2xl font-bold mb-4">

🔗 Online Store

</h2>


<a

href="{{$profile->shop_link}}"

target="_blank"

class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700">


Visit Shop

</a>


</div>


@endif










<!-- DESCRIPTION -->


<div class="px-10 pb-10">


<h2 class="text-2xl font-bold mb-4">

📝 About The Business

</h2>



<div class="bg-gray-50 rounded-2xl p-6 text-gray-700 leading-relaxed">


{{$profile->description ?? 'No business description added yet.'}}


</div>



</div>









<!-- ACTIONS -->


<div class="px-10 pb-10 flex gap-4">



<a

href="{{route('seller.profile.edit',$profile->id)}}"

class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700">


✏️ Edit Profile


</a>








</div>






</div>


</div>


</div>


@endsection