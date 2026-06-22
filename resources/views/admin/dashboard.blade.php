@extends('layouts.app')

@section('content')


<div class="min-h-screen bg-gradient-to-br from-blue-50 to-pink-50 p-8">


<h1 class="text-3xl font-bold text-gray-800 mb-8">
Admin Dashboard
</h1>



<div class="grid md:grid-cols-3 gap-6">


<a href="{{route('admin.pending')}}"
class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">

<h2 class="text-xl font-bold text-gray-700">
Pending Sellers
</h2>


<p class="text-5xl font-bold text-yellow-500 mt-4">

{{$pendingCount}}

</p>


<p class="mt-3 text-gray-500">
Review applications →
</p>

</a>





<a href="{{route('admin.verified')}}"
class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">
Verified Sellers
</h2>


<p class="text-5xl font-bold text-green-500 mt-4">

{{$verifiedCount}}

</p>


<p class="mt-3 text-gray-500">
View approved sellers →
</p>


</a>






<a href="{{route('admin.rejected')}}"
class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">


<h2 class="text-xl font-bold text-gray-700">
Rejected Sellers
</h2>


<p class="text-5xl font-bold text-red-500 mt-4">

{{$rejectedCount}}

</p>


<p class="mt-3 text-gray-500">
View rejected sellers →
</p>


</a>



</div>


</div>


@endsection