@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 px-6">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">💬 Review Moderation Center</h1>
                <p class="text-gray-600 mt-2">Filter out abusive, fraudulent, or synthetic consumer marketplace feedback.</p>
            </div>
            <a href="{{ route('regulator.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors bg-white px-4 py-2 border border-slate-200 rounded-xl shadow-sm">
                &larr; Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in">
                <span class="text-lg">✨</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-4">
            @forelse($reviews as $review)
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition-all hover:shadow-lg">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <h3 class="font-bold text-slate-900 text-lg">
                                Review for: <span class="text-indigo-600">{{ $review->sellerProfile->brand_name ?? 'Marketplace Listing' }}</span>
                            </h3>
                            
                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full 
                                {{ $review->status === 'hidden' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                {{ ucfirst($review->status ?? 'Active') }}
                            </span>
                        </div>
                        
                        <p class="text-slate-700 text-sm italic bg-slate-50 p-3 rounded-lg border border-slate-100">
                            "{{ $review->comment }}"
                        </p>
                        
                        <div class="flex items-center gap-4 text-xs text-slate-500 font-medium">
                            <span class="text-amber-500 font-bold text-sm">
                                {{ str_repeat('⭐', $review->rating) }} {{ $review->rating }}/5
                            </span>
                            <span>•</span>
                            <span>Submitted: {{ $review->created_at ? $review->created_at->diffForHumans() : 'Unknown' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto justify-end border-t border-slate-100 pt-3 md:pt-0 md:border-0">
                        @if($review->status !== 'hidden')
                            <form action="{{ route('regulator.reviews.hide', $review->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3.5 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded-lg transition-colors shadow-sm">
                                    Hide Review
                                </button>
                            </form>
                        @else
                            <form action="{{ route('regulator.reviews.restore', $review->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3.5 py-2 bg-slate-600 hover:bg-slate-700 text-white text-xs font-bold rounded-lg transition-colors shadow-sm">
                                    Restore Active
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('regulator.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently erase this review comment from marketplace records?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3.5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-lg transition-colors shadow-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white p-12 rounded-xl border border-dashed border-slate-300 text-center text-slate-400 font-medium">
                    📭 The moderation queue is clear. No customer feedback records found.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection