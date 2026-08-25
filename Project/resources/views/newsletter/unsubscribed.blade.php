@extends('layouts.app')
@section('title', 'Newsletter Unsubscribe — PathSeeker')
@section('content')

<div class="max-w-xl mx-auto px-4 sm:px-6 py-16 text-center space-y-6">
    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-5">
        @if(isset($error) && $error)
            <div class="w-16 h-16 rounded-2xl bg-rose-500/15 text-rose-600 dark:text-rose-400 flex items-center justify-center text-3xl mx-auto shadow-sm">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-display">Unsubscribe Error</h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">{{ $error }}</p>
        @else
            <div class="w-16 h-16 rounded-2xl bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-3xl mx-auto shadow-sm">
                <i class="fa-solid fa-envelope-circle-check"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-display">Unsubscribed Successfully</h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                Your email <strong class="text-slate-900 dark:text-white font-mono">{{ $subscriber?->email }}</strong> has been unsubscribed from the PathSeeker technical intelligence dispatch.
            </p>
            <div class="text-[11px] text-slate-500 dark:text-slate-400 font-mono pt-2">
                Status updated in database: <span class="text-rose-600 dark:text-rose-400 font-bold">Unsubscribed</span>
            </div>
        @endif

        <div class="pt-4">
            <a href="{{ route('home') }}" class="btn-sweep px-8 py-3 rounded-full font-bold text-xs text-white bg-gradient-to-r from-indigo-600 to-purple-600 shadow-md inline-flex items-center gap-2">
                <i class="fa-solid fa-house text-xs"></i>
                <span>Return to Homepage</span>
            </a>
        </div>
    </div>
</div>

@endsection
