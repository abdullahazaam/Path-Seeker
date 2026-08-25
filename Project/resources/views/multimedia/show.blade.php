@extends('layouts.app')
@section('title', $item->title . ' — Multimedia Center')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 space-y-6">

    <a href="{{ route('multimedia.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-purple-300 transition-colors group">
        <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
        <span>Back to Multimedia Hub</span>
    </a>

    <div class="relative rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 overflow-hidden shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-rose-500/10 dark:bg-rose-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>

        <!-- Header -->
        <div class="relative z-10 bg-slate-100/70 dark:bg-slate-950/60 p-7 sm:p-8 border-b border-slate-200/80 dark:border-white/10 ">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $item->type === 'video' ? 'bg-rose-500/15 text-rose-700 dark:text-rose-300 border border-rose-500/25' : 'bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25' }} font-mono shadow-sm">
                        <i class="fa-solid {{ $item->type === 'video' ? 'fa-video' : 'fa-headphones' }} text-[10px]"></i>
                        <span>{{ $item->type === 'video' ? 'Video Masterclass' : 'Audio Podcast' }}</span>
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-snug font-display">{{ $item->title }}</h1>
                </div>
                <span class="text-xs text-slate-600 dark:text-slate-400 font-mono shrink-0">Duration: {{ $item->duration ?? '25:00' }}</span>
            </div>
        </div>

        <!-- In-App Streaming Video/Audio Player -->
        <div class="relative z-10 p-6 sm:p-8 space-y-6">
            <div class="rounded-2xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-slate-950 shadow-2xl relative">
                @if($item->type === 'video' || str_contains($item->url, 'youtube') || str_contains($item->url, 'youtu.be'))
                    <div class="aspect-video w-full bg-slate-950 relative">
                        <iframe class="w-full h-full rounded-2xl"
                                src="{{ $item->getEmbedUrl() }}?rel=0&modestbranding=1&enablejsapi=1"
                                title="{{ $item->title }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen></iframe>
                    </div>
                    <div class="p-3 bg-slate-100/90 dark:bg-slate-900/90 border-t border-slate-200/80 dark:border-white/10 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-600 dark:text-slate-400">
                        <span class="flex items-center gap-1.5"><i class="fa-brands fa-youtube text-rose-500"></i> Interactive Masterclass Stream</span>
                        <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 font-bold flex items-center gap-1 transition-colors">
                            <span>Watch on YouTube</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                @else
                    <div class="py-14 px-8 text-center space-y-6 bg-slate-100/80 dark:bg-slate-950/50">
                        <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center text-3xl shadow-md text-white">
                            <i class="fa-solid fa-podcast text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white font-display">Audio Stream / Podcast</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">High-definition career podcast</p>
                        </div>
                        <audio controls class="w-full max-w-md mx-auto">
                            <source src="{{ $item->url }}" type="audio/mpeg">
                            Your browser does not support audio playback.
                        </audio>
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($item->description)
                <div class="p-5 rounded-2xl bg-slate-100/80 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/[0.06] space-y-2">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-2 font-display">
                        <i class="fa-solid fa-circle-info text-indigo-600 dark:text-indigo-400"></i>
                        <span>Overview &amp; Learning Objectives</span>
                    </h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                        {{ $item->description }}
                    </p>
                </div>
            @endif

            <!-- Tags -->
            <div class="space-y-2">
                <div class="text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-400 flex items-center gap-1.5 font-mono">
                    <i class="fa-solid fa-tags text-indigo-600 dark:text-indigo-400 text-xs"></i>
                    <span>Topic Tags</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $item->tags) as $tag)
                        <span class="px-3 py-1.5 text-xs font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/10 text-slate-800 dark:text-slate-300 flex items-center gap-1.5 shadow-sm">
                            <i class="fa-solid fa-tag text-[9px] text-purple-600 dark:text-purple-400"></i>
                            <span>{{ trim($tag) }}</span>
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200/80 dark:border-white/10 flex flex-wrap gap-3">
                <a href="{{ route('multimedia.index') }}" class="btn-secondary px-5 py-2.5 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Browse All Media</span>
                </a>
                <a href="{{ route('careers.index') }}" class="btn-sweep px-5 py-2.5 rounded-xl font-black text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-md hover:shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-compass text-xs text-white"></i>
                    <span class="text-white">Explore Aligned Careers</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection