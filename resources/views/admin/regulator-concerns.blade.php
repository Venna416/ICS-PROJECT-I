@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-100 via-indigo-50 to-blue-100 p-8">


<div class="max-w-7xl mx-auto">



{{-- HEADER --}}

<div class="bg-gradient-to-r from-indigo-700 via-blue-700 to-slate-800

rounded-3xl shadow-2xl p-10 text-white mb-10">


<div class="flex justify-between items-center">


<div>


<h1 class="text-4xl font-bold">

🛡️ Regulator Seller Concerns

</h1>


<p class="mt-3 text-indigo-100">

Review regulator feedback and verify seller compliance decisions.

</p>


</div>



<div class="text-6xl opacity-90">

⚖️

</div>


</div>


</div>






@if(session('success'))

<div class="mb-6 bg-emerald-100 border border-emerald-300

text-emerald-700 rounded-2xl p-5 font-semibold shadow">


✓ {{session('success')}}


</div>


@endif







{{-- TABLE CARD --}}


<div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200">


<table class="w-full">



<thead class="bg-slate-900 text-white">


<tr>


<th class="p-5 text-left">
Seller
</th>


<th class="p-5 text-left">
Regulator
</th>


<th class="p-5 text-left">
Concern
</th>


<th class="p-5 text-center">
Decision
</th>


<th class="p-5 text-center">
Review Status
</th>


<th class="p-5 text-center">
Action
</th>


</tr>


</thead>






<tbody>


@forelse($concerns as $concern)



<tr class="border-b hover:bg-indigo-50 transition">





{{-- SELLER --}}


<td class="p-5">


<div>


<p class="font-bold text-gray-800 text-lg">


{{ $concern->seller->brand_name ?? 'Unknown Seller' }}


</p>


<p class="text-sm text-gray-500">


{{ $concern->seller->user->name ?? '' }}


</p>


</div>


</td>








{{-- REGULATOR --}}


<td class="p-5">


<p class="font-semibold text-gray-800">


{{ $concern->regulator->name ?? 'Unknown' }}


</p>


<span class="text-sm text-gray-500">

Regulator

</span>


</td>








{{-- CONCERN --}}


<td class="p-5 text-gray-600 max-w-md">


{{ $concern->reason }}


</td>








{{-- DECISION --}}


<td class="p-5 text-center">


@if($concern->is_fair)


<span class="inline-flex items-center

bg-green-100 text-green-700

px-4 py-2 rounded-xl font-semibold">


✓ Fair Decision


</span>


@else


<span class="inline-flex items-center

bg-red-100 text-red-700

px-4 py-2 rounded-xl font-semibold">


✕ Not Fair


</span>


@endif


</td>










{{-- STATUS --}}


<td class="p-5 text-center">


@if($concern->reviewed)


<span class="bg-emerald-100 text-emerald-700

px-4 py-2 rounded-xl font-semibold">


Reviewed ✓


</span>


@else


<span class="bg-yellow-100 text-yellow-700

px-4 py-2 rounded-xl font-semibold">


Pending ⏳


</span>


@endif



</td>










{{-- ACTION --}}


<td class="p-5 text-center">


<a href="{{route(

'admin.editVerification',

[

$concern->seller_id,

'from'=>'regulator'

]

)}}"



class="inline-block

bg-indigo-600 hover:bg-indigo-700

text-white px-6 py-3

rounded-xl font-semibold

shadow-md transition">


Review Decision


</a>



</td>






</tr>





@empty



<tr>


<td colspan="6"

class="p-12 text-center text-gray-500">


<div class="text-5xl mb-3">

📭

</div>


No regulator concerns found.



</td>


</tr>



@endforelse





</tbody>



</table>



</div>






</div>


</div>



@endsection