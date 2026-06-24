@extends('layouts.app')


@section('content')


<div class="min-h-screen 

bg-gradient-to-br from-slate-100 via-red-50 to-purple-50

p-10">



<div class="max-w-7xl mx-auto">






{{-- HEADER --}}


<div class="mb-8">


<h1 class="text-4xl font-bold text-gray-800">

🚨 Fraud Reports Center

</h1>


<p class="text-gray-500 mt-2">

Search and review buyer fraud reports.

</p>





{{-- SEARCH --}}


<form method="GET"

action="{{route('admin.fraudReports')}}"

class="mt-6">



<div class="flex gap-4">



<input

type="text"

name="search"

value="{{request('search')}}"

placeholder="Search seller name or brand name..."

class="flex-1 px-5 py-3 rounded-xl

border border-gray-200

bg-white

shadow

focus:ring-2 focus:ring-purple-400

outline-none">





<button

class="px-8 py-3 rounded-xl

bg-gradient-to-r from-red-500 to-purple-600

text-white font-bold">


🔍 Search


</button>




</div>


</form>



</div>









{{-- TABLE --}}


<div class="bg-white rounded-3xl shadow-xl overflow-hidden">





@if($reports->count())



<table class="w-full text-left">



<thead class="bg-gradient-to-r from-red-500 to-purple-600 text-white">


<tr>


<th class="px-6 py-4">

Seller Name

</th>



<th class="px-6 py-4">

Brand Name

</th>



<th class="px-6 py-4">

Date

</th>



<th class="px-6 py-4">

Action

</th>


</tr>


</thead>







<tbody>



@foreach($reports as $report)



<tr class="border-b hover:bg-gray-50 transition">





<td class="px-6 py-5 font-semibold text-gray-800">


{{$report->seller_name}}


</td>







<td class="px-6 py-5 font-semibold text-purple-700">


{{$report->brand_name}}


</td>







<td class="px-6 py-5 text-gray-500">


{{$report->created_at->format('d M Y')}}


</td>







<td class="px-6 py-5">


<a

href="{{route('admin.fraud.show',$report->id)}}"

class="px-5 py-2 rounded-xl

bg-gradient-to-r from-blue-600 to-purple-600

text-white font-bold

hover:opacity-90">


View Report →

</a>


</td>





</tr>





@endforeach



</tbody>





</table>








@else



<div class="p-10 text-center">


<h2 class="text-xl font-bold text-gray-700">

No fraud reports found

</h2>


<p class="text-gray-500 mt-2">

Buyer reports will appear here.

</p>


</div>



@endif






</div>






</div>


</div>



@endsection