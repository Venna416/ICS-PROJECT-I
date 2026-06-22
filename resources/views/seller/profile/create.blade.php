@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-10">


<div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-3xl p-10">


<!-- HEADER -->

<div class="text-center mb-10">


<h1 class="text-4xl font-bold text-gray-800">

🛡️ Seller Verification Application

</h1>


<p class="text-gray-500 mt-3">

Complete your information to become a verified seller.

</p>


</div>





<form action="{{route('seller.profile.store')}}"

method="POST"

enctype="multipart/form-data"

class="space-y-10">


@csrf





<!-- PERSONAL INFORMATION -->


<div class="bg-gray-50 rounded-2xl p-6 border">


<h2 class="text-xl font-bold text-gray-800 mb-5">

👤 Personal Information

</h2>



<div class="grid md:grid-cols-2 gap-6">


<div>


<label class="font-semibold">
Full Name
</label>


<input

type="text"

value="{{Auth::user()->name}}"

readonly

class="mt-2 w-full rounded-xl border-gray-300 bg-gray-100 p-3">


</div>




<div>


<label class="font-semibold">
Email Address
</label>


<input

type="email"

value="{{Auth::user()->email}}"

readonly

class="mt-2 w-full rounded-xl border-gray-300 bg-gray-100 p-3">


</div>


</div>


<p class="text-sm text-gray-500 mt-4">

This information comes from your registered account.

</p>


</div>










<!-- BUSINESS DETAILS -->


<div class="bg-blue-50 rounded-2xl p-6">


<h2 class="text-xl font-bold text-blue-700 mb-5">

🏪 Business Information

</h2>




<div class="grid md:grid-cols-2 gap-6">



<div>

<label class="font-semibold">
Brand Name
</label>


<input

name="brand_name"

placeholder="Example: Maria Fashion"

class="mt-2 w-full rounded-xl border-gray-300 p-3">


</div>





<div>


<label class="font-semibold">
Business Category
</label>


<input

name="category"

placeholder="Clothing, Electronics..."

class="mt-2 w-full rounded-xl border-gray-300 p-3">


</div>






<div>

<label class="font-semibold">
Location
</label>


<input

name="location"

placeholder="Your business location"

class="mt-2 w-full rounded-xl border-gray-300 p-3">


</div>






<div>

<label class="font-semibold">
Phone Number
</label>


<input

name="phone"

placeholder="07xxxxxxxx"

class="mt-2 w-full rounded-xl border-gray-300 p-3">


</div>



</div>


</div>









<!-- ONLINE PRESENCE -->


<div class="bg-purple-50 rounded-2xl p-6">


<h2 class="text-xl font-bold text-purple-700 mb-5">

🌐 Online Presence

</h2>



<div class="space-y-5">


<div>

<label class="font-semibold">
Social Media Platform
</label>


<input

name="social_platform"

placeholder="TikTok, Instagram..."

class="mt-2 w-full rounded-xl border-gray-300 p-3">


</div>





<div>

<label class="font-semibold">
Shop Link

</label>


<input

type="url"

name="shop_link"

placeholder="https://"

class="mt-2 w-full rounded-xl border-gray-300 p-3">


</div>



</div>


</div>









<!-- DOCUMENTS -->


<div class="bg-green-50 rounded-2xl p-6">


<h2 class="text-xl font-bold text-green-700 mb-5">

🪪 Identity Verification

</h2>



<div class="grid md:grid-cols-3 gap-5">



<div class="bg-white p-4 rounded-xl border">


<label class="font-semibold">

Profile Photo

</label>


<input

type="file"

name="profile_photo"

class="mt-3 w-full">


</div>






<div class="bg-white p-4 rounded-xl border">


<label>

National ID Front

</label>


<input

type="file"

name="id_front"

class="mt-3 w-full">


</div>






<div class="bg-white p-4 rounded-xl border">


<label>

National ID Back

</label>


<input

type="file"

name="id_back"

class="mt-3 w-full">


</div>



</div>


</div>









<!-- EXTRA DOCUMENTS -->


<div class="bg-pink-50 rounded-2xl p-6">


<h2 class="text-xl font-bold text-pink-700">

📂 Supporting Evidence

</h2>


<p class="text-gray-600 text-sm mt-2">

Upload extra proof that your business is legitimate.

Examples:
Business license, shop photos, certificates.

</p>




<input

type="file"

name="documents[]"

multiple

class="mt-5 w-full bg-white border-2 border-dashed rounded-xl p-4">



</div>









<!-- DESCRIPTION -->


<div>


<label class="font-semibold">

About Your Business

</label>


<textarea

name="description"

rows="5"

placeholder="Describe your business..."

class="mt-3 w-full rounded-xl border-gray-300 p-4">

</textarea>


</div>








<button

class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-2xl shadow-lg hover:scale-105 transition">


Submit Verification Request 🚀


</button>





</form>


</div>


</div>


@endsection