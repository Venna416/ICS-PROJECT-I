@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-slate-100 p-8">


<div class="max-w-5xl mx-auto">





<!-- HEADER -->

<div class="bg-gradient-to-r from-red-600 to-orange-600 
rounded-3xl shadow-xl p-10 text-white mb-8">


<h1 class="text-4xl font-bold">

🔎 Fraud Investigation

</h1>


<p class="mt-3 text-red-100">

Review buyer complaints and make compliance decisions.

</p>


</div>








<!-- REPORT DETAILS -->


<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">



<h2 class="text-2xl font-bold mb-6">

📄 Report Details

</h2>





<div class="grid md:grid-cols-2 gap-6">



<div class="bg-slate-50 p-5 rounded-2xl">


<p class="text-gray-500">

Buyer

</p>


<h3 class="font-bold text-lg">

{{ $report->user->name ?? 'Unknown' }}

</h3>


</div>






<div class="bg-slate-50 p-5 rounded-2xl">


<p class="text-gray-500">

Seller / Brand

</p>


<h3 class="font-bold text-lg">

{{ $report->brand_name }}

</h3>


</div>





<div class="bg-slate-50 p-5 rounded-2xl">


<p class="text-gray-500">

Seller Name

</p>


<h3 class="font-bold text-lg">

{{ $report->seller_name }}

</h3>


</div>






<div class="bg-slate-50 p-5 rounded-2xl">


<p class="text-gray-500">

Contact

</p>


<h3 class="font-bold text-lg">

{{ $report->contact ?? 'Not provided' }}

</h3>


</div>




</div>









<!-- COMPLAINT -->


<div class="mt-8 bg-red-50 p-6 rounded-2xl">


<h3 class="font-bold text-red-700 mb-3">

🚨 Buyer Complaint

</h3>



<p class="text-gray-700">

{{ $report->description }}

</p>



</div>









<!-- EVIDENCE -->


@if($report->evidence)


<div class="mt-6">


<h3 class="font-bold mb-3">

📎 Evidence Submitted

</h3>



<a href="{{asset('storage/'.$report->evidence)}}"

target="_blank"

class="inline-block bg-blue-600 text-white px-6 py-3 rounded-xl">


View Evidence

</a>



</div>


@endif





</div>













<!-- ALREADY REVIEWED -->

@if($report->reviewed)



<div class="bg-green-50 border border-green-200 rounded-3xl p-8">



<h2 class="text-3xl font-bold text-green-700">

✅ Investigation Completed

</h2>




<div class="mt-6 space-y-4 text-gray-700">



<p>

<b>Decision:</b>

{{ $report->decision }}

</p>




<p>

<b>Action Taken:</b>

{{ $report->action_taken }}

</p>





<p>

<b>Regulator Notes:</b>

{{ $report->regulator_note }}

</p>




</div>





<a href="{{route('regulator.reports')}}"

class="inline-block mt-8 bg-gray-700 text-white px-6 py-3 rounded-xl">


Back To Reports

</a>



</div>









@else







<!-- INVESTIGATION FORM -->


<div class="bg-white rounded-3xl shadow-xl p-8">


<h2 class="text-2xl font-bold mb-6">

⚖️ Make Decision

</h2>





<form method="POST"

action="{{route('regulator.reports.update',$report->id)}}">


@csrf

@method('PUT')







<label class="font-bold">

Decision

</label>


<select name="decision"

class="w-full mt-2 mb-6 p-4 border rounded-xl"

required>


<option value="Fraud Confirmed">

Fraud Confirmed

</option>



<option value="Not Proven">

Not Proven

</option>




<option value="False Report">

False Report

</option>


</select>









<label class="font-bold">

Action Taken

</label>


<select name="action_taken"

class="w-full mt-2 mb-6 p-4 border rounded-xl"

required>



<option value="Seller Warned">

Seller Warned

</option>



<option value="Suspend Seller">

Suspend Seller

</option>



<option value="No Action">

No Action

</option>



</select>









<label class="font-bold">

Investigation Notes

</label>


<textarea

name="regulator_note"

rows="5"

class="w-full mt-2 p-4 border rounded-xl"

placeholder="Explain your decision..."

required></textarea>









<button

class="mt-6 bg-green-600 hover:bg-green-700

text-white px-8 py-3 rounded-xl font-bold">


Submit Investigation


</button>




</form>



</div>





@endif








</div>


</div>



@endsection