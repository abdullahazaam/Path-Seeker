@extends('layouts.app')
@section('title', $publicProfile['display_name'] . ' — Verified Career Passport')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    
    {{-- Verified Passport Card --}}
    <div class="p-8 sm:p-12 rounded-3xl bg-white/90 dark:bg-slate-900/70 backdrop-blur-2xl border border-purple-500/30 shadow-2xl space-y-8 relative overflow-hidden">
        
        {{-- Ambient decorative background glow --}}
        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-purple-500/15 blur-3xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative z-10">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 text-slate-950 flex items-center justify-center text-2xl font-black shadow-[0_0_20px_rgba(0,242,254,0.35)] shrink-0">
                    {{ substr($publicProfile['display_name'], 0, 1) }}
                </div>
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/25 text-xs font-mono font-bold">
                        <i class="fa-solid fa-certificate text-[10px]"></i>
                        <span>{{ $publicProfile['verified_status'] }}</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">
                        {{ $publicProfile['display_name'] }}
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">
                        {{ $publicProfile['role'] }} &bull; {{ $publicProfile['education_level'] }}
                    </p>
                </div>
            </div>

            <div class="text-left sm:text-right shrink-0 font-mono text-xs text-slate-400 space-y-1">
                <div>Shared: {{ $publicProfile['shared_at'] }}</div>
                <div>Passport Views: <span class="text-indigo-500 font-bold">{{ $publicProfile['views_count'] }}</span></div>
            </div>
        </div>

        {{-- Public Skills & Interests --}}
        <div class="pt-6 border-t border-slate-200/80 dark:border-white/10 space-y-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 font-mono">Core Focus &amp; Interests</h3>
            <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed bg-slate-100/60 dark:bg-white/[0.02] p-4 rounded-2xl border border-slate-200/60 dark:border-white/5">
                {{ $publicProfile['interests'] }}
            </p>
        </div>

        {{-- Verification Footer Notice --}}
        <div class="pt-6 border-t border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <span class="flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-emerald-500"></i>
                <span>Cryptographically Verified Career Passport by PathSeeker.</span>
            </span>
            <a href="{{ route('home') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">
                Explore Career Tracks &rarr;
            </a>
        </div>

    </div>

</div>

@endsection
