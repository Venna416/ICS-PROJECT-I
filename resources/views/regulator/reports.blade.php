@extends('layouts.app')

@section('content')
<div class="p-8 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Fraud & Scam Flags</h1>
        <a href="{{ route('regulator.dashboard') }}" class="text-sm text-indigo-600 font-medium">&larr; Dashboard</a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($reports as $report)
            <div class="bg-white p-6 rounded-xl border border-slate-200 border-l-4 border-l-rose-500 shadow-sm flex justify-between items-center">
                <div>
                    <span class="text-xs font-semibold text-rose-600 tracking-wider uppercase">Reported Flag</span>
                    <h3 class="font-bold text-slate-900 text-lg mt-0.5">Accused Seller: {{ $report->seller_name }}</h3>
                    <p class="text-sm text-slate-600 mt-2"><strong class="text-slate-800">Reason:</strong> {{ $report->reason }}</p>
                    <p class="text-sm text-slate-500 mt-1">{{ $report->description }}</p>
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('regulator.reports.resolve', $report->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-all shadow-sm">Mark Resolved</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white p-8 rounded-xl border border-dashed border-slate-300 text-center text-slate-400">Clear queue! No open fraud flags received.</div>
        @endforelse
    </div>
</div>
@endsection