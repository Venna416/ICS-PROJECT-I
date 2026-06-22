@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-10">


<div class="max-w-7xl mx-auto px-6">


<!-- TITLE -->

<div class="mb-10">


<h1 class="text-4xl font-bold text-gray-800">

⏳ Pending Seller Verification

</h1>





</div>






<!-- SELLERS -->

<div class="grid md:grid-cols-3 gap-8">



@forelse($sellers as $seller)





<div class="bg-white rounded-3xl shadow-lg hover:shadow-xl transition p-6">





<!-- PROFILE PHOTO -->

<div class="flex justify-center">


@if($seller->profile_photo)


<img

src="{{asset('storage/'.$seller->profile_photo)}}"

class="w-28 h-28 rounded-full object-cover border-4 border-blue-200">


@else


<div class="w-28 h-28 rounded-full bg-blue-100 flex items-center justify-center text-5xl">

👤

</div>


@endif


</div>







<!-- NAME -->


<div class="text-center mt-5">


<h2 class="text-2xl font-bold text-gray-800">


{{$seller->brand_name}}


</h2>



<p class="text-gray-500 mt-1">


{{$seller->user->name ?? 'Seller'}}


</p>



<p class="text-sm text-gray-400">


{{$seller->user->email ?? ''}}


</p>


</div>









<!-- BUSINESS INFO -->


<div class="mt-6 space-y-3">



<div class="bg-blue-50 rounded-xl p-3">


<p class="text-sm text-gray-500">

Category

</p>


<p class="font-semibold">

{{$seller->business_category}}

</p>


</div>






<div class="bg-purple-50 rounded-xl p-3">


<p class="text-sm text-gray-500">

Location

</p>


<p class="font-semibold">

{{$seller->location}}

</p>


</div>






<div class="bg-green-50 rounded-xl p-3">


<p class="text-sm text-gray-500">

Phone

</p>


<p class="font-semibold">

{{$seller->phone_number}}

</p>


</div>



</div>









<!-- BUTTON -->


<a


href="{{route('admin.seller.show',$seller->id)}}"



class="block text-center mt-6 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:scale-105 transition">


View Full Application


</a>





</div>





@empty



<div class="col-span-3 bg-white p-10 rounded-2xl text-center shadow">


<h2 class="text-xl font-bold text-gray-700">

No Pending Sellers

</h2>


<p class="text-gray-500 mt-2">

All seller applications have been reviewed.

</p>


</div>



@endforelse





</div>





</div>


</div>



@endsection