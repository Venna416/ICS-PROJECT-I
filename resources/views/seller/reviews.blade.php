@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 p-10">


<div class="max-w-6xl mx-auto">



<h1 class="text-4xl font-bold text-gray-800 mb-8">

⭐ Buyer Reviews

</h1>




@if($reviews->count())


<div class="grid md:grid-cols-2 gap-6">


@foreach($reviews as $review)


<div class="bg-white rounded-3xl shadow-lg p-7">


<h2 class="text-xl font-bold text-gray-800">

{{$review->brand_name}}

</h2>


<p class="text-gray-500 mt-1">

Seller:
{{$review->seller_name}}

</p>



<div class="text-yellow-500 text-2xl mt-4">

{{str_repeat('⭐',$review->rating)}}

</div>




<div class="mt-5 bg-purple-50 rounded-xl p-5">


<p class="text-gray-700">

{{$review->review}}

</p>


</div>



<p class="text-sm text-gray-400 mt-4">

{{ $review->created_at->format('d M Y') }}

</p>



</div>


@endforeach


</div>


@else


<div class="bg-white rounded-3xl p-10 shadow">

No reviews available yet.

</div>


@endif



</div>


</div>



@endsection