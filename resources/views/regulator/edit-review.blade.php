@extends('layouts.app')


@section('content')


<div class="min-h-screen bg-slate-100 p-8">


<div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl p-8">



<h1 class="text-3xl font-bold mb-6">

✏️ Edit Regulator Review

</h1>





<form method="POST"

action="{{route('regulator.review.update',$review->id)}}">


@csrf

@method('PUT')






<label class="font-semibold">

Decision

</label>



<select name="is_fair"

class="w-full border rounded-xl p-4 mt-3 mb-6">



<option value="1"

{{$review->is_fair ? 'selected':''}}>

✅ Fair Decision

</option>



<option value="0"

{{$review->is_fair ? '' : 'selected'}}>

❌ Not Fair

</option>



</select>








<label class="font-semibold">

Reason

</label>




<textarea

name="reason"

rows="5"

class="w-full border rounded-xl p-4 mt-3"

required>


{{$review->reason}}


</textarea>







<button

class="mt-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-bold">


Save Changes


</button>




</form>




</div>


</div>


@endsection