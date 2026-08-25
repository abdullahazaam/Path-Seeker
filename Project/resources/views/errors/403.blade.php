@extends('layouts.app')
@section('title', '403 — Access Forbidden | PathSeeker')
@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6 p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-rose-500/30 shadow-2xl">
        <div class="w-16 h-16 rounded-2xl bg-rose-500/15 border border-rose-500/25 text-rose-600 dark:text-rose-400 flex items-center justify-center text-2xl mx-auto font-mono font-black">
            403
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-display">Access Forbidden</h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                You do not possess the required administrative clearance or ownership privileges to access this endpoint.
            </p>
        </div>
        <div class="pt-2">
            <a href="{{ route('home') }}" class="btn-sweep inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold text-white bg-gradient-to-r from-rose-600 to-purple-600 hover:from-rose-500 hover:to-purple-500 shadow-md">
                <i class="fa-solid fa-house"></i>
                <span>Return to Safety</span>
            </a>
        </div>
    </div>
</div>
@endsection
