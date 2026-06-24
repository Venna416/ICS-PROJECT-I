@extends('layouts.app')


@section('content')


<div class="min-h-screen 

bg-gradient-to-br from-red-50 via-purple-50 to-blue-50

p-10">


<div class="max-w-5xl mx-auto">





<div class="bg-white rounded-3xl shadow-xl p-10">





<h1 class="text-4xl font-bold text-gray-800 mb-8">

🚨 Fraud Report Details

</h1>









{{-- BASIC DETAILS --}}


<div class="grid md:grid-cols-2 gap-8">





<div>

<p class="text-gray-500">

Seller Name

</p>


<h2 class="text-xl font-bold text-gray-800">

{{$report->seller_name}}

</h2>


</div>







<div>

<p class="text-gray-500">

Brand Name

</p>


<h2 class="text-xl font-bold text-gray-800">

{{$report->brand_name}}

</h2>


</div>








<div>

<p class="text-gray-500">

Shop Link

</p>


<a 

href="{{$report->shop_link}}"

target="_blank"

class="text-blue-600 underline font-semibold">


Open Seller Link


</a>


</div>







<div>

<p class="text-gray-500">

Submitted Date

</p>


<p class="font-semibold text-gray-700">

{{$report->created_at->format('d M Y')}}

</p>


</div>





</div>









{{-- DESCRIPTION --}}


<div class="mt-8 bg-red-50 rounded-2xl p-6">



<h2 class="text-xl font-bold text-gray-800 mb-3">

Fraud Description

</h2>



<p class="text-gray-700 leading-relaxed">

{{$report->description}}

</p>



</div>









{{-- EVIDENCE --}}


<div class="mt-8 bg-purple-50 rounded-2xl p-6">



<h2 class="text-xl font-bold text-gray-800 mb-4">

📎 Evidence Uploaded

</h2>





@if($report->evidence)



@php

$extension = pathinfo($report->evidence, PATHINFO_EXTENSION);

@endphp





@if(in_array($extension,['jpg','jpeg','png']))



<img 

src="{{asset('storage/'.$report->evidence)}}"

class="max-w-md rounded-2xl shadow-lg"

alt="Evidence">






@else



<a

href="{{asset('storage/'.$report->evidence)}}"

target="_blank"

class="inline-block

bg-gradient-to-r from-purple-600 to-blue-600

text-white px-6 py-3 rounded-xl

font-bold">


Open Evidence File 📄


</a>



@endif





@else



<p class="text-gray-500">

No evidence was uploaded.

</p>



@endif



</div>









{{-- CONTACT --}}


<div class="mt-8 bg-gray-50 rounded-2xl p-6">


<h2 class="text-xl font-bold text-gray-800">

Contact Information

</h2>



<p class="mt-2 text-gray-700">

{{$report->contact}}

</p>



</div>









{{-- BACK BUTTON --}}


<a href="{{route('admin.fraudReports')}}"


class="inline-block mt-8

bg-gradient-to-r from-blue-600 to-purple-600

text-white px-8 py-3 rounded-xl

font-bold">


← Back To Reports


</a>






</div>


</div>


</div>


@endsection