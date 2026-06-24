<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Seller Verification System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center space-x-3">
                <div class="text-blue-600 text-3xl">🛡️</div>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#0a2540] leading-none">OSVS</h1>
                    <p class="text-[10px] text-slate-500 font-semibold tracking-wider uppercase mt-0.5">Online Seller
                        Verification System</p>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-1">Home</a>
                <a href="#" class="hover:text-blue-600 transition-colors">About Us</a>
                <a href="#" class="hover:text-blue-600 transition-colors">How It Works</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Features</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Contact Us</a>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('login') }}"
                    class="text-blue-600 font-bold border border-blue-600/30 px-5 py-2 rounded-lg hover:bg-blue-50 transition-all text-sm">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="bg-blue-600 text-white font-bold px-5 py-2 rounded-lg hover:bg-blue-700 transition-all text-sm shadow-md shadow-blue-600/10">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <section class="relative min-h-[550px] flex items-center bg-[#0a2540] text-white overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/welcome dashboard.png') }}" alt="OSVS Background"
                class="w-full h-full object-cover object-right">
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-[#0a2540] via-[#0a2540]/90 to-transparent z-10"></div>

        <div class="max-w-7xl mx-auto px-6 py-20 w-full relative z-20 grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-7 space-y-6">
                <h1 class="text-4xl sm:text-5xl lg:text-5xl font-extrabold leading-tight tracking-tight drop-shadow-sm">
                    Online Seller <br> Verification System
                </h1>
                <div class="w-12 h-1 bg-blue-500 rounded-full"></div>
                <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed drop-shadow">
                    Verify online sellers before you buy. Search trusted businesses, review trust scores, report fraud
                    and shop with confidence.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold flex items-center gap-2 shadow-lg transition-all">
                            Get Started <span>→</span>
                        </a>
                        <button type="button" id="searchToggle"
                            class="border border-slate-500 hover:border-white px-6 py-3 rounded-lg font-bold flex items-center gap-2 bg-white/5 backdrop-blur-sm transition-all">
                            Search Sellers 🔍
                        </button>
                    </div>

                    <div id="searchBarBox" class="hidden max-w-md transition-all duration-300">
                        <form action="{{ route('sellers.search') }}" method="GET"
                            class="flex items-center bg-white rounded-lg overflow-hidden shadow-xl p-1 border border-gray-200">
                            <input type="text" name="query"
                                placeholder="Enter brand name, category, or location..."
                                class="w-full px-4 py-2.5 text-gray-900 focus:outline-none text-sm">
                            <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2.5 rounded-md font-bold text-sm hover:bg-blue-700 transition-colors shrink-0">
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-6">
        <div class="text-center space-y-3 mb-16">
            <h2 class="text-3xl font-extrabold text-[#0a2540]">Powerful Features</h2>
            <div class="w-12 h-1 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center space-y-4 hover:shadow-md transition-all group">
                <div
                    class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-all p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.242-8.651-3.011z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#0a2540]">Seller Verification</h3>
                <p class="text-sm text-gray-500 leading-relaxed">We verify seller identities using multiple verification
                    checks to ensure legitimacy.</p>
            </div>

            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center space-y-4 hover:shadow-md transition-all group">
                <div
                    class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-all p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499c.172-.435.741-.435.913 0l2.11 5.32 5.762.392c.477.032.668.62.316.942l-4.322 3.96 1.434 5.642c.119.467-.393.839-.783.565l-4.942-3.477-4.942 3.477c-.39.274-.902-.098-.783-.565l1.434-5.642-4.322-3.96c-.352-.321-.161-.91.316-.942l5.762-.392 2.11-5.32z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#0a2540]">Trust Scores</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Get an instant overview of seller credibility through
                    detailed trust scores and risk levels.</p>
            </div>

            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center space-y-4 hover:shadow-md transition-all group">
                <div
                    class="w-14 h-14 mx-auto rounded-2xl bg-red-50 text-red-500 flex items-center justify-center shadow-inner group-hover:bg-red-500 group-hover:text-white transition-all p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#0a2540]">Fraud Reporting</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Report suspicious activities and potential scams to
                    help protect other buyers.</p>
            </div>

            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center space-y-4 hover:shadow-md transition-all group">
                <div
                    class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner group-hover:bg-emerald-600 group-hover:text-white transition-all p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v5.25c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 013 18.375v-5.25zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125v-9.75zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v14.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#0a2540]">Risk Analysis</h3>
                <p class="text-sm text-gray-500 leading-relaxed">View comprehensive risk analysis before making any
                    purchase decisions.</p>
            </div>

        </div>
    </section>

    <section class="bg-blue-50/50 border-y border-blue-100/50 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center space-y-3 mb-16">
                <h2 class="text-3xl font-extrabold text-[#0a2540]">How It Works</h2>
                <div class="w-12 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>

            <div class="relative grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="hidden lg:block absolute top-7 left-10 right-10 h-0.5 border-t-2 border-dashed border-blue-200 z-0">
                </div>

                <div class="text-center space-y-3 relative z-10">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/20 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900">1. Search</h4>
                    <p class="text-xs text-gray-500 leading-relaxed max-w-xs mx-auto">Search for any seller by name,
                        category or location.</p>
                </div>

                <div class="text-center space-y-3 relative z-10">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/20 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900">2. Verify</h4>
                    <p class="text-xs text-gray-500 leading-relaxed max-w-xs mx-auto">View verification status, trust
                        score and risk level.</p>
                </div>

                <div class="text-center space-y-3 relative z-10">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/20 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v5.269z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900">3. Review</h4>
                    <p class="text-xs text-gray-500 leading-relaxed max-w-xs mx-auto">Read buyer reviews and
                        experiences shared.</p>
                </div>

                <div class="text-center space-y-3 relative z-10">
                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/20 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900">4. Shop Safely</h4>
                    <p class="text-xs text-gray-500 leading-relaxed max-w-xs mx-auto">Make informed decisions and shop
                        with confidence.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16">
        <div
            class="bg-gradient-to-r from-[#06182c] to-[#0b2b4d] rounded-2xl p-8 sm:p-12 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden shadow-xl border border-slate-800">
            <div class="flex items-center space-x-6 z-10">
                <div class="text-5xl opacity-80">🔒</div>
                <div class="space-y-2">
                    <h3 class="text-2xl font-bold text-white">Be a Part of a Safer Marketplace</h3>
                    <p class="text-sm text-slate-300 max-w-md">Join OSVS today and help build a trusted and secure
                        online shopping community.</p>
                </div>
            </div>

            <a href="{{ route('register') }}"
                class="bg-white text-blue-900 font-extrabold px-6 py-3.5 rounded-lg flex items-center gap-2 shadow-md hover:bg-slate-50 transition-all text-sm shrink-0 z-10">
                Create Account <span>→</span>
            </a>
        </div>
    </section>

    <footer class="bg-[#061324] text-slate-400 text-sm">
        <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-12 gap-10">

            <div class="md:col-span-4 space-y-4">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">🛡️ OSVS</h3>
                <p class="text-xs leading-relaxed text-slate-400">Our mission is to create a safe and transparent
                    online marketplace for buyers and sellers.</p>
                <div class="flex space-x-3 text-slate-500 text-lg">
                    <a href="#" class="hover:text-white">𝕏</a>
                    <a href="#" class="hover:text-white">f</a>
                    <a href="#" class="hover:text-white">📷</a>
                    <a href="#" class="hover:text-white">in</a>
                </div>
            </div>

            <div class="md:col-span-2 space-y-3">
                <h4 class="text-white text-xs font-bold uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">How It Works</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <div class="md:col-span-2 space-y-3">
                <h4 class="text-white text-xs font-bold uppercase tracking-wider">For Users</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="#" class="hover:text-white transition-colors">Search Sellers</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Report Fraud</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Trust & Safety</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                </ul>
            </div>

            <div class="md:col-span-4 space-y-3">
                <h4 class="text-white text-xs font-bold uppercase tracking-wider">Contact Us</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li class="flex items-center gap-2">✉️ support@osvs.com</li>
                    <li class="flex items-center gap-2">📞 +92 300 1234567</li>
                    <li class="flex items-center gap-2">📍 Karachi, Pakistan</li>
                </ul>
            </div>

        </div>

        <div
            class="border-t border-slate-800 py-6 max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>© {{ date('Y') }} Online Seller Verification System. All Rights Reserved.</p>
            <div class="space-x-4">
                <a href="#" class="hover:text-slate-400">Privacy Policy</a>
                <a href="#" class="hover:text-slate-400">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('searchToggle');
            const searchBox = document.getElementById('searchBarBox');

            if (toggleBtn && searchBox) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Absolute fix to prevent jumping to /#
                    searchBox.classList.toggle('hidden');
                });
            }
        });
    </script>

</body>

</html>v
