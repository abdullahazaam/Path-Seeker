@extends('layouts.app')
@section('title', 'Set New Password — PathSeeker')
@section('content')

<div class="max-w-md mx-auto px-4 py-16">
    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto shadow-sm">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-display">New Password</h1>
            <p class="text-xs text-slate-600 dark:text-slate-400">
                Choose a strong new password for your PathSeeker passport.
            </p>
        </div>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required value="{{ old('email', $email) }}" class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                @error('email')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">New Password</label>
                <input type="password" name="password" id="password" required minlength="6" class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                @error('password')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required minlength="6" class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit" class="btn-sweep w-full py-3.5 rounded-full font-black text-xs text-white bg-gradient-to-r from-indigo-600 to-purple-600 shadow-md">
                Save New Password
            </button>
        </form>
    </div>
</div>

@endsection
