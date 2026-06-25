<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Verified Sellers | OSVS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <div class="text-blue-600 text-3xl">🛡️</div>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#0a2540] leading-none">OSVS</h1>
                    <p class="text-[10px] text-slate-500 font-semibold tracking-wider uppercase mt-0.5">
                        Online Seller Verification System
                    </p>
                </div>
            </a>

            <a href="/"
                class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                ← Back to Home
            </a>
        </div>
    </nav>

    <section class="bg-[#0a2540] text-white py-12 px-6">
        <div class="max-w-4xl mx-auto text-center space-y-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Verified Seller Registry</h2>
            <p class="text-sm text-slate-300 max-w-lg mx-auto">
                Verify corporate credentials, physical operational footprints, and individual trust profiles instantly.
            </p>

            <div class="max-w-2xl mx-auto pt-2">
                <form action="{{ route('sellers.search') }}" method="GET"
                    class="flex items-center bg-white rounded-xl shadow-xl p-1.5 border border-slate-800">
                    <input type="text" name="query" value="{{ $search ?? '' }}"
                        placeholder="Search by brand name, category, or business location..."
                        class="w-full px-4 py-3 text-gray-900 focus:outline-none text-sm rounded-l-lg" required>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold text-sm hover:bg-blue-700 transition-colors shrink-0 flex items-center gap-2">
                        Search 🔍
                    </button>
                </form>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-12 flex-grow w-full">

        @if (!empty($search))
            <div class="mb-8 border-b border-gray-200 pb-4">
                <p class="text-sm text-gray-500">
                    Search results for: <span
                        class="font-bold text-[#0a2540] text-base bg-blue-50 px-3 py-1 rounded-md">"{{ $search }}"</span>
                    <span class="ml-2 text-xs text-gray-400">({{ $sellers->count() }}
                        {{ Str::plural('result', $sellers->count()) }} found)</span>
                </p>
            </div>
        @endif

        @if ($sellers->isEmpty())
            <div class="text-center py-20 max-w-md mx-auto space-y-4">
                <div class="text-6xl text-gray-300">🔍❌</div>
                <h3 class="text-xl font-bold text-[#0a2540]">No Verified Records Found</h3>
                <p class="text-sm text-gray-500 leading-relaxed">
                    We couldn't find any verified sellers matching that keyword. Try modifying your spelling or search
                    by general industry category.
                </p>
                <a href="{{ route('sellers.search') }}"
                    class="inline-block bg-slate-100 hover:bg-slate-200 text-[#0a2540] font-bold text-xs px-5 py-2.5 rounded-lg transition-colors">
                    Clear Search Filter
                </a>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($sellers as $seller)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow relative">

                        <div
                            class="absolute top-4 right-4 bg-emerald-50 border border-emerald-200 text-emerald-700 font-extrabold text-[11px] px-2.5 py-1 rounded-full flex items-center gap-1 shadow-sm">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            Verified Vendor
                        </div>

                        <div class="p-6 flex-grow space-y-4">
                            <div class="flex items-center space-x-4">
                                @if ($seller->profile_photo)
                                    <img src="{{ asset('storage/' . $seller->profile_photo) }}"
                                        alt="{{ $seller->brand_name }}"
                                        class="w-14 h-14 rounded-xl object-cover bg-slate-100 border border-gray-100">
                                @else
                                    <div
                                        class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 font-bold text-xl flex items-center justify-center border border-blue-100 uppercase">
                                        {{ substr($seller->brand_name ?? 'S', 0, 1) }}
                                    </div>
                                @endif

                                <div>
                                    <h4 class="font-extrabold text-lg text-[#0a2540] tracking-tight line-clamp-1">
                                        {{ $seller->brand_name ?? 'Unnamed Business' }}
                                    </h4>
                                    <span
                                        class="bg-slate-100 text-slate-600 font-semibold text-[11px] px-2 py-0.5 rounded uppercase tracking-wider">
                                        {{ $seller->business_category ?? 'General retail' }}
                                    </span>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <div class="space-y-2 text-xs text-gray-500">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-400 w-4 text-center">📍</span>
                                    <span><strong>Location:</strong> {{ $seller->location ?? 'Not Specified' }}</span>
                                </div>
                                @if ($seller->shop_link)
                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-400 w-4 text-center">🔗</span>
                                        <a href="{{ $seller->shop_link }}" target="_blank" rel="noopener noreferrer"
                                            class="text-blue-600 hover:underline font-medium truncate max-w-[200px]">
                                            {{ parse_url($seller->shop_link, PHP_URL_HOST) ?? 'Visit Store Website' }}
                                        </a>
                                    </div>
                                @endif
                                <p class="text-gray-500 text-xs line-clamp-2 pt-1 leading-relaxed">
                                    {{ $seller->description ?? 'No business description profile available at this moment.' }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="bg-slate-50 border-t border-gray-100 px-6 py-4 flex justify-between items-center text-xs">
                            <div class="flex flex-col">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Trust
                                    Score</span>
                                <span class="font-black text-slate-800 text-base">
                                    {{ $seller->trust_score ?? '95' }}<span
                                        class="text-xs text-gray-400 font-normal">/100</span>
                                </span>
                            </div>

                            <a href="{{ route('seller.profile.show', $seller->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg transition-all shadow-sm">
                                View Profile
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="bg-[#061324] text-slate-500 text-xs py-6 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>© {{ date('Y') }} Online Seller Verification System. All Rights Reserved.</p>
            <div class="space-x-4">
                <a href="#" class="hover:text-slate-400">Privacy Policy</a>
                <a href="#" class="hover:text-slate-400">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>

</html>
