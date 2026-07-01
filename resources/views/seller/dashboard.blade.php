@extends('layouts.app')


@section('content')


<div class="min-h-screen 
bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 
p-8">


<div class="max-w-7xl mx-auto">






<!-- HEADER -->


<div class="bg-gradient-to-r 
from-blue-700 
via-indigo-700 
to-purple-700

rounded-3xl 
shadow-2xl 
p-10 
text-white 
mb-10">


<div class="flex flex-col md:flex-row justify-between items-center gap-8">





<div>


<h1 class="text-4xl md:text-5xl font-extrabold">

🏪 {{ $sellerProfile->brand_name ?? 'Seller Dashboard' }}

</h1>



<p class="mt-4 text-blue-100 text-lg">

Manage your verification status, business reputation,
customer feedback and marketplace activity.

</p>




<div class="flex gap-4 mt-6">


<span class="bg-white/20 px-5 py-2 rounded-full backdrop-blur">

🛡️ Verification

</span>



<span class="bg-white/20 px-5 py-2 rounded-full backdrop-blur">

⭐ Reputation

</span>


</div>




</div>









<!-- NOTIFICATION -->


<div class="relative">



<button

onclick="toggleNotifications()"

class="relative bg-white/20 backdrop-blur-md

p-5 rounded-full

text-4xl

hover:bg-white/30

transition

shadow-lg">



🔔





@if(auth()->user()->unreadNotifications->count() > 0)


<span

class="absolute -top-2 -right-2

bg-red-600

text-white

font-bold

text-xs

w-7 h-7

rounded-full

flex items-center justify-center">


{{auth()->user()->unreadNotifications->count()}}


</span>


@endif





</button>









<div id="notificationBox"


class="hidden absolute right-0 mt-5

w-96

bg-white

rounded-3xl

shadow-2xl

border

p-5

text-gray-800

z-50">





<h2 class="font-bold text-xl mb-5">

🔔 Notifications

</h2>






<div class="max-h-96 overflow-y-auto">



@forelse(auth()->user()->unreadNotifications as $notification)



<a href="{{route('notifications.read',$notification->id)}}"


class="block bg-blue-50

rounded-2xl

p-4

mb-3

hover:bg-blue-100

transition">



<h3 class="font-bold text-indigo-700">

{{$notification->data['title']}}

</h3>



<p class="text-sm text-gray-600 mt-2">

{{$notification->data['message']}}

</p>


<p class="text-xs text-gray-400 mt-2">

{{$notification->created_at->diffForHumans()}}

</p>



</a>



@empty



<p class="text-gray-500 text-center py-5">

No new notifications

</p>



@endforelse



</div>








<form method="POST"

action="{{route('notifications.read.all')}}">


@csrf



<button

class="mt-4 w-full

bg-indigo-600

text-white

py-3

rounded-xl

font-semibold

hover:bg-indigo-700

transition">


✓ Mark all as read


</button>



</form>







</div>




</div>





</div>


</div>












<!-- SCORE CARDS -->


<div class="grid md:grid-cols-3 gap-8 mb-10">







<!-- STATUS -->


<div class="bg-white rounded-3xl shadow-xl p-8 border">


<p class="text-gray-500 font-semibold">

Verification Status

</p>



@if($sellerProfile->verification_status == 'verified')


<h2 class="text-3xl font-bold text-green-600 mt-5">

✓ Verified

</h2>



@elseif($sellerProfile->verification_status == 'rejected')


<h2 class="text-3xl font-bold text-red-600 mt-5">

✕ Rejected

</h2>



@else


<h2 class="text-3xl font-bold text-yellow-600 mt-5">

⏳ Pending

</h2>



@endif



</div>









<!-- TRUST -->


<div class="bg-white rounded-3xl shadow-xl p-8 border">


<p class="text-gray-500 font-semibold">

⭐ Trust Score

</p>



<h2 class="text-5xl font-bold text-purple-600 mt-5">

{{$trustScore ?? 0}}%

</h2>




@if(($trustScore ?? 0)>=70)


<span class="inline-block mt-4 px-5 py-2 rounded-full bg-green-100 text-green-700 font-bold">

High Trust

</span>



@elseif(($trustScore ?? 0)>=40)


<span class="inline-block mt-4 px-5 py-2 rounded-full bg-yellow-100 text-yellow-700 font-bold">

Medium Trust

</span>



@else


<span class="inline-block mt-4 px-5 py-2 rounded-full bg-red-100 text-red-700 font-bold">

Low Trust

</span>



@endif



</div>









<!-- RISK -->


<div class="bg-white rounded-3xl shadow-xl p-8 border">


<p class="text-gray-500 font-semibold">

⚠ Risk Score

</p>



<h2 class="text-5xl font-bold text-red-600 mt-5">

{{$riskScore ?? 0}}/10

</h2>




@if(($riskScore ?? 0)<=3)


<span class="inline-block mt-4 px-5 py-2 rounded-full bg-green-100 text-green-700 font-bold">

🟢 Low Risk

</span>



@elseif(($riskScore ?? 0)<=6)


<span class="inline-block mt-4 px-5 py-2 rounded-full bg-yellow-100 text-yellow-700 font-bold">

🟡 Medium Risk

</span>



@else


<span class="inline-block mt-4 px-5 py-2 rounded-full bg-red-100 text-red-700 font-bold">

🔴 High Risk

</span>



@endif



</div>





</div>









<!-- FEEDBACK -->


<div class="bg-white rounded-3xl shadow-xl p-8 mb-10">


<h2 class="text-2xl font-bold">

📌 Verification Feedback

</h2>



<div class="mt-5 bg-indigo-50 rounded-2xl p-6">


<p class="text-gray-700">


{{$sellerProfile->verification_reason ?? 'Waiting for admin verification.'}}


</p>


</div>


</div>









<!-- ACTIVITY -->


<div class="grid md:grid-cols-2 gap-8 mb-10">



<a href="{{route('seller.reviews')}}"


class="bg-white rounded-3xl shadow-xl p-8 hover:-translate-y-2 transition">


<h2 class="text-2xl font-bold">

⭐ Buyer Reviews

</h2>



<p class="text-6xl font-bold text-purple-600 mt-6">

{{$reviewCount}}

</p>


<p class="text-gray-500 mt-3">

Customer feedback received.

</p>



</a>









<div class="bg-white rounded-3xl shadow-xl p-8">


<h2 class="text-2xl font-bold">

🚨 Fraud Reports

</h2>



<p class="text-6xl font-bold text-red-600 mt-6">

{{$fraudCount}}

</p>



<p class="text-gray-500 mt-3">

Reports connected to your business.

</p>


</div>





</div>









<!-- PROFILE -->


<div class="bg-white rounded-3xl shadow-xl p-8">


<h2 class="text-2xl font-bold">

👤 Business Profile

</h2>



<p class="text-gray-500 mt-3">

Manage your business information and verification documents.

</p>



<a href="{{route('seller.profile.show',$sellerProfile->id)}}"


class="inline-block mt-6

bg-gradient-to-r

from-blue-600

to-purple-600

text-white

px-8 py-3

rounded-xl

font-bold

hover:scale-105

transition">


View Profile →

</a>




</div>









</div>


</div>









<script>


function toggleNotifications(){


document

.getElementById('notificationBox')

.classList

.toggle('hidden');


}


</script>



@endsection