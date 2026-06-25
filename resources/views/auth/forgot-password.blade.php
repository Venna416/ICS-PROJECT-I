<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | OSVS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-hidden">

    <header class="w-full bg-[#0a2540] border-b-4 border-blue-600 px-6 py-4 shadow-md z-10 flex justify-between items-center">
        <a href="/" class="flex items-center space-x-3">
            <span class="text-2xl">🛡️</span>
            <div>
                <span class="text-xl font-black tracking-tight text-white block leading-none">OSVS</span>
                <span class="text-[9px] text-slate-400 font-bold tracking-wider uppercase mt-1 block">Online Seller Verification System</span>
            </div>
        </a>
        
    </header>

    <main class="flex-1 flex flex-col justify-center items-center p-6 my-4 relative z-10">
        <div class="absolute w-72 h-72 bg-blue-600/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-md w-full bg-white rounded-2xl border border-gray-100 shadow-xl p-8 space-y-5">
            
            <div class="space-y-1">
                <h1 class="text-xl font-extrabold text-[#0a2540] tracking-tight">Reset your password</h1>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>
            </div>

            @if (session('status'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-2.5 rounded-lg text-xs font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="text-xs font-bold text-gray-700 tracking-wide block">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10 transition-all">
                    @if ($errors->has('email'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition-all text-sm shadow-md shadow-blue-600/10 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                        Email Password Reset Link
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    Remember your login credentials?
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