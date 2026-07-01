@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-8">


<div class="max-w-7xl mx-auto">


{{-- HEADER --}}

<div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6

bg-white rounded-3xl shadow-lg border border-slate-200 p-8">


{{-- TITLE --}}

<div>


<div class="flex items-center gap-3">


<div class="w-14 h-14 rounded-2xl 

bg-gradient-to-br from-indigo-600 to-blue-600

flex items-center justify-center text-3xl shadow-lg">


🛡️


</div>




<div>


<h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">

Marketplace Compliance Center

</h1>



<p class="text-gray-500 mt-1">

Monitor seller verification, buyer feedback, fraud reports and platform safety.

</p>


</div>



</div>



</div>






{{-- NOTIFICATION BELL --}}


<div class="relative">



<button

onclick="document.getElementById('notificationBox').classList.toggle('hidden')"


class="relative group

w-14 h-14

bg-gradient-to-br from-indigo-600 to-blue-600

rounded-2xl

text-white

text-2xl

shadow-lg

hover:scale-105

transition">


🔔





@if(Auth::user()->unreadNotifications->count() > 0)


<span class="absolute -top-2 -right-2

bg-red-600

text-white

text-xs

font-bold

w-7 h-7

rounded-full

flex items-center justify-center

border-4 border-white">


{{Auth::user()->unreadNotifications->count()}}


</span>


@endif



</button>









{{-- DROPDOWN --}}


<div id="notificationBox"


class="hidden absolute right-0 mt-4

w-96

bg-white

rounded-3xl

shadow-2xl

border border-gray-100

overflow-hidden

z-50">






<div class="bg-gradient-to-r from-indigo-600 to-blue-600

p-5 text-white">


<h2 class="text-lg font-bold flex items-center gap-2">


🔔 Notifications


</h2>


<p class="text-sm text-indigo-100 mt-1">

Latest compliance activities

</p>


</div>








<div class="max-h-96 overflow-y-auto">





@forelse(Auth::user()->unreadNotifications as $notification)



<div class="p-5 border-b hover:bg-indigo-50 transition">


<div class="flex gap-3">


<div class="text-2xl">


@if(str_contains($notification->data['title'],'Fraud'))

🚨

@elseif(str_contains($notification->data['title'],'Review'))

⭐

@elseif(str_contains($notification->data['title'],'Seller'))

🏪

@else

🔔

@endif


</div>





<div>


<h3 class="font-bold text-gray-800">


{{$notification->data['title'] ?? 'Notification'}}


</h3>




<p class="text-sm text-gray-600 mt-1">


{{$notification->data['message'] ?? ''}}


</p>



<p class="text-xs text-gray-400 mt-2">


{{$notification->created_at->diffForHumans()}}


</p>



</div>



</div>



</div>





@empty


<div class="p-8 text-center text-gray-400">


<div class="text-4xl mb-2">

🎉

</div>


No new notifications


</div>



@endforelse





</div>







<form method="POST"

action="{{route('notifications.read.all')}}">


@csrf



<button


class="w-full p-4

text-indigo-600

font-semibold

hover:bg-indigo-50

transition">


Mark all notifications as read


</button>



</form>







</div>





</div>






</div>











{{-- STATISTICS --}}


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">



<div class="bg-white rounded-3xl shadow p-6 border-t-4 border-blue-600">

<p class="text-gray-500">
👥 Total Sellers
</p>

<h2 class="text-4xl font-bold text-blue-600">

{{$totalSellers}}

</h2>


</div>






<div class="bg-white rounded-3xl shadow p-6 border-t-4 border-green-600">


<p class="text-gray-500">
✅ Verified Sellers
</p>


<h2 class="text-4xl font-bold text-green-600">

{{$verifiedSellers}}

</h2>


</div>







<div class="bg-white rounded-3xl shadow p-6 border-t-4 border-yellow-500">


<p class="text-gray-500">
⏳ Pending Sellers
</p>


<h2 class="text-4xl font-bold text-yellow-500">

{{$pendingSellers}}

</h2>


</div>







<div class="bg-white rounded-3xl shadow p-6 border-t-4 border-red-600">


<p class="text-gray-500">
❌ Rejected Sellers
</p>


<h2 class="text-4xl font-bold text-red-600">

{{$rejectedSellers}}

</h2>


</div>



</div>









<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">



<div class="bg-white rounded-3xl shadow p-6">

<h3 class="font-bold text-purple-600">

⭐ Reviews

</h3>


<p class="text-4xl font-bold">

{{$totalReviews}}

</p>


</div>





<div class="bg-white rounded-3xl shadow p-6">


<h3 class="font-bold text-indigo-600">

📝 Pending Reviews

</h3>


<p class="text-4xl font-bold">

{{$pendingReviews}}

</p>


</div>







<div class="bg-white rounded-3xl shadow p-6">


<h3 class="font-bold text-red-600">

🚨 Fraud Reports

</h3>


<p class="text-4xl font-bold">

{{$totalFraudReports}}

</p>


</div>




</div>











{{-- MODULES --}}


<h2 class="text-2xl font-bold mb-6 text-gray-800">

Compliance Management

</h2>





<div class="grid md:grid-cols-3 gap-8">





<div class="bg-white rounded-3xl shadow-lg p-8">


<div class="text-5xl mb-5">
🏪
</div>


<h3 class="text-xl font-bold">

Seller Monitoring

</h3>


<p class="text-gray-500 mt-3">

Review seller profiles and verification decisions.

</p>



<a href="{{route('regulator.sellers')}}"

class="block mt-6 text-center bg-indigo-600 text-white py-3 rounded-xl">


View Sellers


</a>


</div>







<div class="bg-white rounded-3xl shadow-lg p-8">


<div class="text-5xl mb-5">

⭐

</div>



<h3 class="text-xl font-bold">

Review Monitoring

</h3>


<p class="text-gray-500 mt-3">

Check fake, offensive or suspicious buyer reviews.

</p>




<a href="{{route('regulator.reviews')}}"

class="block mt-6 text-center bg-purple-600 text-white py-3 rounded-xl">


Manage Reviews


</a>



</div>








<div class="bg-white rounded-3xl shadow-lg p-8">


<div class="text-5xl mb-5">

🚨

</div>



<h3 class="text-xl font-bold">

Fraud Investigation

</h3>


<p class="text-gray-500 mt-3">

Investigate buyer reports and take action.

</p>




<a href="{{route('regulator.reports')}}"

class="block mt-6 text-center bg-red-600 text-white py-3 rounded-xl">


Investigate Reports


</a>



</div>







</div>





</div>

</div>


@endsection