@extends('layouts.app')


@section('content')


<div class="min-h-screen flex items-center justify-center
bg-gradient-to-br from-red-50 via-purple-50 to-blue-50">


<div class="bg-white rounded-3xl shadow-xl p-10 text-center max-w-xl">


<div class="text-6xl mb-5">

✅

</div>


<h1 class="text-3xl font-bold text-gray-800">

Report Submitted Successfully

</h1>



<p class="text-gray-500 mt-4 text-lg">


Thank you for helping keep our marketplace safe.

Your fraud report has been sent to the verification team.


</p>



<a href="{{route('buyer.dashboard')}}"

class="inline-block mt-8 px-8 py-3 rounded-xl

bg-gradient-to-r from-red-500 to-purple-600

text-white font-bold">


Return Dashboard


</a>


</div>


</div>


@endsection