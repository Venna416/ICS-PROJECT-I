@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-12">


<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl p-10">



@if(session('success'))

<div class="mb-6 bg-purple-100 text-purple-700 px-6 py-4 rounded-xl">

{{session('success')}}

</div>

@endif




<div class="mb-8">

<h1 class="text-4xl font-bold text-gray-800">

✏️ Edit Verification Decision

</h1>


<p class="text-gray-500 mt-2">

Update seller verification information, scores and decision reason.

</p>


</div>







<!-- Seller Info -->

<div class="bg-gray-50 rounded-2xl p-6 mb-8">


<div class="flex items-center gap-5">


@if($seller->profile_photo)

<img

src="{{asset('storage/'.$seller->profile_photo)}}"

class="w-24 h-24 rounded-full object-cover shadow">


@else


<div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center text-4xl">

👤

</div>


@endif




<div>

<h2 class="text-2xl font-bold">

{{$seller->brand_name}}

</h2>


<p class="text-gray-600">

Owner:
{{$seller->user->name}}

</p>


<p class="text-gray-500">

{{$seller->user->email}}

</p>


</div>


</div>


</div>









<form action="{{route('admin.updateVerification',$seller->id)}}"

method="POST">


@csrf

@method('PUT')





<!-- Status -->

<div class="mb-6">


<label class="font-semibold text-gray-700">

Verification Decision

</label>


<select

name="status"

class="w-full mt-2 border rounded-xl p-3">


<option value="verified"

{{$seller->verification_status=='verified'?'selected':''}}>

✓ Approve Seller

</option>



<option value="rejected"

{{$seller->verification_status=='rejected'?'selected':''}}>

✕ Reject Seller

</option>


</select>


</div>








<!-- Scores -->


<div class="grid md:grid-cols-2 gap-6 mb-6">



<div>


<label class="font-semibold">

Risk Score (1-10)

</label>


<input

type="number"

min="1"

max="10"

name="risk_score"

value="{{$seller->risk_score}}"

class="w-full mt-2 border rounded-xl p-3">


</div>







<div>


<label class="font-semibold">

Trust Score (0-100)

</label>


<input

type="number"

min="0"

max="100"

name="trust_score"

value="{{$seller->trust_score}}"

class="w-full mt-2 border rounded-xl p-3">


</div>



</div>










<!-- Reason -->


<div class="mb-8">


<label class="font-semibold text-gray-700">

Verification Note

</label>



<p class="text-sm text-gray-500 mb-2">

Explain why the seller was approved, rejected, or why risk is high.

</p>



<textarea

name="verification_reason"

rows="5"

class="w-full border rounded-xl p-4"

placeholder="Example: Seller provided valid documents but business details require further review.">{{old('verification_reason',$seller->verification_reason)}}</textarea>



</div>








<button

class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-xl font-bold hover:opacity-90">


💾 Update Verification


</button>





</form>



</div>


</div>



@endsection