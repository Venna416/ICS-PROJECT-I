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

Update verification factors. Previous selections are already saved.

</p>


</div>








<!-- SELLER INFO -->


<div class="bg-white rounded-3xl shadow-lg p-8 mb-8">


<h2 class="text-2xl font-bold mb-5">

👤 Seller Information

</h2>



<div class="flex items-center gap-5">


<div class="w-20 h-20 rounded-full 
bg-blue-100 flex items-center justify-center text-4xl">


🏪


</div>




<div>


<h3 class="text-2xl font-bold">

{{$seller->brand_name}}

</h3>


<p class="text-gray-500">

{{$seller->user->name}}

</p>


<p class="text-sm text-gray-400">

{{$seller->user->email}}

</p>


</div>



</div>


</div>









<!-- SCORES -->


<div class="grid md:grid-cols-3 gap-6 mb-8">


<div class="bg-blue-50 rounded-3xl p-6">


<h3 class="font-bold text-blue-700">

⭐ Trust Score

</h3>


<p class="text-4xl font-bold mt-3">

{{$seller->trust_score ?? 0}}

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

{{ucfirst($seller->verification_status)}}

</p>


</div>


</div>










<!-- FORM -->


<form method="POST"

action="{{route('admin.updateVerification',$seller->id)}}">


@csrf

@method('PUT')


{{-- remembers where admin came from --}}

<input

type="hidden"

name="from"

value="{{request('from')}}"

>







<div class="grid md:grid-cols-2 gap-8">







<!-- TRUST FACTORS -->


<div class="bg-blue-50 rounded-3xl p-8">


<h2 class="text-2xl font-bold text-blue-700 mb-6">

⭐ Trust Factors

</h2>






@php

$trustFactors = [

'valid_documents'=>'Valid documents (+20)',

'complete_profile'=>'Complete seller profile (+10)',

'business_license'=>'Business license verified (+20)',

'good_reviews'=>'3+ reviews with average 4+ stars (+20)',

'limited_reviews'=>'Limited reviews / below 4 stars (+10)'

];

@endphp






@foreach($trustFactors as $field=>$label)


<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="{{$field}}"

value="1"

class="w-5 h-5"


@if($seller->$field)

checked

@endif

>


{{$label}}



</label>


@endforeach




</div>









<!-- RISK FACTORS -->


<div class="bg-red-50 rounded-3xl p-8">


<h2 class="text-2xl font-bold text-red-700 mb-6">

⚠ Risk Factors

</h2>





@php

$riskFactors=[


'missing_documents'=>'Missing documents (+3)',

'fraud_reports'=>'Fraud reports received (+4)',

'poor_reviews'=>'Poor customer reviews (+2)',

'incomplete_information'=>'Incomplete business information (+2)'


];


@endphp







@foreach($riskFactors as $field=>$label)



<label class="flex items-center gap-3 mb-5">


<input

type="checkbox"

name="{{$field}}"

value="1"

class="w-5 h-5"


@if($seller->$field)

checked

@endif

>


{{$label}}



</label>



@endforeach





</div>






</div>









<!-- OLD REASON -->


<div class="mt-8 bg-yellow-50 rounded-3xl p-6">


<h2 class="font-bold text-xl">

📌 Previous Decision Reason

</h2>


<p class="mt-3 text-gray-700">


{{$seller->verification_reason ?? 'No previous decision.'}}


</p>



</div>









<button

type="submit"

class="mt-10 w-full py-4 rounded-2xl

bg-gradient-to-r from-blue-600 to-purple-600

text-white font-bold text-lg shadow-lg

hover:scale-105 transition">


Save Verification Decision 🚀


</button>







</form>







</div>


</div>



@endsection