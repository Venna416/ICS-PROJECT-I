<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>


    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        {{ config('app.name', 'Portal') }}
    </title>



    <link rel="preconnect" href="https://fonts.bunny.net">


    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">



    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>







<body class="font-sans antialiased">



    <div class="min-h-screen bg-gradient-to-br 

from-slate-100

via-blue-50

to-purple-100">







        <!-- NAVBAR -->


        <header class="bg-gradient-to-r

from-indigo-700

via-purple-700

to-pink-600

shadow-xl">





            <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">







                <!-- LOGO -->


                <div>



                    <h1 class="text-3xl font-bold text-white">



                        @if (Auth::user()->role === 'seller')
                            🏬 Seller Dashboard
                        @elseif(Auth::user()->role === 'buyer')
                            🛒 Buyer Dashboard
                        @elseif(Auth::user()->role === 'admin')
                            🛡️ Admin Dashboard
                        @elseif(Auth::user()->role === 'regulator')
                            📊 Regulator Dashboard
                        @else
                            Dashboard
                        @endif



                    </h1>







                </div>










                <!-- LINKS -->


                <nav class="flex items-center gap-8 text-white font-semibold">





                    <a href="{{ route('dashboard') }}" class="hover:text-yellow-300 transition">


                        Dashboard


                    </a>








                    @if (Auth::user()->role !== 'admin')
                        <a href="{{ route('profile.edit') }}" class="hover:text-yellow-300 transition">


                            Profile


                        </a>
                    @endif







                    <form method="POST" action="{{ route('logout') }}" class="inline">



                        @csrf




                        <button class="hover:text-yellow-300 transition">


                            Log Out


                        </button>



                    </form>







                </nav>







            </div>



        </header>









        <!-- PAGE -->


        <main class="py-10">


            <div class="max-w-7xl mx-auto px-6">





                <div class="bg-white/90

backdrop-blur

rounded-3xl

shadow-2xl

p-8">



                    @yield('content')



                </div>





            </div>



        </main>









    </div>







    <script>
        document.addEventListener('DOMContentLoaded', function() {


            if (localStorage.getItem('theme') === 'dark') {


                document.documentElement.classList.add('dark');


            }



        });
    </script>





</body>


</html>
