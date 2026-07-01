@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 py-10 px-6">


<div class="max-w-7xl mx-auto">





<!-- WELCOME HEADER -->

<div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700

rounded-3xl shadow-2xl p-10 text-white mb-10">


<div class="flex flex-col md:flex-row justify-between items-center gap-8">



<div>


<h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">

🛒 Welcome, {{Auth::user()->name}}

</h1>



<p class="mt-4 text-indigo-100 text-lg max-w-2xl">

Discover trusted sellers, share your experiences, 
and help keep the marketplace safe for everyone.

</p>



<div class="mt-6 flex gap-4">


<span class="bg-white/20 px-5 py-2 rounded-full backdrop-blur">

🛡️ Safe Shopping

</span>


<span class="bg-white/20 px-5 py-2 rounded-full backdrop-blur">

⭐ Trusted Reviews

</span>



</div>



</div>









<!-- NOTIFICATION -->

<div class="relative">


<button

onclick="toggleNotifications()"

class="relative bg-white/20 backdrop-blur-md

p-5 rounded-full text-4xl

hover:bg-white/30

transition duration-300 shadow-lg">


🔔



@if(auth()->user()->unreadNotifications->count() > 0)


<span

class="absolute -top-1 -right-1

bg-red-600 text-white

text-xs font-bold

w-7 h-7 rounded-full

flex items-center justify-center">


{{auth()->user()->unreadNotifications->count()}}


</span>


@endif



</button>








<!-- DROPDOWN -->


<div id="notifications"

class="hidden absolute right-0 mt-5

w-96 bg-white rounded-3xl

shadow-2xl border

p-5 text-gray-800 z-50">



<h2 class="font-bold text-xl mb-5">

🔔 Notifications

</h2>






<div class="max-h-96 overflow-y-auto">


@forelse(auth()->user()->unreadNotifications as $notification)



<a

href="{{route('notifications.read',$notification->id)}}"

class="block bg-blue-50

rounded-2xl p-4 mb-3

hover:bg-blue-100 transition">


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











<!-- QUICK ACTIONS -->


<div class="mb-8">


<h2 class="text-3xl font-bold text-gray-800">

Marketplace Actions

</h2>


<p class="text-gray-500 mt-2">

Manage your shopping experience and help improve seller trust.

</p>


</div>






<div class="grid md:grid-cols-3 gap-8">







<!-- SEARCH SELLERS -->


<a href="{{route('buyer.search')}}"


class="group bg-white rounded-3xl shadow-xl p-8

hover:-translate-y-2

hover:shadow-2xl

transition">


<div class="w-16 h-16 rounded-2xl

bg-indigo-100

flex items-center justify-center

text-4xl mb-6">


🔎


</div>




<h2 class="text-2xl font-bold text-gray-800">

Find Sellers

</h2>



<p class="text-gray-500 mt-3">

Search verified sellers and view trust information.

</p>



<div class="mt-6 text-indigo-600 font-bold group-hover:translate-x-2 transition">

Explore sellers →

</div>


</a>









<!-- REVIEWS -->


<a href="{{route('buyer.reviews')}}"


class="group bg-white rounded-3xl shadow-xl p-8

hover:-translate-y-2

hover:shadow-2xl

transition">


<div class="w-16 h-16 rounded-2xl

bg-yellow-100

flex items-center justify-center

text-4xl mb-6">


⭐


</div>




<h2 class="text-2xl font-bold text-gray-800">

Buyer Reviews

</h2>



<p class="text-gray-500 mt-3">

Share your experience and help other buyers.

</p>



<div class="mt-6 text-indigo-600 font-bold group-hover:translate-x-2 transition">

Write review →

</div>


</a>









<!-- FRAUD -->


<a href="{{route('buyer.reports')}}"


class="group bg-white rounded-3xl shadow-xl p-8

hover:-translate-y-2

hover:shadow-2xl

transition">


<div class="w-16 h-16 rounded-2xl

bg-red-100

flex items-center justify-center

text-4xl mb-6">


🚨


</div>




<h2 class="text-2xl font-bold text-gray-800">

Report Fraud

</h2>



<p class="text-gray-500 mt-3">

Report suspicious sellers and protect the marketplace.

</p>



<div class="mt-6 text-red-600 font-bold group-hover:translate-x-2 transition">

Submit report →

</div>


</a>






</div>











<!-- SAFETY CARD -->


<div class="mt-10 bg-white rounded-3xl shadow-xl p-8 border">


<div class="flex items-center gap-4">


<div class="text-5xl">

🛡️

</div>



<div>


<h2 class="text-2xl font-bold text-gray-800">

Marketplace Safety

</h2>


<p class="text-gray-600 mt-2">

Always verify sellers, leave honest reviews, 
and report suspicious activity to keep buyers protected.

</p>


</div>


</div>


</div>







</div>


</div>









<script>


function toggleNotifications(){


document

.getElementById('notifications')

.classList

.toggle('hidden');


}


</script>



@endsection