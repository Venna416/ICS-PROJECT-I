@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-10">


<div class="max-w-7xl mx-auto">



<!-- HEADER -->

<div class="bg-gradient-to-r from-blue-700 to-purple-700 rounded-3xl p-8 text-white shadow-xl mb-8">


<h1 class="text-4xl font-bold">

🔎 Seller Verification Review

</h1>


<p class="mt-2 text-blue-100">

Review seller information, documents and verification assessment.

</p>


</div>









<!-- SELLER PROFILE -->


<div class="bg-white rounded-3xl shadow-lg p-8 mb-8">



<h2 class="text-2xl font-bold mb-6">

👤 Seller Profile

</h2>




<div class="flex items-center gap-6">


@if($seller->profile_photo)


<img

src="{{asset('storage/'.$seller->profile_photo)}}"

class="w-28 h-28 rounded-full object-cover shadow">


@else


<div class="w-28 h-28 rounded-full bg-blue-100 flex items-center justify-center text-5xl">

👤

</div>


@endif





<div>


<h3 class="text-3xl font-bold">

{{$seller->brand_name}}

</h3>



<p class="text-gray-500 mt-2">

Owner:

{{$seller->user->name}}

</p>



<p class="text-gray-500">

{{$seller->user->email}}

</p>



</div>



</div>


</div>









<!-- SCORE DISPLAY -->

<div class="grid md:grid-cols-3 gap-6 mb-8">



<div class="bg-blue-50 rounded-3xl p-6 shadow">


<h3 class="font-bold text-blue-700">

⭐ Trust Score

</h3>


<p class="text-5xl font-bold mt-3">

{{$seller->trust_score ?? 0}}%

</p>


</div>








<div class="bg-red-50 rounded-3xl p-6 shadow">


<h3 class="font-bold text-red-700">

⚠ Risk Score

</h3>


<p class="text-5xl font-bold mt-3">

{{$seller->risk_score ?? 0}}/10

</p>


</div>









<div class="bg-gray-50 rounded-3xl p-6 shadow">


<h3 class="font-bold text-gray-700">

Status

</h3>



<p class="text-2xl font-bold mt-5">





@if($seller->verification_status == "verified")


<span class="px-5 py-2 rounded-full

bg-green-100 text-green-700">

✓ Verified

</span>






@elseif($seller->verification_status == "rejected")


<span class="px-5 py-2 rounded-full

bg-red-100 text-red-700">

✕ Rejected

</span>






@elseif($seller->verification_status == "pending")


<span class="px-5 py-2 rounded-full

bg-yellow-100 text-yellow-700">

⏳ Pending Review

</span>






@else


<span class="px-5 py-2 rounded-full

bg-gray-100 text-gray-700">

Not Assessed

</span>





@endif





</p>


</div>





</div>
<!-- DOCUMENTS -->


<div class="bg-white rounded-3xl shadow-lg p-8 mb-8">



<h2 class="text-2xl font-bold mb-6">

📂 Verification Documents

</h2>




<div class="grid md:grid-cols-3 gap-5">






@if($seller->id_front)


<a

href="{{asset('storage/'.$seller->id_front)}}"

target="_blank"

class="bg-blue-100 hover:bg-blue-200 rounded-2xl p-6 text-center transition">


<div class="text-4xl">

🪪

</div>


<p class="font-bold mt-3">

National ID Front

</p>


<p class="text-sm text-gray-500">

Click to view

</p>


</a>


@endif







@if($seller->id_back)


<a

href="{{asset('storage/'.$seller->id_back)}}"

target="_blank"

class="bg-blue-100 hover:bg-blue-200 rounded-2xl p-6 text-center transition">


<div class="text-4xl">

🪪

</div>


<p class="font-bold mt-3">

National ID Back

</p>


<p class="text-sm text-gray-500">

Click to view

</p>


</a>


@endif







@foreach($seller->documents as $document)


<a

href="{{asset('storage/'.$document->file_path)}}"

target="_blank"

class="bg-purple-100 hover:bg-purple-200 rounded-2xl p-6 text-center transition">


<div class="text-4xl">

📄

</div>


<p class="font-bold mt-3">

{{$document->document_type}}

</p>


<p class="text-sm text-gray-500">

Click to open

</p>


</a>


@endforeach





</div>



</div>









<!-- GENERATED REASON -->


<div class="bg-yellow-50 rounded-3xl p-8 mb-8">


<h2 class="text-2xl font-bold mb-4">

📌 System Verification Reason

</h2>



<p class="text-gray-700 leading-relaxed">


{{$seller->verification_reason ?? 

'Verification has not been completed yet.'}}


</p>


</div>









<!-- ACTION -->


<div class="bg-white rounded-3xl shadow-lg p-8">



<h2 class="text-2xl font-bold mb-5">

⚖️ Continue Verification

</h2>



<a

href="{{route('admin.editVerification',$seller->id)}}"

class="inline-block px-10 py-4 rounded-xl

bg-gradient-to-r from-blue-600 to-purple-600

text-white font-bold">


Open Verification Assessment

</a>



</div>






</div>


</div>


@endsection