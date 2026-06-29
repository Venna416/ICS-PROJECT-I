@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 p-8">

<div class="max-w-7xl mx-auto">


<div class="bg-gradient-to-r from-orange-600 to-red-600 
rounded-3xl shadow-xl p-10 text-white mb-10">


<h1 class="text-4xl font-bold">

⚠️ Regulator Seller Concerns

</h1>


<p class="mt-3 text-orange-100">

Review regulator disagreements with seller verification decisions.

</p>


</div>





<div class="bg-white rounded-3xl shadow-xl overflow-hidden">


<table class="w-full">


<thead class="bg-gray-100">

<tr>

<th class="p-5 text-left">
Seller
</th>


<th class="p-5 text-left">
Regulator Reason
</th>


<th class="p-5">
Status
</th>


<th class="p-5">
Action
</th>


</tr>

</thead>

<tbody>


@forelse($concerns as $concern)


<tr class="border-b hover:bg-gray-50">


<td class="p-5 font-bold">

{{ $concern->seller->brand_name ?? 'Unknown' }}

</td>



<td class="p-5 text-gray-600">

{{ $concern->reason }}

</td>





<td class="p-5">


@if($concern->is_fair)


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl">

✓ Fair Decision

</span>


@else


<span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl">

✕ Not Fair

</span>


@endif



</td>





<td class="p-5">


@if($concern->reviewed)


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl">

Reviewed ✓

</span>



@else


<a href="{{route(

'admin.editVerification',

$concern->seller_id

)}}"

class="bg-blue-600 text-white px-5 py-2 rounded-xl">


Review Decision


</a>


@endif



</td>


</tr>



@empty


<tr>

<td colspan="4"

class="p-10 text-center text-gray-500">


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