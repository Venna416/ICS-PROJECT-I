@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-slate-100 p-8">


<div class="max-w-7xl mx-auto">


<h1 class="text-4xl font-bold mb-8">

🚨 Fraud Reports

</h1>




@if(session('success'))

<div class="bg-green-100 p-4 rounded-xl mb-6">

{{session('success')}}

</div>

@endif





<div class="bg-white rounded-3xl shadow-xl overflow-hidden">


<table class="w-full">


<thead class="bg-gray-100">


<tr>


<th class="p-5 text-left">
Buyer
</th>


<th class="p-5 text-left">
Seller
</th>


<th class="p-5 text-left">
Status
</th>


<th class="p-5">
Action
</th>


</tr>


</thead>





<tbody>


@foreach($reports as $report)


<tr class="border-b hover:bg-gray-50">



<td class="p-5">

{{$report->user->name ?? 'Unknown'}}

</td>




<td class="p-5 font-bold">

{{$report->brand_name}}

</td>




<td class="p-5">


@if($report->reviewed)


<span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl">

Reviewed ✓

</span>


@else


<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl">

Pending

</span>


@endif


</td>





<td class="p-5">


<a href="{{route(

'regulator.reports.investigate',

$report->id

)}}"

class="bg-red-600 text-white px-5 py-2 rounded-xl">


Investigate


</a>


</td>



</tr>


@endforeach


</tbody>


</table>


</div>



</div>

</div>


@endsection