@extends('layouts.app')
@section('title', $resource->title . ' — Technical Resource Preview')
@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 space-y-6">

    {{-- Back Link --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('resources.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-purple-300 transition-colors group">
            <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
            <span>Back to Resource Library</span>
        </a>

        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-sky-500/15 text-sky-700 dark:text-sky-300 border border-sky-500/25">
                <i class="fa-solid fa-file-pdf mr-1"></i> {{ strtoupper($resource->file_type ?? 'PDF') }} Document
            </span>
        </div>
    </div>

    {{-- Main Document Card --}}
    <div class="relative rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 overflow-hidden shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-sky-500/10 dark:bg-sky-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <!-- Header -->
        <div class="relative z-10 bg-slate-50 dark:bg-slate-950/60 p-6 sm:p-8 border-b border-slate-200/80 dark:border-white/10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-500/15 text-sky-700 dark:text-sky-300 border border-sky-500/25 font-mono shadow-sm">
                            <i class="fa-solid fa-folder text-[10px]"></i>
                            <span>{{ $resource->category }}</span>
                        </span>
                        @if($resource->is_premium)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-amber-500/15 text-amber-700 dark:text-amber-300 border border-amber-500/25">
                                <i class="fa-solid fa-crown text-amber-500 mr-1"></i> Premium
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-snug font-display">{{ $resource->title }}</h1>
                </div>
                <div class="text-xs text-slate-600 dark:text-slate-400 font-mono shrink-0 flex sm:flex-col items-end gap-1">
                    <span><i class="fa-solid fa-download mr-1 text-sky-500"></i>{{ $resource->download_count ?? 0 }} Downloads</span>
                    <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold">Verified 2026</span>
                </div>
            </div>
        </div>

        {{-- Document Viewer Frame --}}
        <div class="relative z-10 p-6 sm:p-8 space-y-6">
            <div class="rounded-2xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-slate-950 shadow-2xl relative">
                <div class="w-full h-[550px] bg-slate-900 flex flex-col">
                    <iframe src="{{ $resource->file_url }}#toolbar=0" 
                            class="w-full h-full border-0 rounded-2xl"
                            title="{{ $resource->title }}"
                            loading="lazy"></iframe>
                </div>
            </div>

            <!-- Description -->
            @if($resource->description)
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/10 space-y-2">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-2 font-display">
                        <i class="fa-solid fa-circle-info text-sky-600 dark:text-sky-400"></i>
                        <span>Document Overview &amp; Specifications</span>
                    </h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                        {{ $resource->description }}
                    </p>
                </div>
            @endif

            <!-- Action Bar with Prominent Download Button -->
            <div class="p-6 rounded-2xl bg-gradient-to-r from-sky-500/10 via-indigo-500/10 to-purple-500/10 border border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h4 class="text-sm font-black text-slate-900 dark:text-white font-display">Ready to download this blueprint?</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">Secure, verified download with zero ads or tracking.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('resources.download', $resource->id) }}" class="btn-sweep px-8 py-3 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-sky-600 via-indigo-600 to-purple-600 hover:from-sky-500 hover:via-indigo-500 hover:to-purple-500 shadow-lg shadow-sky-500/25 transition-all flex items-center justify-center gap-2">
                        <i class="fa-solid fa-file-arrow-down text-white"></i>
                        <span class="text-white">Download File</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
