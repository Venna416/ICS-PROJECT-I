@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 flex flex-col">


    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 
    bg-gradient-to-r from-blue-600 to-pink-500 
    text-white shadow-md">


        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center">


            <h1 class="text-xl font-bold tracking-wide">

                ⭐ Write a Review

            </h1>


        </div>


    </header>




    <!-- Content -->

    <main class="flex-1 flex justify-center items-center 
    px-5 pt-20 pb-20">


        <div class="w-full max-w-3xl 
        bg-white rounded-3xl shadow-2xl 
        p-8 md:p-10">


            <!-- Title -->

            <div class="text-center mb-8">


                <div class="inline-flex items-center justify-center 
                w-16 h-16 rounded-full 
                bg-gradient-to-r from-blue-600 to-pink-500 
                text-white text-3xl mb-4">

                    ⭐

                </div>



                <h2 class="text-3xl font-bold 
                bg-gradient-to-r from-blue-600 to-pink-500 
                bg-clip-text text-transparent">

                    Share Your Experience

                </h2>



                <p class="text-gray-500 mt-3">

                    Your review helps buyers make safer decisions 
                    and improves seller trust.

                </p>


            </div>






            <form action="{{ route('buyer.reviews.store') }}" method="POST">

                @csrf




                <!-- Seller Name -->

                <div class="mb-5">


                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Seller Name

                    </label>


                    <input 
                    type="text"
                    name="seller_name"

                    class="w-full px-4 py-3 rounded-xl
                    border border-gray-200
                    focus:ring-2 focus:ring-pink-400
                    focus:outline-none"

                    placeholder="Enter seller name"
                    required>


                </div>





                <!-- Shop Name -->


                <div class="mb-5">


                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Shop Name

                    </label>


                    <input 
                    type="text"
                    name="shop_name"

                    class="w-full px-4 py-3 rounded-xl
                    border border-gray-200
                    focus:ring-2 focus:ring-pink-400
                    focus:outline-none"

                    placeholder="Enter shop/business name"
                    required>


                </div>






                <!-- Link -->

                <div class="mb-5">


                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Shop Link

                    </label>


                    <input 

                    type="url"
                    name="shop_link"


                    class="w-full px-4 py-3 rounded-xl
                    border border-gray-200
                    focus:ring-2 focus:ring-pink-400
                    focus:outline-none"


                    placeholder="https://example.com"
                    required>


                </div>








                <!-- Rating Card -->


                <div class="mb-5 
                bg-gradient-to-r from-blue-50 to-pink-50
                rounded-2xl p-5">


                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        ⭐ Rate this seller

                    </label>


                    <select

                    name="rating"

                    class="w-full px-4 py-3 rounded-xl
                    border border-gray-200
                    bg-white
                    focus:ring-2 focus:ring-pink-400
                    focus:outline-none"

                    required>


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








                <!-- Review Text -->


                <div class="mb-7">


                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Your Review

                    </label>


                    <textarea

                    name="review"

                    rows="5"


                    class="w-full px-4 py-3 rounded-xl
                    border border-gray-200
                    resize-none

                    focus:ring-2 focus:ring-pink-400
                    focus:outline-none"


                    placeholder="Tell other buyers about your experience..."
                    required></textarea>


                </div>








                <!-- Button -->

                <button

                type="submit"


                class="w-full py-3 rounded-xl

                bg-gradient-to-r from-blue-600 to-pink-500

                hover:from-blue-700 hover:to-pink-600

                text-white font-bold text-lg

                shadow-lg transition duration-300">


                    Submit Review ✨


                </button>





            </form>



        </div>



    </main>






    <!-- Footer -->


    <footer class="fixed bottom-0 left-0 right-0

    bg-gradient-to-r from-blue-600 to-pink-500

    text-white text-center py-3 text-sm">


        © 2026 Online Seller Verification


    </footer>



</div>


@endsection