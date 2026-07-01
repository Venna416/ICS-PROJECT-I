@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-8">


<div class="max-w-7xl mx-auto">



<!-- HEADER -->

<div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700

rounded-3xl shadow-2xl p-10 text-white mb-10">


<div class="flex justify-between items-center">



<div>


<h1 class="text-4xl font-extrabold tracking-tight">

🛡️ Admin Control Center

</h1>



<p class="mt-3 text-indigo-100 text-lg">

Manage seller verification, buyer activity and regulator compliance.

</p>



</div>





<!-- NOTIFICATION BELL -->


<div class="relative">



<button

onclick="toggleAdminNotifications()"

class="relative bg-white/20 backdrop-blur-lg

p-4 rounded-full text-3xl

hover:bg-white/30 transition shadow-lg">


🔔



@if(auth()->user()->unreadNotifications->count() > 0)


<span

class="absolute -top-2 -right-2

bg-red-600 text-white

text-xs font-bold

w-7 h-7 rounded-full

flex items-center justify-center">


{{auth()->user()->unreadNotifications->count()}}


</span>


@endif



</button>







<!-- DROPDOWN -->


<div id="adminNotifications"


class="hidden absolute right-0 mt-5

w-96 bg-white rounded-3xl

shadow-2xl p-5

text-gray-800 z-50">





<div class="flex justify-between items-center mb-5">


<h2 class="font-bold text-xl">

🔔 Notifications

</h2>



<span class="text-sm text-gray-400">

{{auth()->user()->unreadNotifications->count()}}

</span>



</div>






<div class="max-h-96 overflow-y-auto">



@forelse(auth()->user()->unreadNotifications as $notification)



<a

href="{{route('notifications.read',$notification->id)}}"

class="block bg-indigo-50

rounded-2xl p-4 mb-3

hover:bg-indigo-100 transition">



<p class="font-bold text-indigo-700">

{{$notification->data['title']}}

</p>



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





@if(auth()->user()->unreadNotifications->count() > 0)



<form method="POST"

action="{{route('notifications.read.all')}}">


@csrf



<button

class="mt-4 w-full

bg-indigo-600

hover:bg-indigo-700

text-white

py-3

rounded-2xl

font-bold">


✓ Mark all as read


</button>



</form>



@endif





</div>





</div>





</div>


</div>









<!-- DASHBOARD CARDS -->


<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">





<!-- PENDING -->


<a href="{{route('admin.pending')}}"

class="bg-white rounded-3xl shadow-lg p-8

hover:shadow-2xl hover:-translate-y-2 transition">


<div class="flex justify-between">


<div>


<p class="text-gray-500">

Pending Verification

</p>


<h2 class="text-5xl font-bold text-yellow-500 mt-4">

{{$pendingCount}}

</h2>


</div>


<div class="text-5xl">

⏳

</div>


</div>


<p class="mt-6 text-gray-600">

Review seller applications

</p>


</a>









<!-- VERIFIED -->


<a href="{{route('admin.verified')}}"

class="bg-white rounded-3xl shadow-lg p-8

hover:shadow-2xl hover:-translate-y-2 transition">


<div class="flex justify-between">


<div>


<p class="text-gray-500">

Verified Sellers

</p>


<h2 class="text-5xl font-bold text-green-600 mt-4">

{{$verifiedCount}}

</h2>


</div>


<div class="text-5xl">

✅

</div>


</div>


<p class="mt-6 text-gray-600">

Trusted businesses

</p>


</a>









<!-- REJECTED -->


<a href="{{route('admin.rejected')}}"

class="bg-white rounded-3xl shadow-lg p-8

hover:shadow-2xl hover:-translate-y-2 transition">


<div class="flex justify-between">


<div>


<p class="text-gray-500">

Rejected Sellers

</p>


<h2 class="text-5xl font-bold text-red-600 mt-4">

{{$rejectedCount}}

</h2>


</div>


<div class="text-5xl">

❌

</div>


</div>


<p class="mt-6 text-gray-600">

Rejected applications

</p>


</a>









<!-- REVIEWS -->


<a href="{{route('admin.reviews')}}"

class="bg-white rounded-3xl shadow-lg p-8

hover:shadow-2xl hover:-translate-y-2 transition">


<div class="flex justify-between">


<div>


<p class="text-gray-500">

Buyer Reviews

</p>


<h2 class="text-5xl font-bold text-purple-600 mt-4">

{{$reviewCount}}

</h2>


</div>


<div class="text-5xl">

⭐

</div>


</div>


<p class="mt-6 text-gray-600">

Monitor customer feedback

</p>


</a>









<!-- FRAUD -->


<a href="{{route('admin.fraudReports')}}"

class="bg-white rounded-3xl shadow-lg p-8

hover:shadow-2xl hover:-translate-y-2 transition">


<div class="flex justify-between">


<div>


<p class="text-gray-500">

Fraud Reports

</p>


<h2 class="text-5xl font-bold text-red-600 mt-4">

{{$fraudCount}}

</h2>


</div>


<div class="text-5xl">

🚨

</div>


</div>


<p class="mt-6 text-gray-600">

Investigate suspicious activity

</p>


</a>









<!-- REGULATOR CONCERNS -->


<a href="{{route('admin.regulator.concerns')}}"


class="bg-gradient-to-br from-purple-50 to-indigo-50

border border-purple-200

rounded-3xl shadow-lg p-8

hover:shadow-2xl hover:-translate-y-2 transition">





<div class="flex justify-between items-center">



<div>


<p class="text-gray-500 font-semibold">

Regulator Concerns

</p>


<h2 class="text-5xl font-extrabold text-purple-700 mt-4">

{{$regulatorConcerns}}

</h2>


</div>




<div class="text-5xl">

🛡️

</div>



</div>





<p class="mt-6 text-gray-600">

Review concerns raised by regulators about seller verification decisions.

</p>



</a>





</div>





</div>


</div>






<script>


function toggleAdminNotifications(){


document

.getElementById('adminNotifications')

.classList

.toggle('hidden');


}



</script>



@endsection