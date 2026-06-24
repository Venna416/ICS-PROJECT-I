@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-10 px-5">


        <div class="max-w-5xl mx-auto">





            {{-- SUCCESS --}}

            @if (session('success'))
                <div class="mb-6 bg-white rounded-2xl shadow p-5 border-l-4 border-purple-500">


                    <div class="flex items-center gap-3">


                        <span class="text-3xl">
                            ✓
                        </span>


                        <div>

                            <h3 class="font-bold text-purple-700">
                                Success
                            </h3>


                            <p class="text-gray-600">
                                {{ session('success') }}
                            </p>


                        </div>


                    </div>


                </div>
            @endif







            {{-- ERROR --}}

            @if (session('error'))
                <div class="mb-6 bg-white rounded-2xl shadow p-5 border-l-4 border-red-500">


                    <div class="flex items-center gap-3">


                        <span class="text-3xl">
                            ⚠️
                        </span>


                        <div>

                            <h3 class="font-bold text-red-700">
                                Notice
                            </h3>


                            <p class="text-gray-600">
                                {{ session('error') }}
                            </p>


                        </div>


                    </div>


                </div>
            @endif










            {{-- HEADER --}}


            <div class="bg-gradient-to-r from-blue-600 to-pink-500 rounded-3xl shadow-xl p-10 text-white mb-8">


                <h1 class="text-4xl font-bold">

                    ⭐ Seller Experience Review

                </h1>


                <p class="mt-3 text-blue-50 text-lg">

                    Help other buyers make safer decisions by sharing your honest experience.

                </p>


            </div>









            {{-- GUIDELINES FIRST --}}



            <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">


                <h2 class="text-2xl font-bold text-gray-800 mb-5">

                    🔒 Review Guidelines

                </h2>



                <div class="grid md:grid-cols-2 gap-5">



                    <div class="bg-blue-50 rounded-xl p-5">

                        <h3 class="font-bold text-blue-700">

                            ✓ Be Honest

                        </h3>

                        <p class="text-gray-600 mt-2">

                            Share your real buying experience with the seller.

                        </p>

                    </div>





                    <div class="bg-purple-50 rounded-xl p-5">

                        <h3 class="font-bold text-purple-700">

                            ✓ Help Buyers

                        </h3>

                        <p class="text-gray-600 mt-2">

                            Your feedback helps others identify trusted sellers.

                        </p>

                    </div>






                    <div class="bg-pink-50 rounded-xl p-5">

                        <h3 class="font-bold text-pink-700">

                            ✓ Keep It Fair

                        </h3>

                        <p class="text-gray-600 mt-2">

                            Avoid false information or harmful comments.

                        </p>

                    </div>






                    <div class="bg-gray-50 rounded-xl p-5">

                        <h3 class="font-bold text-gray-700">

                            ✓ Verification Support

                        </h3>

                        <p class="text-gray-600 mt-2">

                            Reviews contribute to seller trust evaluation.

                        </p>

                    </div>



                </div>


            </div>









            {{-- REVIEW FORM --}}



            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10">





                <div class="text-center mb-8">


                    <div
                        class="w-20 h-20 mx-auto rounded-full 

bg-gradient-to-r from-blue-600 to-pink-500

flex items-center justify-center

text-white text-4xl shadow-lg">


                        ⭐


                    </div>




                    <h2 class="text-3xl font-bold mt-5 text-gray-800">

                        Write Your Review

                    </h2>



                    <p class="text-gray-500 mt-2">

                        Your feedback improves trust and transparency.

                    </p>



                </div>









                <form action="{{ route('buyer.reviews.store') }}" method="POST">

                    @csrf





                    {{-- SELLER NAME --}}


                    <div class="mb-6">


                        <label class="font-semibold">

                            Seller Name

                        </label>


                        <input name="seller_name" class="w-full p-3 border rounded-xl" placeholder="Seller owner name"
                            required>


                        <br>



                        <label class="font-semibold">

                            Brand Name

                        </label>


                        <input name="brand_name" class="w-full p-3 border rounded-xl" placeholder="Business brand name"
                            required>


                    </div>









                    {{-- RATING --}}


                    <div class="mb-6 bg-gradient-to-r from-blue-50 to-pink-50 rounded-2xl p-6">


                        <label class="font-semibold text-gray-700">

                            ⭐ Rate Your Experience

                        </label>



                        <select name="rating" class="mt-3 w-full rounded-xl border-gray-200 p-4" required>


                            <option value="">

                                Select rating

                            </option>


                            <option value="1">
                                ⭐ Very Poor
                            </option>


                            <option value="2">
                                ⭐⭐ Poor
                            </option>


                            <option value="3">
                                ⭐⭐⭐ Average
                            </option>


                            <option value="4">
                                ⭐⭐⭐⭐ Good
                            </option>


                            <option value="5">
                                ⭐⭐⭐⭐⭐ Excellent
                            </option>



                        </select>


                    </div>









                    {{-- REVIEW --}}



                    <div class="mb-8">


                        <label class="font-semibold text-gray-700">

                            Your Experience

                        </label>



                        <textarea name="review" rows="6"
                            class="mt-3 w-full rounded-xl border-gray-200 p-4 resize-none focus:ring-2 focus:ring-purple-400"
                            placeholder="Describe your experience with this seller..." required></textarea>



                    </div>









                    <button type="submit"
                        class="w-full py-4 rounded-xl

bg-gradient-to-r from-blue-600 to-pink-500

text-white font-bold text-lg

shadow-lg hover:opacity-90 transition">


                        Submit Review ⭐


                    </button>





                </form>




            </div>








        </div>


    </div>
@endsection
