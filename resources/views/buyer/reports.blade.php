@extends('layouts.app')

@section('content')


<div class="min-h-screen 
bg-gradient-to-br from-slate-100 via-purple-50 to-red-50 
py-12 px-5">


<div class="max-w-4xl mx-auto">



{{-- SUCCESS MESSAGE --}}

@if(session('success'))

<div class="mb-6 bg-white border-l-4 border-green-500 
rounded-2xl shadow p-5">

<div class="flex gap-4 items-center">


<div class="text-3xl">
✅
</div>


<div>

<h3 class="font-bold text-green-700">
Report Submitted
</h3>


<p class="text-gray-600">
{{session('success')}}
</p>


</div>


</div>

</div>

@endif





{{-- ERROR MESSAGE --}}

@if(session('error'))

<div class="mb-6 bg-white border-l-4 border-red-500 
rounded-2xl shadow p-5">


<div class="flex gap-4 items-center">


<div class="text-3xl">
⚠️
</div>


<p class="text-red-700 font-semibold">

{{session('error')}}

</p>


</div>


</div>


@endif







<!-- MAIN CARD -->


<div class="bg-white rounded-3xl shadow-xl overflow-hidden">






<!-- TOP SECTION -->


<div class="bg-gradient-to-r 
from-red-600 
to-purple-700

p-10 text-white">



<div class="flex items-center gap-5">


<div class="w-16 h-16 
rounded-full 
bg-white/20

flex items-center justify-center

text-4xl">


🚨


</div>




<div>


<h1 class="text-4xl font-bold">

Report Suspicious Seller

</h1>


<p class="mt-2 text-red-100">

Help protect buyers by reporting fraudulent activities.

</p>



</div>


</div>



</div>








<div class="p-8 md:p-10">





<!-- GUIDELINES -->


<div class="bg-gray-50 rounded-2xl p-6 mb-10">


<h2 class="text-xl font-bold text-gray-800 mb-5">

🔒 Before submitting a report

</h2>



<div class="grid md:grid-cols-3 gap-4">



<div class="bg-white rounded-xl p-4 shadow-sm">


<h3 class="font-bold text-red-600">

✓ Be Accurate

</h3>


<p class="text-sm text-gray-600 mt-2">

Only report real suspicious activities.

</p>


</div>





<div class="bg-white rounded-xl p-4 shadow-sm">


<h3 class="font-bold text-purple-600">

✓ Add Evidence

</h3>


<p class="text-sm text-gray-600 mt-2">

Screenshots and proof help investigation.

</p>


</div>





<div class="bg-white rounded-xl p-4 shadow-sm">


<h3 class="font-bold text-blue-600">

✓ Protect Buyers

</h3>


<p class="text-sm text-gray-600 mt-2">

Your report improves marketplace safety.

</p>


</div>



</div>


</div>









<form action="{{route('buyer.reports.store')}}"

method="POST"

enctype="multipart/form-data">


@csrf






<!-- SELLER NAME -->


<div class="mb-6">


<label class="font-semibold text-gray-700">

Seller Name

</label>


<input

type="text"

name="seller_name"

class="mt-2 w-full rounded-xl border-gray-300

p-4 focus:ring-2 focus:ring-red-400"

placeholder="Enter seller name"

required>


</div>









<!-- BRAND NAME -->


<div class="mb-6">


<label class="font-semibold text-gray-700">

Brand / Business Name

</label>


<input

type="text"

name="brand_name"

class="mt-2 w-full rounded-xl border-gray-300

p-4 focus:ring-2 focus:ring-red-400"

placeholder="Enter brand name"

required>


</div>









<!-- SHOP LINK -->


<div class="mb-6">


<label class="font-semibold text-gray-700">

Shop Link

</label>


<input

type="url"

name="shop_link"

class="mt-2 w-full rounded-xl border-gray-300

p-4 focus:ring-2 focus:ring-red-400"

placeholder="https://example.com"

required>


</div>









<!-- DESCRIPTION -->


<div class="mb-6">


<label class="font-semibold text-gray-700">

Explain the problem

</label>


<textarea

name="description"

rows="5"

class="mt-2 w-full rounded-xl border-gray-300

p-4 resize-none focus:ring-2 focus:ring-red-400"


placeholder="Describe what happened..."

required></textarea>



</div>









<!-- EVIDENCE -->


<div class="mb-6 
bg-red-50 rounded-2xl p-6">


<label class="font-semibold text-gray-700">

📎 Upload Evidence

</label>


<input

type="file"

name="evidence"

class="mt-3 w-full bg-white rounded-xl p-3"


accept="image/*,.pdf,.doc,.docx">


<p class="text-sm text-gray-500 mt-2">

Images, PDF and documents accepted.

</p>


</div>









<!-- CONTACT -->


<div class="mb-8">


<label class="font-semibold text-gray-700">

Your Contact

</label>


<input

type="text"

name="contact"

class="mt-2 w-full rounded-xl border-gray-300

p-4 focus:ring-2 focus:ring-red-400"


placeholder="Email or phone number"

required>


</div>








<!-- BUTTON -->


<button

type="submit"

class="w-full py-4 rounded-xl

bg-gradient-to-r from-red-600 to-purple-700

text-white font-bold text-lg

shadow-lg hover:opacity-90 transition">


Submit Fraud Report 🚨


</button>





</form>



</div>



</div>



</div>



</div>


@endsection