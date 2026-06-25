@extends('layouts.app')

@section('content')
    <div class="py-4 px-2">

        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-100 pb-5">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    📊 Regulator Dashboard
                </h1>
             
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-blue-500">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">👥 Total Sellers</h2>
                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $totalSellers }}
                </p>
            </div>

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-green-500">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">✅ Verified Sellers</h2>
                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $verifiedSellers }}
                </p>
            </div>

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-yellow-500">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">⏳ Pending Sellers</h2>
                <p class="text-3xl font-bold text-yellow-500 mt-2">
                    {{ $pendingSellers }}
                </p>
            </div>

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-red-500">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">❌ Rejected Sellers</h2>
                <p class="text-3xl font-bold text-red-600 mt-2">
                    {{ $rejectedSellers }}
                </p>
            </div>

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-purple-500">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">⭐ Total Reviews</h2>
                <p class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $totalReviews }}
                </p>
            </div>

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-indigo-500">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">📝 Pending Reviews</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $pendingReviews }}
                </p>
            </div>

            <div class="bg-slate-50/60 rounded-xl p-5 border border-slate-200/60 transition shadow-sm border-t-4 border-orange-600 col-span-1 sm:col-span-2 lg:col-span-2">
                <h2 class="text-gray-500 font-semibold text-xs uppercase tracking-wider">🚨 Active Fraud Reports</h2>
                <p class="text-3xl font-bold text-orange-600 mt-2">
                    {{ $totalFraudReports }}
                </p>
            </div>

        </div>

        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="bg-white pr-3 text-sm font-bold text-gray-800 uppercase tracking-wide">Compliance Management Modules</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pb-6">
            
            <div class="border border-slate-200/80 bg-slate-50/40 rounded-xl p-6 flex flex-col justify-between shadow-sm hover:shadow-md transition">
                <div>
                    <div class="w-10 h-10 bg-slate-900/5 text-slate-800 rounded-lg flex items-center justify-center text-xl font-bold mb-4">🏢</div>
                    <h3 class="font-bold text-gray-900 text-lg">Sellers Directory</h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                        Audit system-wide registration records, categories, and tracking histories verified by platform administration.
                    </p>
                </div>
                <a href="{{ route('regulator.sellers') }}"
                    class="w-full text-center mt-6 inline-block bg-slate-800 hover:bg-slate-900 text-white py-2.5 rounded-lg font-semibold text-xs transition shadow-sm">
                    Audit Directory
                </a>
            </div>

            @if (Route::has('regulator.reviews'))
            <div class="border border-slate-200/80 bg-slate-50/40 rounded-xl p-6 flex flex-col justify-between shadow-sm hover:shadow-md transition">
                <div>
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-xl font-bold mb-4">💬</div>
                    <h3 class="font-bold text-gray-900 text-lg">Review Moderation</h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                        Monitor live feedback channels. Hide, flag, or erase non-compliant, synthetic, or toxic marketplace reviews.
                    </p>
                </div>
                <a href="{{ route('regulator.reviews') }}"
                    class="w-full text-center mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-semibold text-xs transition shadow-sm">
                    Moderate Reviews
                </a>
            </div>
            @endif

            @if (Route::has('regulator.reports'))
            <div class="border border-slate-200/80 bg-slate-50/40 rounded-xl p-6 flex flex-col justify-between shadow-sm hover:shadow-md transition">
                <div>
                    <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center text-xl font-bold mb-4">🚨</div>
                    <h3 class="font-bold text-gray-900 text-lg">Fraud Alerts</h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                        Investigate user-submitted fraud reports. Track down malicious activity and execute defensive restrictions.
                    </p>
                </div>
                <a href="{{ route('regulator.reports') }}"
                    class="w-full text-center mt-6 inline-block bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-lg font-semibold text-xs transition shadow-sm">
                    View Fraud Reports
                </a>
            </div>
            @endif

        </div>

    </div>
@endsection