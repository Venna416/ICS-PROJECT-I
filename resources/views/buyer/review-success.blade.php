@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center">


<div class="bg-white shadow-xl rounded-3xl p-10 text-center max-w-lg">


<div class="text-6xl mb-5">

✅

</div>


<h1 class="text-3xl font-bold text-gray-800">

Thank You For Your Feedback

</h1>


<p class="text-gray-500 mt-4">

Your review has been successfully submitted.
It will help other buyers make safer decisions.

</p>



<a href="{{route('buyer.dashboard')}}"

class="inline-block mt-8 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl">


Back To Dashboard


</a>



</div>


</div>



@endsection