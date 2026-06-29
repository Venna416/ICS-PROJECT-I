@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">


<div class="max-w-7xl mx-auto">





@if(session('success'))

<div class="mb-6 bg-green-100 border border-green-300 text-green-700 p-5 rounded-2xl font-semibold">

✅ {{session('success')}}

</div>

@endif







<!-- HEADER -->

<div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700 rounded-3xl shadow-xl p-10 text-white mb-8">


<div class="flex justify-between items-center">


<div>

<h1 class="text-4xl font-bold">

🔎 Seller Investigation

</h1>


<p class="mt-3 text-indigo-100">

Regulator review and compliance assessment

</p>


</div>




<a href="{{route('regulator.sellers')}}"

class="bg-white text-indigo-700 px-6 py-3 rounded-xl font-bold">


← Back


</a>



</div>


</div>










<!-- SELLER INFO -->


<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">


<h2 class="text-2xl font-bold mb-6">

👤 Seller Information

</h2>



<div class="flex gap-6 items-center">


@if($seller->profile_photo)

<img src="{{asset('storage/'.$seller->profile_photo)}}"

class="w-32 h-32 rounded-full object-cover">


@else


<div class="w-32 h-32 bg-indigo-100 rounded-full flex items-center justify-center text-5xl">

🏪

</div>


@endif




<div>


<h2 class="text-3xl font-bold">

{{$seller->brand_name}}

</h2>


<p class="text-gray-500">

Owner:

{{$seller->user->name ?? 'N/A'}}

</p>


<p class="text-gray-500">

Email:

{{$seller->user->email ?? 'N/A'}}

</p>



</div>


</div>


</div>










<!-- SCORES -->


<div class="grid md:grid-cols-3 gap-6 mb-8">


<div class="bg-white rounded-3xl shadow p-6">


<p class="text-gray-500">

Verification Status

</p>



@if($seller->verification_status=='verified')


<h2 class="text-3xl font-bold text-green-600 mt-3">

✓ Verified

</h2>



@elseif($seller->verification_status=='rejected')


<h2 class="text-3xl font-bold text-red-600 mt-3">

✕ Rejected

</h2>


@else


<h2 class="text-3xl font-bold text-yellow-600 mt-3">

⏳ Pending

</h2>


@endif


</div>






<div class="bg-white rounded-3xl shadow p-6">


<p>

⭐ Trust Score

</p>


<h2 class="text-5xl font-bold text-purple-600 mt-3">

{{$seller->trust_score ?? 0}}%

</h2>


</div>






<div class="bg-white rounded-3xl shadow p-6">


<p>

⚠ Risk Score

</p>


<h2 class="text-5xl font-bold text-red-600 mt-3">

{{$seller->risk_score ?? 0}}/10

</h2>


</div>



</div>









<!-- BUSINESS -->


<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">


<h2 class="text-2xl font-bold mb-6">

🏪 Business Information

</h2>



<div class="grid md:grid-cols-2 gap-5">


<div class="bg-slate-50 p-5 rounded-xl">

<b>Category</b>

<p>{{$seller->business_category}}</p>

</div>



<div class="bg-slate-50 p-5 rounded-xl">

<b>Location</b>

<p>{{$seller->location}}</p>

</div>



<div class="bg-slate-50 p-5 rounded-xl">

<b>Phone</b>

<p>{{$seller->phone_number}}</p>

</div>


<div class="bg-slate-50 p-5 rounded-xl">

<b>Social</b>

<p>{{$seller->social_platform}}</p>

</div>


</div>


</div>









<!-- DOCUMENTS -->


<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">


<h2 class="text-2xl font-bold mb-6">

📂 Documents

</h2>



<div class="grid md:grid-cols-3 gap-5">



@if($seller->id_front)

<a href="{{asset('storage/'.$seller->id_front)}}"

target="_blank"

class="bg-blue-100 p-6 rounded-2xl text-center">


🪪

<br>

ID Front

</a>

@endif





@if($seller->id_back)

<a href="{{asset('storage/'.$seller->id_back)}}"

target="_blank"

class="bg-blue-100 p-6 rounded-2xl text-center">


🪪

<br>

ID Back

</a>

@endif






@foreach($seller->documents as $document)


<a href="{{asset('storage/'.$document->file_path)}}"

target="_blank"

class="bg-purple-100 p-6 rounded-2xl text-center">


📄

<br>

{{$document->document_type}}


</a>



@endforeach



</div>


</div>









<!-- ADMIN REASON -->


<div class="bg-yellow-50 rounded-3xl p-8 mb-8">


<h2 class="text-2xl font-bold mb-4">

📌 Admin Decision Reason

</h2>


<p>

{{$seller->verification_reason ?? 'No reason provided'}}

</p>



</div>



<!-- REGULATOR REVIEW -->

<div class="bg-white rounded-3xl shadow-xl p-8">


<h2 class="text-2xl font-bold mb-6">

⚖️ Regulator Assessment

</h2>





@if($regulatorReview)
<a href="{{route('regulator.review.edit',$regulatorReview->id)}}"

class="inline-block mt-5 bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold">


✏️ Edit Review


</a>


<div class="bg-green-50 rounded-2xl p-6 mb-5">


<h3 class="font-bold text-green-700 text-xl">

✓ Already Reviewed

</h3>



<p class="mt-3">


<strong>Decision:</strong>



@if($regulatorReview->is_fair)


<span class="text-green-600 font-bold">

Fair Decision

</span>


@else


<span class="text-red-600 font-bold">

Not Fair

</span>


@endif


</p>





<p class="mt-4">

<strong>Reason:</strong>

</p>


<div class="bg-white rounded-xl p-4 mt-2 border">


{{$regulatorReview->reason}}


</div>




<p class="text-sm text-gray-500 mt-4">


Reviewed on:

{{$regulatorReview->created_at->format('M d, Y')}}


</p>




</div>







@else






<form method="POST"

action="{{route('regulator.seller.review',$seller->id)}}">


@csrf





<label class="font-semibold">

Decision

</label>


<select name="is_fair"

class="w-full border rounded-xl p-4 mt-3 mb-5">


<option value="1">

✅ Fair Decision

</option>



<option value="0">

❌ Not Fair

</option>


</select>







<label class="font-semibold">

Reason

</label>


<textarea

name="reason"

required

rows="5"

class="w-full border rounded-xl p-4 mt-3"

placeholder="Explain your assessment..."></textarea>






<button

class="mt-6 bg-gradient-to-r from-indigo-600 to-purple-600

text-white px-10 py-3 rounded-xl font-bold">


Submit Review


</button>



</form>






@endif



</div>

@endsection