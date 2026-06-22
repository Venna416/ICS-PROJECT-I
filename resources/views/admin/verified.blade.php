@extends('layouts.app')

@section('content')

<div class="p-8 bg-green-50 min-h-screen">


<h1 class="text-3xl font-bold mb-6">
Verified Sellers
</h1>


@foreach($sellers as $seller)


<div class="bg-white shadow rounded-xl p-5 mb-4">


<h2 class="font-bold text-xl">
{{ $seller->brand_name }}
</h2>


<p>
Trust Score:
{{ $seller->trust_score }}
</p>


<p>
Risk Score:
{{ $seller->risk_score }}
</p>


<span class="text-green-600 font-bold">
✓ Verified
</span>


</div>


@endforeach


</div>

@endsection