@extends('layouts.app')

@section('content')


<div class="min-h-screen

bg-gradient-to-br

from-slate-100

via-blue-50

to-purple-100

p-8">



<div class="max-w-7xl mx-auto">





<!-- HEADER -->


<div class="bg-gradient-to-r

from-indigo-700

to-purple-700

rounded-3xl

shadow-xl

p-8

mb-8

text-white">



<h1 class="text-3xl font-bold">

⭐ {{$seller->brand_name}} Reviews

</h1>



<p class="mt-3 text-indigo-100">

Customer feedback and buyer experiences.

</p>


</div>










<!-- REVIEW TABLE -->


<div class="bg-white/80

backdrop-blur

rounded-3xl

shadow-xl

overflow-hidden">





@if($reviews->count())



<div class="overflow-x-auto">



<table class="w-full text-left">



<thead>


<tr class="bg-slate-800 text-white">



<th class="px-6 py-4">

#

</th>



<th class="px-6 py-4">

Rating

</th>




<th class="px-6 py-4">

Review

</th>




<th class="px-6 py-4">

Date

</th>



</tr>



</thead>





<tbody class="divide-y divide-gray-200">





@foreach($reviews as $index=>$review)



<tr class="hover:bg-blue-50 transition">





<td class="px-6 py-5 font-bold text-gray-700">


{{$index+1}}


</td>






<td class="px-6 py-5">



<div class="text-yellow-500 text-xl">


{{str_repeat('⭐',$review->rating)}}


</div>


<span class="text-sm text-gray-500">


{{$review->rating}} / 5


</span>



</td>








<td class="px-6 py-5 text-gray-700 max-w-xl">



{{$review->review}}



</td>







<td class="px-6 py-5 text-gray-500">


{{$review->created_at->format('d M Y')}}


</td>





</tr>





@endforeach





</tbody>




</table>



</div>







@else




<div class="p-12 text-center">


<h2 class="text-2xl font-bold text-gray-700">

No Reviews Yet

</h2>


<p class="text-gray-500 mt-2">

Buyer reviews will appear here.

</p>



</div>





@endif





</div>






</div>


</div>


@endsection