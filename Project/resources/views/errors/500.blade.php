@extends('layouts.app')
@section('title', '500 — Server Encountered Error | PathSeeker')
@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6 p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200/80 dark:border-white/10 shadow-2xl">
        <div class="w-16 h-16 rounded-2xl bg-purple-500/15 border border-purple-500/25 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl mx-auto font-mono font-black">
            500
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-display">System Processing Notice</h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                An unexpected server condition occurred while processing career telemetry. Our engineering team has received the diagnostic trace.
            </p>
        </div>
        <div class="pt-2">
            <a href="{{ route('home') }}" class="btn-sweep inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-black text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_20px_rgba(0,242,254,0.35)]">
                <i class="fa-solid fa-house text-slate-950"></i>
                <span class="text-slate-950 font-black">Return to Home Portal</span>
            </a>
        </div>
    </div>
</div>
@endsection
