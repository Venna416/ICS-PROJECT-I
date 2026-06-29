@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 py-10 px-6">


<div class="max-w-7xl mx-auto">







<!-- WELCOME CARD -->

<div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700

rounded-3xl shadow-2xl p-10 text-white mb-10">



<div class="flex justify-between items-center">



<div>


<h1 class="text-4xl font-bold">

🛒 Welcome, {{Auth::user()->name}}

</h1>



<p class="mt-4 text-indigo-100 text-lg">

Your buyer dashboard helps you discover trusted sellers, share experiences,
and keep the marketplace safe.

</p>


</div>







<!-- NOTIFICATION -->

<div class="relative">



<button

onclick="toggleNotifications()"

class="bg-white/20 backdrop-blur p-4 rounded-full text-3xl hover:bg-white/30 transition">


🔔



@if(auth()->user()->unreadNotifications->count() > 0)


<span

class="absolute -top-1 -right-1

bg-red-600 text-white

text-xs font-bold

w-6 h-6 rounded-full

flex items-center justify-center">


{{auth()->user()->unreadNotifications->count()}}


</span>


@endif



</button>







<div id="notifications"

class="hidden absolute right-0 mt-4

w-96 bg-white rounded-3xl

shadow-2xl p-5 text-gray-800 z-50">



<h2 class="font-bold text-xl mb-4">

🔔 Notifications

</h2>





@forelse(auth()->user()->unreadNotifications as $notification)



<a href="{{route('notifications.read',$notification->id)}}"

class="block bg-blue-50 rounded-xl p-4 mb-3">


<h3 class="font-bold">

{{$notification->data['title']}}

</h3>


<p class="text-sm text-gray-600 mt-2">

{{$notification->data['message']}}

</p>


</a>



@empty


<p class="text-gray-500">

No notifications

</p>



@endforelse



</div>





</div>



</div>


</div>









<!-- DASHBOARD OPTIONS -->



<div class="grid md:grid-cols-3 gap-8">







<!-- SEARCH -->


<a href="{{route('buyer.search')}}"

class="bg-white rounded-3xl shadow-xl p-8

hover:-translate-y-2 hover:shadow-2xl

transition duration-300">



<div class="text-5xl mb-5">

🔎

</div>



<h2 class="text-2xl font-bold text-gray-800">

Search Sellers

</h2>



<p class="text-gray-500 mt-3">

Find verified sellers and check their trust information.

</p>



<div class="mt-6 text-indigo-600 font-semibold">

Explore sellers →

</div>



</a>









<!-- REVIEWS -->


<a href="{{route('buyer.reviews')}}"

class="bg-white rounded-3xl shadow-xl p-8

hover:-translate-y-2 hover:shadow-2xl

transition duration-300">



<div class="text-5xl mb-5">

⭐

</div>



<h2 class="text-2xl font-bold text-gray-800">

Write Reviews

</h2>



<p class="text-gray-500 mt-3">

Share your buying experience and help others make safer choices.

</p>



<div class="mt-6 text-indigo-600 font-semibold">

Submit review →

</div>



</a>









<!-- FRAUD -->


<a href="{{route('buyer.reports')}}"

class="bg-white rounded-3xl shadow-xl p-8

hover:-translate-y-2 hover:shadow-2xl

transition duration-300">



<div class="text-5xl mb-5">

🚨

</div>



<h2 class="text-2xl font-bold text-gray-800">

Fraud Reports

</h2>



<p class="text-gray-500 mt-3">

Report suspicious sellers and protect the marketplace.

</p>



<div class="mt-6 text-indigo-600 font-semibold">

Report issue →

</div>



</a>






</div>








<!-- INFO SECTION -->


<div class="mt-10 bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-2xl font-bold text-gray-800">

🛡️ Marketplace Safety

</h2>



<p class="text-gray-600 mt-3">

Always verify sellers, review experiences honestly,
and report suspicious activity to help keep everyone safe.

</p>



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