@extends('layouts.app')
@section('title', 'Feedback Discussion & Official Reply — PathSeeker')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    {{-- Breadcrumbs & Back Navigation --}}
    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-mono text-slate-500 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('feedback.index') }}" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Feedback</a>
            <span>/</span>
            <span class="text-slate-800 dark:text-slate-200 font-bold">Ticket #{{ $feedback->id }}</span>
        </div>

        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-xs font-bold text-slate-700 dark:text-slate-300 transition-all inline-flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>

    {{-- Main Thread Container --}}
    <div class="p-6 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl space-y-8">
        
        {{-- Thread Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-white/10">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider font-mono
                        {{ $feedback->category === 'bug' ? 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25' : ($feedback->category === 'suggestion' ? 'bg-purple-500/15 text-purple-700 dark:text-purple-400 border border-purple-500/25' : 'bg-indigo-500/15 text-indigo-700 dark:text-indigo-400 border border-indigo-500/25') }}">
                        <i class="fa-solid fa-tag mr-1 text-[10px]"></i>{{ ucfirst($feedback->category) }} Ticket
                    </span>

                    <span class="px-3 py-1 rounded-full text-xs font-bold font-mono
                        {{ $feedback->status === 'resolved' ? 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25' : ($feedback->status === 'in_review' ? 'bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/25' : 'bg-sky-500/15 text-sky-700 dark:text-sky-400 border border-sky-500/25') }}">
                        <i class="fa-solid fa-circle text-[8px] mr-1.5 {{ $feedback->status === 'resolved' ? 'text-emerald-500' : ($feedback->status === 'in_review' ? 'text-amber-500' : 'text-sky-500') }}"></i>
                        Status: {{ ucfirst(str_replace('_', ' ', $feedback->status)) }}
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display">Feedback Inquiry &amp; Official Response</h1>
            </div>

            <div class="text-xs font-mono text-slate-400">
                Submitted on {{ $feedback->created_at->format('M d, Y · h:i A') }}
            </div>
        </div>

        {{-- 1. Original User Submission --}}
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center text-white font-black text-sm shadow-md">
                    {{ substr($feedback->name ?? 'User', 0, 1) }}
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">{{ $feedback->name ?? 'You' }}</h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-mono">Original Message</p>
                </div>
            </div>

            <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-slate-200 text-sm sm:text-base leading-relaxed">
                {{ $feedback->message }}
            </div>
        </div>

        {{-- 2. Official Administrator Response --}}
        @if($feedback->admin_response)
            <div class="space-y-3 pt-2">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white text-base shadow-md shadow-emerald-500/20">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-sm font-black text-slate-900 dark:text-white">{{ $feedback->responder?->name ?? 'PathSeeker Core Support' }}</h3>
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-black uppercase font-mono bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25">
                                    Official Response
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 font-mono">
                                Responded {{ $feedback->responded_at ? $feedback->responded_at->diffForHumans() : 'recently' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-gradient-to-br from-emerald-500/[0.07] via-teal-500/[0.04] to-transparent border border-emerald-500/30 text-slate-900 dark:text-slate-100 text-sm sm:text-base leading-relaxed shadow-lg shadow-emerald-500/5 space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider font-mono">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>Engineering Team Update</span>
                    </div>
                    <p class="whitespace-pre-line text-slate-800 dark:text-slate-200">{{ $feedback->admin_response }}</p>
                </div>
            </div>
        @else
            <div class="p-6 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center gap-3 text-amber-800 dark:text-amber-300 text-xs">
                <i class="fa-solid fa-hourglass-half text-lg text-amber-500 shrink-0"></i>
                <div>
                    <span class="font-bold">Pending Administrator Review:</span> Your ticket has been assigned to our engineering support queue. You will receive an immediate live notification once a staff member reviews and responds.
                </div>
            </div>
        @endif

        {{-- Actions Footer --}}
        <div class="pt-6 border-t border-slate-200 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <a href="{{ route('feedback.index') }}" class="text-xs font-bold text-purple-600 dark:text-purple-400 hover:underline flex items-center gap-1.5">
                <i class="fa-solid fa-list-check text-[10px]"></i>
                <span>View all your submissions &rarr;</span>
            </a>

            <a href="{{ url('/#feedback-section') }}" class="btn-sweep px-6 py-2.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 shadow-md">
                <span>Submit Another Feedback</span>
            </a>
        </div>

    </div>

</div>

@endsection
