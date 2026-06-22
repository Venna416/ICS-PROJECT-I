@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-10">


<div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl p-10">


<h1 class="text-3xl font-bold text-center text-gray-800 mb-10">

✏️ Update Seller Verification Profile

</h1>





<form action="{{route('seller.profile.update',$profile->id)}}"

method="POST"

enctype="multipart/form-data"

class="space-y-10">


@csrf

@method('PUT')






<!-- PERSONAL INFO -->

<div class="bg-gray-50 p-6 rounded-2xl border">


<h2 class="text-xl font-bold mb-5">

👤 Account Information

</h2>



<div class="grid md:grid-cols-2 gap-5">


<div>

<label class="font-semibold">
Name
</label>


<input

value="{{Auth::user()->name}}"

readonly

class="mt-2 w-full bg-gray-100 rounded-xl p-3 border">


</div>





<div>

<label class="font-semibold">
Email
</label>


<input

value="{{Auth::user()->email}}"

readonly

class="mt-2 w-full bg-gray-100 rounded-xl p-3 border">


</div>


</div>


</div>









<!-- BUSINESS -->

<div class="bg-blue-50 p-6 rounded-2xl">


<h2 class="text-xl font-bold text-blue-700 mb-5">

🏪 Business Information

</h2>




<div class="grid md:grid-cols-2 gap-5">



<div>

<label>
Brand Name
</label>


<input

name="brand_name"

value="{{$profile->brand_name}}"

class="mt-2 w-full rounded-xl p-3 border">


</div>




<div>

<label>
Business Category
</label>


<input

name="business_category"

value="{{$profile->business_category}}"

class="mt-2 w-full rounded-xl p-3 border">


</div>





<div>

<label>
Location
</label>


<input

name="location"

value="{{$profile->location}}"

class="mt-2 w-full rounded-xl p-3 border">


</div>




<div>

<label>
Phone Number
</label>


<input

name="phone_number"

value="{{$profile->phone_number}}"

class="mt-2 w-full rounded-xl p-3 border">


</div>



</div>



</div>









<!-- ONLINE -->


<div class="bg-purple-50 p-6 rounded-2xl">


<h2 class="text-xl font-bold text-purple-700 mb-5">

🌐 Online Presence

</h2>


<div class="space-y-5">


<input

name="social_platform"

value="{{$profile->social_platform}}"

placeholder="Social media"

class="w-full rounded-xl border p-3">



<input

name="shop_link"

value="{{$profile->shop_link}}"

placeholder="Shop link"

class="w-full rounded-xl border p-3">


</div>


</div>









<!-- DOCUMENTS -->


<div class="bg-green-50 p-6 rounded-2xl">


<h2 class="text-xl font-bold text-green-700 mb-5">

🪪 Update Documents

</h2>



<div class="grid md:grid-cols-3 gap-5">


<div>

<label>
Profile Photo
</label>

<input type="file"

name="profile_photo"

class="mt-2 w-full">

</div>





<div>

<label>
ID Front
</label>


<input type="file"

name="id_front"

class="mt-2 w-full">

</div>





<div>

<label>
ID Back
</label>


<input type="file"

name="id_back"

class="mt-2 w-full">

</div>


</div>


</div>









<!-- EXTRA -->

<div class="bg-pink-50 p-6 rounded-2xl">


<h2 class="font-bold text-xl text-pink-700">

📂 Add More Evidence

</h2>


<input

type="file"

name="documents[]"

multiple

class="mt-4 w-full border rounded-xl p-3">


</div>









<div>


<label class="font-semibold">

Business Description

</label>


<textarea

name="description"

rows="5"

class="mt-3 w-full border rounded-xl p-4">


{{$profile->description}}


</textarea>


</div>









<button

class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-2xl font-bold">


💾 Save Changes


</button>



</form>



</div>


</div>


@endsection