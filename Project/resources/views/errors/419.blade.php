@extends('layouts.app')
@section('title', '419 — Session Expired | PathSeeker')
@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6 p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-amber-500/30 shadow-2xl">
        <div class="w-16 h-16 rounded-2xl bg-amber-500/15 border border-amber-500/25 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl mx-auto font-mono font-black">
            419
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-display">Session Expired</h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                Your secure session verification token has expired. Please refresh the page and try again.
            </p>
        </div>
        <div class="pt-2">
            <a href="{{ route('login') }}" class="btn-sweep inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold text-white bg-gradient-to-r from-amber-600 to-purple-600 hover:from-amber-500 hover:to-purple-500 shadow-md">
                <i class="fa-solid fa-arrow-rotate-right"></i>
                <span>Sign In Again</span>
            </a>
        </div>
    </div>
</div>
@endsection
