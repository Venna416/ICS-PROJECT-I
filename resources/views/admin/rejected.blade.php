@extends('layouts.app')

@section('content')


<div class="p-8 bg-red-50 min-h-screen">


<h1 class="text-3xl font-bold mb-6">
Rejected Sellers
</h1>


@foreach($sellers as $seller)


<div class="bg-white shadow rounded-xl p-5 mb-4">


<h2 class="font-bold text-xl">
{{ $seller->brand_name }}
</h2>


<span class="text-red-600 font-bold">
✕ Rejected
</span>


</div>


@endforeach


</div>


@endsection