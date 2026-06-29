@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">


<div class="max-w-7xl mx-auto">



<div class="mb-10">


<h1 class="text-4xl font-bold text-gray-800">

💬 Review Moderation Center

</h1>


<p class="text-gray-600 mt-3">

Monitor buyer feedback, suspicious reviews and marketplace trust.

</p>


</div>






@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">

{{session('success')}}

</div>

@endif







@forelse($reviews as $review)



<div class="bg-white rounded-3xl shadow-lg p-8 mb-6">





<div class="flex justify-between items-start">



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










<div class="mt-6 bg-gray-50 rounded-2xl p-5">



<p class="text-yellow-500 text-xl">


{{str_repeat('⭐',$review->rating)}}

</p>




<p class="mt-3 text-gray-700 italic">

"{{$review->review}}"

</p>



</div>








<div class="mt-5 flex justify-between items-center">


<p class="text-sm text-gray-400">

{{$review->created_at->diffForHumans()}}

</p>





<div class="flex gap-3">



@if($review->status != 'hidden')

<form action="{{route('regulator.review.hide',$review->id)}}"

method="POST">

@csrf

@method('PUT')


<button class="bg-yellow-500 text-white px-5 py-2 rounded-xl">


Hide


</button>


</form>

@endif








@if($review->status == 'hidden')


<form action="{{route('regulator.review.restore',$review->id)}}"

method="POST">

@csrf

@method('PUT')


<button class="bg-blue-600 text-white px-5 py-2 rounded-xl">


Restore


</button>


</form>


@endif









<form action="{{route('regulator.review.delete',$review->id)}}"

method="POST">


@csrf

@method('DELETE')



<button onclick="return confirm('Remove review permanently?')"

class="bg-red-600 text-white px-5 py-2 rounded-xl">


Remove


</button>


</form>






</div>



</div>




</div>





@empty


<div class="bg-white rounded-3xl p-10 text-center text-gray-500">


📭 No buyer reviews found.


</div>


@endforelse





</div>


</div>


@endsection