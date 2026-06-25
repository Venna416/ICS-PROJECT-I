@extends('layouts.app')


@section('content')


<div class="min-h-screen 
bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 
p-10">


<div class="max-w-6xl mx-auto">



<!-- HEADER -->

<div class="bg-gradient-to-r from-blue-700 to-purple-700 
rounded-3xl shadow-xl p-8 text-white mb-8">


<h1 class="text-4xl font-bold">

🔐 Seller Verification Assessment

</h1>


<p class="mt-3 text-blue-100">

Edit verification factors. Existing assessment choices are already selected.

</p>


</div>









<!-- SELLER -->

<div class="bg-white rounded-3xl shadow-lg p-8 mb-8">


<h2 class="text-2xl font-bold mb-5">

👤 Seller

</h2>



<div class="flex items-center gap-5">


<div class="w-20 h-20 rounded-full bg-blue-100 
flex items-center justify-center text-4xl">

🏪

</div>



<div>


<h3 class="text-2xl font-bold">

{{$seller->brand_name}}

</h3>


<p class="text-gray-500">

{{$seller->user->name}}

</p>


</div>



</div>


</div>









<!-- SCORE -->


<div class="grid md:grid-cols-3 gap-6 mb-8">



<div class="bg-blue-50 rounded-3xl p-6">

<h3 class="font-bold text-blue-700">

⭐ Trust Score

</h3>


<p class="text-4xl font-bold mt-3">

{{$seller->trust_score ?? 0}}%

</p>


</div>






<div class="bg-red-50 rounded-3xl p-6">

<h3 class="font-bold text-red-700">

⚠ Risk Score

</h3>


<p class="text-4xl font-bold mt-3">

{{$seller->risk_score ?? 0}}/10

</p>


</div>






<div class="bg-green-50 rounded-3xl p-6">

<h3 class="font-bold text-green-700">

Status

</h3>


<p class="text-2xl font-bold mt-3">


{{$seller->verification_status}}


</p>


</div>




</div>









<form method="POST"

action="{{route('admin.updateVerification',$seller->id)}}">


@csrf

@method('PUT')








<div class="grid md:grid-cols-2 gap-8">







<!-- TRUST -->

<div class="bg-blue-50 rounded-3xl p-8">


<h2 class="text-2xl font-bold text-blue-700 mb-6">

⭐ Trust Factors

</h2>







<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="valid_documents"

value="1"

class="w-5 h-5"


{{ $seller->valid_documents ? 'checked' : '' }}

>


Valid documents (+20)


</label>







<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="complete_profile"

value="1"

class="w-5 h-5"


{{ $seller->complete_profile ? 'checked' : '' }}

>


Complete seller profile (+10)


</label>








<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="business_license"

value="1"

class="w-5 h-5"


{{ $seller->business_license ? 'checked' : '' }}

>


Business license verified (+20)


</label>








<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="good_reviews"

value="1"

class="w-5 h-5"


{{ $seller->good_reviews ? 'checked' : '' }}

>


3+ reviews with average 4+ stars (+20)


</label>








<label class="flex items-center gap-3">


<input

type="checkbox"

name="limited_reviews"

value="1"

class="w-5 h-5"


{{ $seller->limited_reviews ? 'checked' : '' }}

>


Limited reviews / below 4 stars (+10)


</label>





</div>









<!-- RISK -->

<div class="bg-red-50 rounded-3xl p-8">


<h2 class="text-2xl font-bold text-red-700 mb-6">

⚠ Risk Factors

</h2>







<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="missing_documents"

value="1"

class="w-5 h-5"


{{ $seller->missing_documents ? 'checked' : '' }}

>


Missing documents (+3)


</label>








<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="fraud_reports"

value="1"

class="w-5 h-5"


{{ $seller->fraud_reports ? 'checked' : '' }}

>


Fraud reports received (+4)


</label>








<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="poor_reviews"

value="1"

class="w-5 h-5"


{{ $seller->poor_reviews ? 'checked' : '' }}

>


Poor customer reviews (+2)


</label>








<label class="flex items-center gap-3">


<input

type="checkbox"

name="incomplete_information"

value="1"

class="w-5 h-5"


{{ $seller->incomplete_information ? 'checked' : '' }}

>


Incomplete business information (+2)


</label>






</div>






</div>









<!-- REASON -->

<div class="mt-8 bg-yellow-50 rounded-3xl p-6">


<h2 class="font-bold text-xl">

📌 Current System Reason

</h2>


<p class="mt-3 text-gray-700">


{{$seller->verification_reason ?? 'No verification completed yet.'}}


</p>


</div>









<button

type="submit"

class="mt-10 w-full py-4 rounded-2xl

bg-gradient-to-r from-blue-600 to-purple-600

text-white font-bold text-lg shadow-lg">


Update Verification


</button>







</form>





</div>


</div>


@endsection