<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account | OSVS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-hidden">

    <header
        class="w-full bg-[#0a2540] border-b-4 border-blue-600 px-6 py-4 shadow-md z-10 flex justify-between items-center">
        <a href="/" class="flex items-center space-x-3">
            
            <div>
                <span class="text-xl font-black tracking-tight text-white block leading-none">OSVS</span>
                <span class="text-[9px] text-slate-400 font-bold tracking-wider uppercase mt-1 block">Online Seller
                    Verification System</span>
            </div>
        </a>
      
    </header>

    <main class="flex-1 flex flex-col justify-center items-center p-6 my-4 relative z-10">
        <div class="absolute w-72 h-72 bg-blue-600/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-md w-full bg-white rounded-2xl border border-gray-100 shadow-xl p-8 space-y-6">

            <div class="text-center pb-2 border-b border-gray-50">
                <img src="{{ asset('images/logo.png') }}" alt="VerifyTrust Logo"
                    class="h-24 w-auto mx-auto drop-shadow-sm object-contain">
            </div>

            <div class="space-y-1">
                <h1 class="text-xl font-extrabold text-[#0a2540] tracking-tight">Create your account</h1>
                <p class="text-xs text-gray-500">Sign up today to access merchant safety reports.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="name" class="text-xs font-bold text-gray-700 tracking-wide block">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        autocomplete="name"
                        class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10 transition-all">
                    @if ($errors->has('name'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-xs font-bold text-gray-700 tracking-wide block">Email
                        Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        autocomplete="username"
                        class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10 transition-all">
                    @if ($errors->has('email'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-xs font-bold text-gray-700 tracking-wide block">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10 transition-all">
                    @if ($errors->has('password'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="space-y-1">
                    <label for="password_confirmation"
                        class="text-xs font-bold text-gray-700 tracking-wide block">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10 transition-all">
                </div>

                <div class="space-y-1">
                    <label for="role" class="text-xs font-bold text-gray-700 tracking-wide block">Select Account
                        Type</label>
                    <div class="relative">
                        <select id="role" name="role" required
                            class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10 transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>Select Role...</option>
                            <option value="buyer">Buyer</option>
                            <option value="seller">Seller</option>
                            
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                           
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    @if ($errors->has('role'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('role') }}</p>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition-all text-sm shadow-md shadow-blue-600/10 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                        Register
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    Already registered?
                    <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline ml-1">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </main>

    <footer class="w-full bg-[#0a2540] border-t-4 border-blue-600 py-4 text-center text-xs text-slate-500 z-10">
        © {{ date('Y') }} Online Seller Verification System. All Rights Reserved.
    </footer>

</body>

</html>
