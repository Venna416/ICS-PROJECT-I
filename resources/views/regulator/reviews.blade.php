@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-indigo-50 to-blue-100 p-8">


<div class="max-w-7xl mx-auto">



{{-- HEADER --}}

<div class="bg-white rounded-3xl shadow-xl p-8 mb-10 border">


<div class="flex flex-col md:flex-row justify-between gap-5">


<div>


<h1 class="text-4xl font-extrabold text-gray-800">

💬 Review Moderation Center

</h1>


<p class="text-gray-500 mt-3">

Monitor buyer reviews, suspicious activity and marketplace trust.

</p>


</div>





{{-- SEARCH --}}

<form method="GET"

action="{{route('regulator.reviews')}}">


<div class="relative">


<input

type="text"

name="search"

value="{{request('search')}}"

placeholder="🔎 Search reviews..."

class="w-80 px-5 py-3 rounded-2xl border

shadow-sm

focus:ring-2 focus:ring-indigo-500"

>



@if(request('search'))

<a href="{{route('regulator.reviews')}}"

class="absolute right-4 top-3 text-gray-400">


✕

</a>

@endif


</div>


</form>



</div>


</div>









@if(session('success'))

<div class="bg-green-100 text-green-700

p-4 rounded-2xl mb-6">


{{session('success')}}


</div>


@endif







{{-- REVIEWS --}}



@forelse($reviews as $review)



<div class="bg-white rounded-3xl shadow-lg p-7 mb-6

hover:shadow-xl transition">





<div class="flex justify-between">


<div>


<h2 class="text-xl font-bold text-indigo-700">


🏪 {{$review->brand_name}}


</h2>


<p class="text-gray-500">


Seller: {{$review->seller_name}}


</p>


</div>





@if($review->status == 'hidden')


<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl">

Hidden

</span>



@elseif($review->status == 'removed')


<span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl">

Removed

</span>



@else


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl">

Active

</span>



@endif



</div>








<div class="mt-5 bg-slate-50 rounded-2xl p-5">


<div class="text-yellow-500 text-xl">


{{str_repeat('⭐',$review->rating)}}


</div>


<p class="mt-3 italic text-gray-700">


"{{$review->review}}"


</p>


</div>







<div class="mt-5 flex justify-between items-center">


<p class="text-sm text-gray-400">

{{$review->created_at->diffForHumans()}}

</p>





<div class="flex gap-3">





@if($review->status != 'hidden')


<form method="POST"

action="{{route('regulator.review.hide',$review->id)}}">


@csrf

@method('PUT')


<button

class="bg-yellow-500 text-white px-5 py-2 rounded-xl">


Hide


</button>


</form>


@endif








@if($review->status == 'hidden')


<form method="POST"

action="{{route('regulator.review.restore',$review->id)}}">


@csrf

@method('PUT')


<button

class="bg-blue-600 text-white px-5 py-2 rounded-xl">


Restore


</button>


</form>


@endif







<form method="POST"

action="{{route('regulator.review.delete',$review->id)}}">


@csrf

@method('DELETE')


<button

onclick="return confirm('Delete review permanently?')"

class="bg-red-600 text-white px-5 py-2 rounded-xl">


Delete


</button>


</form>







</div>


</div>



</div>




@empty


<div class="bg-white rounded-3xl p-10 text-center text-gray-400">


📭 No reviews found


</div>


@endforelse






</div>


</div>


@endsection