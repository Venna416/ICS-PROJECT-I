@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Account Settings</h1>
                <p class="text-sm text-slate-500 mt-1">Update your administrative profile details and secure credentials.</p>
            </div>
            <a href="{{ route('regulator.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                &larr; Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in">
                <span class="text-lg">✨</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            
            <div class="h-1.5 bg-gradient-to-r from-violet-600 to-indigo-600"></div>

            <form action="{{ route('regulator.profile.update') }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Profile Information</h2>
                    <p class="text-xs text-slate-400">Your base identity details across the application.</p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full rounded-xl border border-slate-300 text-slate-900 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none shadow-sm"
                               placeholder="e.g. Brian">
                        @error('name') <span class="text-rose-500 text-xs font-medium mt-1.5 block">⚠️ {{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full rounded-xl border border-slate-300 text-slate-900 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none shadow-sm"
                               placeholder="brian@example.com">
                        @error('email') <span class="text-rose-500 text-xs font-medium mt-1.5 block">⚠️ {{ $message }}</span> @enderror
                    </div>
                </div>

                <hr class="border-slate-100 my-6">

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Security Credentials</h2>
                    <p class="text-xs text-slate-400">Leave password fields completely blank if you do not wish to modify them.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">New Password</label>
                        <input type="password" name="password" 
                               class="w-full rounded-xl border border-slate-300 text-slate-900 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none shadow-sm">
                        @error('password') <span class="text-rose-500 text-xs font-medium mt-1.5 block">⚠️ {{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full rounded-xl border border-slate-300 text-slate-900 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none shadow-sm">
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100 mt-8">
                    <a href="{{ route('regulator.dashboard') }}" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors border border-slate-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 transition-all shadow-sm font-medium">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection