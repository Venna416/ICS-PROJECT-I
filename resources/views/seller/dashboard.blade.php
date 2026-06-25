@extends('layouts.app')


@section('content')


<div class="min-h-screen 
bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 
p-8">


<div class="max-w-7xl mx-auto">





<!-- HEADER -->

<div class="bg-gradient-to-r from-blue-700 via-purple-700 to-indigo-700

rounded-3xl shadow-xl p-10 text-white mb-8">


<div class="flex justify-between items-center">



<div>

<h1 class="text-4xl font-bold">

🏪 Seller Dashboard

</h1>


<p class="mt-3 text-blue-100">

Manage your verification, reputation and business activity.

</p>


</div>







<!-- NOTIFICATION -->

<div class="relative">


<button

onclick="toggleNotifications()"

class="relative bg-white/20 backdrop-blur

p-4 rounded-full

text-3xl

hover:bg-white/30">


🔔



@if(auth()->user()->unreadNotifications->count() > 0)


<span class="absolute -top-2 -right-2

bg-red-600

text-white

font-bold

text-xs

w-6 h-6

rounded-full

flex items-center justify-center">


{{auth()->user()->unreadNotifications->count()}}


</span>


@endif


</button>







<div id="notificationBox"

class="hidden absolute right-0 mt-4

w-96

bg-white

rounded-3xl

shadow-2xl

p-5

text-gray-800

z-50">



<h2 class="font-bold text-xl mb-4">

🔔 Notifications

</h2>





@forelse(auth()->user()->unreadNotifications as $notification)


<a href="{{route('notifications.read',$notification->id)}}"

class="block bg-blue-50

rounded-2xl

p-4

mb-3

hover:bg-blue-100">



<h3 class="font-bold">

{{$notification->data['title']}}

</h3>


<p class="text-sm text-gray-600 mt-2">

{{$notification->data['message']}}

</p>



</a>



@empty


<p class="text-gray-500">

No new notifications

</p>



@endforelse



</div>





</div>



</div>


</div>









<!-- SCORE CARDS -->


<div class="grid md:grid-cols-3 gap-6 mb-8">





<!-- STATUS -->

<div class="bg-white rounded-3xl shadow-lg p-7">


<p class="text-gray-500">

Verification Status

</p>



@if($sellerProfile->verification_status == 'verified')


<h2 class="text-3xl font-bold text-green-600 mt-4">

✓ Verified

</h2>



@elseif($sellerProfile->verification_status == 'rejected')


<h2 class="text-3xl font-bold text-red-600 mt-4">

✕ Rejected

</h2>



@else


<h2 class="text-3xl font-bold text-yellow-600 mt-4">

⏳ Pending

</h2>



@endif


</div>









<!-- TRUST -->

<div class="bg-white rounded-3xl shadow-lg p-7">


<p class="text-gray-500">

⭐ Trust Score

</p>


<h2 class="text-5xl font-bold text-purple-600 mt-4">

{{$trustScore ?? 0}}%

</h2>



@if(($trustScore ?? 0) >= 70)


<span class="inline-block mt-3

px-4 py-2

rounded-full

bg-green-100

text-green-700

font-bold">


High Trust


</span>



@elseif(($trustScore ?? 0) >=40)


<span class="inline-block mt-3

px-4 py-2

rounded-full

bg-yellow-100

text-yellow-700

font-bold">


Medium Trust


</span>



@else


<span class="inline-block mt-3

px-4 py-2

rounded-full

bg-red-100

text-red-700

font-bold">


Low Trust


</span>



@endif


</div>









<!-- RISK -->

<div class="bg-white rounded-3xl shadow-lg p-7">


<p class="text-gray-500">

⚠ Risk Score

</p>


<h2 class="text-5xl font-bold text-red-600 mt-4">


{{$riskScore ?? 0}}/10


</h2>





@if(($riskScore ?? 0) <= 3)


<span class="inline-block mt-3

px-4 py-2

rounded-full

bg-green-100

text-green-700

font-bold">


🟢 Low Risk


</span>



@elseif(($riskScore ?? 0) <=6)


<span class="inline-block mt-3

px-4 py-2

rounded-full

bg-yellow-100

text-yellow-700

font-bold">


🟡 Medium Risk


</span>




@else


<span class="inline-block mt-3

px-4 py-2

rounded-full

bg-red-100

text-red-700

font-bold">


🔴 High Risk


</span>



@endif



</div>







</div>









<!-- FEEDBACK -->


<div class="bg-white rounded-3xl shadow-lg p-8 mb-8">


<h2 class="text-2xl font-bold mb-5">

📌 Verification Feedback

</h2>



<div class="bg-purple-50 rounded-2xl p-6">


<p class="text-gray-700">


{{$sellerProfile->verification_reason 
?? 
'Waiting for admin verification.'}}


</p>


</div>


</div>









<!-- ACTIVITY -->


<div class="grid md:grid-cols-2 gap-8 mb-8">





<a href="{{route('seller.reviews')}}"

class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl">


<h2 class="text-2xl font-bold">

⭐ Buyer Reviews

</h2>


<p class="text-6xl font-bold text-purple-600 mt-5">

{{$reviewCount}}

</p>


<p class="text-gray-500 mt-3">

Customer feedback received.

</p>


</a>







<div class="bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-2xl font-bold">

🚨 Fraud Reports

</h2>


<p class="text-6xl font-bold text-red-600 mt-5">

{{$fraudCount}}

</p>


<p class="text-gray-500 mt-3">

Reports associated with your business.

</p>


</div>





</div>









<!-- PROFILE -->


<div class="bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-2xl font-bold">

👤 Business Profile

</h2>


<p class="text-gray-500 mt-2">

Manage your business details and documents.

</p>




<a href="{{route('seller.profile.show',$sellerProfile->id)}}"


class="inline-block mt-6

bg-gradient-to-r

from-blue-600

to-purple-600

text-white

px-8 py-3

rounded-xl

font-bold">


View Profile


</a>


</div>







</div>


</div>






<script>


function toggleNotifications(){


let box = document.getElementById('notificationBox');


box.classList.toggle('hidden');


}


</script>



@endsection