@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">


<div class="max-w-7xl mx-auto">





@if(session('success'))

<div class="mb-8 bg-green-100 border border-green-300 text-green-700 p-5 rounded-2xl font-semibold shadow">

✅ {{session('success')}}

</div>

@endif







<!-- HEADER -->

<div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700

rounded-3xl shadow-xl p-10 text-white mb-8">



<div class="flex justify-between items-center">


<div>


<h1 class="text-4xl font-bold">

🏢 Seller Monitoring

</h1>



<p class="mt-3 text-indigo-100">

Review seller verification decisions and compliance records.

</p>


</div>






<a href="{{route('regulator.dashboard')}}"

class="bg-white text-indigo-700 px-6 py-3 rounded-xl font-bold shadow">


← Dashboard


</a>




</div>


</div>









<!-- SELLER TABLE -->


<div class="bg-white rounded-3xl shadow-xl overflow-hidden">


<div class="overflow-x-auto">


<table class="w-full text-left">



<thead class="bg-slate-100">


<tr>


<th class="p-5 font-bold">

Brand

</th>


<th class="p-5 font-bold">

Category

</th>


<th class="p-5 font-bold">

Status

</th>


<th class="p-5 font-bold">

Trust Score

</th>


<th class="p-5 font-bold">

Risk Score

</th>


<th class="p-5 font-bold">

Regulator Review

</th>


<th class="p-5 font-bold">

Action

</th>



</tr>


</thead>







<tbody>


@forelse($sellers as $seller)



<tr class="border-b hover:bg-slate-50 transition">





<td class="p-5">


<div class="font-bold text-gray-800 text-lg">

{{$seller->brand_name}}

</div>


<p class="text-sm text-gray-500">

{{$seller->user->name ?? 'N/A'}}

</p>


</td>







<td class="p-5 text-gray-600">


{{$seller->business_category ?? 'N/A'}}


</td>









<td class="p-5">


@if($seller->verification_status == 'verified')


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">


✓ Verified


</span>



@elseif($seller->verification_status == 'rejected')


<span class="bg-red-100 text-red-700 px-4 py-2 rounded-full font-semibold">


✕ Rejected


</span>



@else


<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">


⏳ Pending


</span>



@endif


</td>









<td class="p-5">


<span class="font-bold text-purple-600 text-lg">


{{$seller->trust_score ?? 0}}%


</span>


</td>










<td class="p-5">



@if(($seller->risk_score ?? 0) <= 3)


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">

Low

</span>



@elseif(($seller->risk_score ?? 0) <= 6)


<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">

Medium

</span>



@else


<span class="bg-red-100 text-red-700 px-4 py-2 rounded-full font-semibold">

High

</span>



@endif



<p class="text-xs text-gray-500 mt-2">


{{$seller->risk_score ?? 0}}/10


</p>


</td>









<td class="p-5">



@if(\App\Models\RegulatorReview::where('seller_id',$seller->id)->exists())


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">


✓ Reviewed


</span>



@else


<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">


⏳ Not Reviewed


</span>



@endif



</td>









<td class="p-5">


<a href="{{route('regulator.seller.show',$seller->id)}}"

class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl font-semibold">


🔎 Investigate


</a>


</td>







</tr>




@empty



<tr>


<td colspan="7"

class="p-10 text-center text-gray-400">


No seller records found.


</td>


</tr>



@endforelse





</tbody>




</table>



</div>


</div>







</div>


</div>



@endsection