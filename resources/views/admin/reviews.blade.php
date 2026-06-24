@extends('layouts.app')


@section('content')


<div class="min-h-screen

bg-gradient-to-br

from-slate-100

via-purple-50

to-blue-50

p-10">



<div class="max-w-7xl mx-auto">





{{-- TITLE --}}


<div class="mb-10">


<h1 class="text-4xl font-bold text-gray-800">

⭐ Buyer Reviews

</h1>


<p class="text-gray-500 mt-2">

Review buyer feedback and monitor seller reputation.

</p>


</div>









{{-- SEARCH --}}


<div class="bg-white

rounded-3xl

shadow-lg

p-6

mb-8">



<div class="flex items-center gap-3">


<span class="text-2xl">

🔎

</span>



<input


id="reviewSearch"


type="text"


placeholder="Search seller name or brand name..."


class="w-full

px-5

py-4

rounded-xl

bg-slate-50

border

border-gray-200

focus:ring-2

focus:ring-purple-400

outline-none"


>



</div>



</div>









{{-- TABLE --}}


<div class="bg-slate-50

rounded-3xl

shadow-xl

overflow-hidden">






<table class="w-full">



<thead

class="bg-gradient-to-r

from-purple-600

to-blue-600

text-white">



<tr>


<th class="px-6 py-5 text-left">

Seller Name

</th>



<th class="px-6 py-5 text-left">

Brand Name

</th>



<th class="px-6 py-5 text-left">

Rating

</th>



<th class="px-6 py-5 text-left">

Review

</th>



<th class="px-6 py-5 text-left">

Date

</th>



</tr>


</thead>








<tbody>



@forelse($reviews as $review)



<tr

class="review-row

border-b

border-gray-200

hover:bg-purple-50

transition"


data-search="

{{$review->seller_name}}

{{$review->brand_name}}

">






<td class="px-6 py-5">


<div class="font-bold text-gray-800">


{{$review->seller_name}}


</div>


</td>









<td class="px-6 py-5">



<div class="inline-block

px-4

py-2

rounded-full

bg-purple-100

text-purple-700

font-semibold">


{{$review->brand_name}}


</div>



</td>









<td class="px-6 py-5">



<div class="text-yellow-500 text-xl">


{{str_repeat('⭐',$review->rating)}}


</div>



<p class="text-sm text-gray-500">


{{$review->rating}} / 5


</p>



</td>









<td class="px-6 py-5">


<div class="bg-white

rounded-xl

p-4

shadow-sm">


<p class="text-gray-700">


{{$review->review}}


</p>



</div>


</td>









<td class="px-6 py-5 text-gray-500">


{{$review->created_at->format('d M Y')}}


</td>





</tr>





@empty



<tr>


<td colspan="5"

class="text-center py-10 text-gray-500">


No buyer reviews found.


</td>


</tr>



@endforelse





</tbody>





</table>






</div>







</div>


</div>









<script>


const search = document.getElementById('reviewSearch');


const rows = document.querySelectorAll('.review-row');



search.addEventListener('keyup',()=>{


let value = search.value.toLowerCase();



rows.forEach(row=>{


let data = row.dataset.search.toLowerCase();



row.style.display = data.includes(value)

? ""

: "none";



});


});



</script>





@endsection