@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">


<div class="max-w-7xl mx-auto">



<!-- TITLE -->

<div class="mb-8">


<h1 class="text-4xl font-bold text-gray-800">

🔎 Verified Sellers Directory

</h1>


<p class="text-gray-500 mt-2">

Search trusted sellers and check their verification information.

</p>


</div>







<!-- SEARCH -->

<div class="bg-white rounded-3xl shadow-lg p-6 mb-8">


<input


id="sellerSearch"


type="text"


placeholder="Search seller or brand name..."


class="w-full px-6 py-4 rounded-2xl border

focus:ring-2 focus:ring-purple-500 outline-none"



>


</div>









<!-- TABLE -->

<div class="bg-white rounded-3xl shadow-xl overflow-hidden">



<table class="w-full text-left">


<thead class="bg-gradient-to-r from-blue-700 to-purple-700 text-white">


<tr>


<th class="p-5">

Brand Name

</th>


<th class="p-5">

Seller Name

</th>



<th class="p-5">

Verification

</th>



<th class="p-5">

Trust Score

</th>



<th class="p-5">

Risk Score

</th>



<th class="p-5">

Action

</th>


</tr>


</thead>






<tbody id="sellerTable">



@foreach($sellers as $seller)



<tr class="seller-row border-b hover:bg-blue-50 transition"


data-search="

{{$seller->brand_name}}

{{$seller->user->name ?? ''}}

"

>



<td class="p-5 font-bold text-gray-800">


{{$seller->brand_name}}


</td>





<td class="p-5 text-gray-600">


{{$seller->user->name ?? 'Seller'}}


</td>






<td class="p-5">


<span class="px-4 py-2 rounded-full

bg-green-100 text-green-700 font-bold">


✓ Verified


</span>


</td>







<td class="p-5">


<span class="font-bold text-purple-600">


{{$seller->trust_score}}%


</span>


</td>








<td class="p-5">


<span class="font-bold text-red-600">


{{$seller->risk_score}} / 10


</span>


</td>








<td class="p-5">


<a href="{{route('buyer.seller.reviews',$seller->id)}}"


class="px-5 py-2 rounded-xl

bg-gradient-to-r from-blue-600 to-purple-600

text-white font-bold">


View Reviews


</a>


</td>




</tr>




@endforeach




</tbody>



</table>



</div>





</div>


</div>







<script>


const search = document.getElementById('sellerSearch');


const rows = document.querySelectorAll('.seller-row');



search.addEventListener('keyup', function(){


let value = this.value.toLowerCase();



rows.forEach(row=>{


let text = row.dataset.search.toLowerCase();



if(text.includes(value)){


row.style.display="table-row";


}

else{


row.style.display="none";


}


});


});



</script>



@endsection