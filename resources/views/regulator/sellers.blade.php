@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 px-6">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    🏢 Sellers Directory
                </h1>
               
            </div>
            <div>
                <a href="{{ route('regulator.dashboard') }}" class="inline-flex items-center bg-white hover:bg-slate-50 text-gray-700 font-medium px-5 py-2.5 rounded-xl shadow-md transition border border-slate-200">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <tr>
                            <th class="p-4 pl-6">Brand Name</th>
                            <th class="p-4">Business Category</th>
                            <th class="p-4">Registration Date</th>
                            <th class="p-4">Onboarding Status</th>
                            <th class="p-4 pr-6 text-right">Regulatory Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 text-slate-700">
                        @forelse($sellers as $seller)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6 font-bold text-gray-900 text-base">
                                    {{ $seller->brand_name }}
                                </td>
                                
                                <td class="p-4 text-gray-600">
                                    {{ $seller->business_category ?? 'N/A' }}
                                </td>

                                <td class="p-4 text-gray-500 text-xs">
                                    {{ $seller->created_at ? $seller->created_at->format('M d, Y') : 'N/A' }}
                                </td>
                                
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full border
                                        {{ $seller->verification_status === 'verified' ? 'bg-green-50 text-green-700 border-green-200' : ($seller->verification_status === 'rejected' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200') }}">
                                        {{ ucfirst($seller->verification_status ?? 'Pending') }}
                                    </span>
                                </td>
                                
                                <td class="p-4 pr-6 text-right">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                                        🔒 Admin Vetted Record
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-400 font-medium">
                                    No registered seller profiles found in system databases.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection