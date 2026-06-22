@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-10">


<div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-xl p-10">


<!-- PAGE HEADER -->

<div class="mb-10">

<h1 class="text-4xl font-bold text-gray-800">
🔎 Seller Verification Review
</h1>



</div>







<!-- SELLER PROFILE -->

<div class="bg-gray-50 rounded-2xl p-6 mb-8">


<h2 class="text-2xl font-bold mb-6">
👤 Seller Information
</h2>



<div class="flex items-center gap-6">


@if($seller->profile_photo)

<img 
src="{{asset('storage/'.$seller->profile_photo)}}"
class="w-32 h-32 rounded-full object-cover shadow">

@else

<div class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center text-5xl">

👤

</div>

@endif





<div>

<h3 class="text-2xl font-bold">

{{$seller->brand_name}}

</h3>


<p class="text-gray-600 mt-2">

Owner:
{{$seller->user->name}}

</p>


<p class="text-gray-600">

Email:
{{$seller->user->email}}

</p>


</div>


</div>


</div>









<!-- BUSINESS DETAILS -->


<div class="mb-10">


<h2 class="text-2xl font-bold mb-5">
🏪 Business Information
</h2>



<div class="grid md:grid-cols-2 gap-5">



<div class="bg-blue-50 rounded-xl p-5">

<p class="font-semibold">
Business Category
</p>

<p>
{{$seller->business_category}}
</p>

</div>




<div class="bg-purple-50 rounded-xl p-5">

<p class="font-semibold">
Location
</p>

<p>
{{$seller->location}}
</p>

</div>





<div class="bg-green-50 rounded-xl p-5">

<p class="font-semibold">
Phone Number
</p>

<p>
{{$seller->phone_number}}
</p>

</div>





<div class="bg-pink-50 rounded-xl p-5">

<p class="font-semibold">
Social Platform
</p>

<p>
{{$seller->social_platform}}
</p>

</div>



</div>


</div>










<!-- SHOP VERIFICATION -->


<div class="bg-yellow-50 rounded-2xl p-6 mb-10">


<h2 class="text-2xl font-bold mb-4">

🌐 Online Presence

</h2>



@if($seller->shop_link)


<a

href="{{$seller->shop_link}}"

target="_blank"

class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700">

Visit Seller Shop 🔗

</a>



@else


<p class="text-gray-500">

No shop link provided

</p>


@endif



</div>









<!-- DESCRIPTION -->


<div class="mb-10">


<h2 class="text-2xl font-bold mb-4">

📝 Business Description

</h2>



<div class="bg-gray-50 rounded-xl p-6">


{{$seller->description ?? 'No description provided'}}


</div>


</div>










<!-- DOCUMENTS -->


<div class="mb-10">


<h2 class="text-2xl font-bold mb-5">

📂 Verification Documents

</h2>



<div class="grid md:grid-cols-3 gap-5">





@if($seller->id_front)

<a

href="{{asset('storage/'.$seller->id_front)}}"

target="_blank"

class="bg-blue-100 rounded-xl p-6 text-center hover:shadow">


🪪

<br>

National ID Front


</a>


@endif






@if($seller->id_back)

<a

href="{{asset('storage/'.$seller->id_back)}}"

target="_blank"

class="bg-blue-100 rounded-xl p-6 text-center hover:shadow">


🪪

<br>

National ID Back


</a>


@endif







@foreach($seller->documents as $document)


<a

href="{{asset('storage/'.$document->file_path)}}"

target="_blank"

class="bg-purple-100 rounded-xl p-6 text-center hover:shadow">


📄

<br>


{{$document->document_type}}



</a>


@endforeach




</div>


</div>













<!-- ADMIN DECISION -->


<div class="border-t pt-10">


<div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8">


<h2 class="text-2xl font-bold mb-6">

⚖️ Verification Decision

</h2>




<form

action="{{route('admin.verifySeller',$seller->id)}}"

method="POST">


@csrf





<div class="grid md:grid-cols-3 gap-5 mb-6">



<div>


<label class="block font-semibold mb-2">

Decision

</label>


<select

name="status"

class="w-full border rounded-xl p-3">


<option value="verified">

✅ Approve Seller

</option>


<option value="rejected">

❌ Reject Seller

</option>


</select>


</div>








<div>


<label class="block font-semibold mb-2">

Risk Score (1-10)

</label>


<input

type="number"

name="risk_score"

min="1"

max="10"

required

class="w-full border rounded-xl p-3"

placeholder="3">


</div>









<div>


<label class="block font-semibold mb-2">

Trust Score (0-100)

</label>


<input

type="number"

name="trust_score"

min="0"

max="100"

required

class="w-full border rounded-xl p-3"

placeholder="Example: 85">


</div>



</div>









<!-- REASON BOX -->


<div class="mb-6">


<label class="block font-semibold text-gray-700 mb-2">

📌 Verification Reason

</label>


<p class="text-sm text-gray-500 mb-3">

Explain why this seller was approved, rejected, or given a high risk score.

</p>



<textarea

name="verification_reason"

rows="5"

class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-blue-400"

placeholder="Example: Seller provided valid documents and verified business presence..."></textarea>


</div>







<button

class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-10 py-3 rounded-xl font-semibold hover:opacity-90">


Save Verification


</button>



</form>


</div>


</div>









</div>


</div>


@endsection