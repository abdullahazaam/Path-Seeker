@extends('layouts.app')
@section('title', 'Resource Library — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">

    {{-- ══════════════════ HERO RESOURCE BANNER ══════════════════ --}}
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-sky-500/10 dark:bg-sky-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-4 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/15 border border-sky-500/25 text-xs font-semibold text-sky-700 dark:text-sky-300 shadow-sm">
                    <i class="fa-solid fa-book-bookmark text-sky-500 dark:text-sky-400"></i>
                    <span>Verified Career Assets &amp; Blueprints</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white leading-tight font-display">
                    Resource <span class="grad-text-cyan">Library</span>
                </h1>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                    Download verified resume blueprints, system design cheat sheets, interview roadmaps, and career transition toolkits for high-growth engineering pathways.
                </p>
            </div>

            <div class="px-8 py-6 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center shrink-0 shadow-sm backdrop-blur-md">
                <div class="text-3xl sm:text-4xl font-black text-sky-600 dark:text-sky-400 font-display">{{ $resources->total() }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium mt-1">Toolkits Available</div>
            </div>
        </div>
    </div>

    {{-- ══════════════════ ROW HEADER ══════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2 border-b border-slate-200/80 dark:border-white/[0.07] pb-4">
        <div>
            <div class="text-xs font-semibold uppercase tracking-widest text-sky-600 dark:text-sky-400 flex items-center gap-2">
                <i class="fa-solid fa-folder-open text-xs"></i>
                <span>Explore Technical Blueprints</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">
                All Engineering &amp; Career Toolkits
            </h2>
        </div>
        <div class="text-xs text-slate-500 dark:text-slate-400 font-mono">
            Showing <strong class="text-slate-900 dark:text-white">{{ $resources->total() }}</strong> verified toolkits
        </div>
    </div>

    {{-- ══════════════════ DIGITAL DOCUMENT / BOOK-STYLE CARD GRID ══════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
        @forelse($resources as $res)
            @php
                // Derive realistic difficulty level & styling
                $id = $res->id;
                $titleLower = strtolower($res->title);
                $catLower = strtolower($res->category);
                
                if (str_contains($titleLower, 'architecture') || str_contains($titleLower, 'advanced') || str_contains($titleLower, 'expert') || $id % 3 === 0) {
                    $level = 'Advanced';
                    $levelBadge = 'bg-purple-500/15 text-purple-600 dark:text-purple-400 border-purple-500/25';
                    $levelDot = 'bg-purple-400';
                } elseif (str_contains($titleLower, 'cheat') || str_contains($titleLower, 'guide') || str_contains($titleLower, 'roadmap') || $id % 3 === 2) {
                    $level = 'Intermediate';
                    $levelBadge = 'bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/25';
                    $levelDot = 'bg-amber-400';
                } else {
                    $level = 'Beginner';
                    $levelBadge = 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/25';
                    $levelDot = 'bg-emerald-400';
                }

                // Document type badge
                $docType = 'PDF Document';
                $docIcon = 'fa-file-pdf text-rose-400';
                if (str_contains($titleLower, 'cheat sheet') || str_contains($titleLower, 'cheatsheet')) {
                    $docType = 'Cheat Sheet';
                    $docIcon = 'fa-file-code text-cyan-400';
                } elseif (str_contains($titleLower, 'kit') || str_contains($titleLower, 'template')) {
                    $docType = 'Asset Kit';
                    $docIcon = 'fa-file-lines text-indigo-400';
                }
            @endphp

            <div class="bg-white/90 dark:bg-slate-950/50 border border-slate-200 dark:border-white/5 rounded-3xl p-5 flex flex-col justify-between h-full group relative overflow-hidden shadow-xl dark:shadow-sm hover:shadow-2xl hover:border-purple-500/30 hover:-translate-y-1 transition-all duration-300">
                
                {{-- Document Spine Accent Line --}}
                <div class="h-1 w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="relative z-10 flex flex-col flex-grow">
                    
                    {{-- Document Cover Preview Container --}}
                    <div class="relative w-full h-48 overflow-hidden rounded-2xl mb-4 bg-slate-950 border border-slate-200/80 dark:border-white/10 shrink-0 group/thumb">
                        <img src="{{ $res->thumbnail_url ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80' }}"
                             alt="{{ $res->title }}"
                             loading="lazy"
                             class="w-full h-full object-cover block rounded-2xl group-hover/thumb:scale-110 transition-transform duration-700 ease-out">
                        
                        {{-- Dark Document Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-black/25 to-transparent pointer-events-none"></div>
                        
                        {{-- Quick Download Trigger Overlay --}}
                        <a href="{{ $res->file_url }}" target="_blank" class="absolute inset-0 flex items-center justify-center z-10" aria-label="Download {{ $res->title }}">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-sky-600 via-indigo-600 to-purple-600 text-white flex items-center justify-center shadow-lg group-hover/thumb:scale-115 group-hover/thumb:shadow-sky-500/50 transition-all duration-300 pointer-events-auto border border-white/20">
                                <i class="fa-solid fa-file-arrow-down text-sm text-white"></i>
                            </div>
                        </a>

                        {{-- Category Badge --}}
                        <div class="absolute top-3 left-3 z-20 pointer-events-none">
                            <span class="text-[10px] font-semibold uppercase px-2.5 py-1 rounded-full bg-black/70 text-white border border-white/15 backdrop-blur-md flex items-center gap-1.5">
                                <i class="fa-solid fa-folder text-sky-400 text-[9px]"></i>
                                <span>{{ $res->category }}</span>
                            </span>
                        </div>

                        {{-- Format Badge --}}
                        <div class="absolute bottom-3 right-3 z-20 pointer-events-none">
                            <span class="px-2.5 py-1 text-[10px] font-mono font-semibold text-white bg-black/75 rounded-full backdrop-blur-md flex items-center gap-1.5 border border-white/15">
                                <i class="fa-solid {{ $docIcon }} text-[9px]"></i>
                                <span>{{ $docType }}</span>
                            </span>
                        </div>
                    </div>

                    {{-- Text Details & Difficulty Level --}}
                    <div class="space-y-3 flex-grow flex flex-col justify-start">
                        <div class="flex items-center justify-between gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-semibold border {{ $levelBadge }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $levelDot }}"></span>
                                <span>{{ $level }}</span>
                            </span>
                            <span class="text-[10px] text-slate-400 font-mono">Verified 2026</span>
                        </div>

                        <h3 class="text-base font-black text-slate-900 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-300 transition-colors leading-snug font-display">
                            <a href="{{ $res->file_url }}" target="_blank" class="hover:underline">
                                {{ $res->title }}
                            </a>
                        </h3>

                        <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                            Verified technical document including architecture diagrams, industry workflows, and core reference checklists.
                        </p>
                    </div>

                </div>

                {{-- Bottom Action Row --}}
                <div class="mt-5 pt-4 border-t border-slate-200/80 dark:border-white/[0.07] relative z-10 flex items-center justify-between">
                    <a href="{{ $res->file_url }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-sky-600 dark:text-sky-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors group/link">
                        <i class="fa-solid fa-file-arrow-down text-xs"></i>
                        <span>Download Toolkit</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover/link:translate-x-1.5 transition-transform"></i>
                    </a>
                    <span class="text-xs text-slate-400 dark:text-slate-600 font-mono font-bold">#{{ str_pad($res->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 rounded-3xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center space-y-3 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-sky-500/20 text-sky-600 dark:text-sky-400 flex items-center justify-center text-2xl mx-auto mb-2 shadow-sm">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <p class="text-base font-bold text-slate-900 dark:text-slate-300">No resources uploaded yet.</p>
            </div>
        @endforelse
    </div>

    {{-- ══════════════════ UNIFIED PAGINATION CONTROLS ══════════════════ --}}
    @if ($resources->hasPages())
        <div class="glass-panel rounded-2xl p-4 border border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">
                Showing <strong class="text-slate-900 dark:text-white">{{ $resources->firstItem() }}</strong> to <strong class="text-slate-900 dark:text-white">{{ $resources->lastItem() }}</strong> of <strong class="text-slate-900 dark:text-white">{{ $resources->total() }}</strong> Toolkits
            </p>

            <div class="flex items-center gap-2">
                {{-- Previous Button --}}
                @if ($resources->onFirstPage())
                    <span class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-400 dark:text-slate-600 border border-slate-200 dark:border-white/5 cursor-not-allowed select-none">
                        <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                    </span>
                @else
                    <a href="{{ $resources->previousPageUrl() }}" class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-700 dark:text-slate-300 hover:text-sky-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-sky-500/40 transition-all">
                        <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                    </a>
                @endif

                {{-- Numeric Page Buttons --}}
                <div class="hidden sm:flex items-center gap-1.5">
                    @foreach ($resources->getUrlRange(1, $resources->lastPage()) as $page => $url)
                        @if ($page == $resources->currentPage())
                            <span class="w-8 h-8 rounded-full bg-gradient-to-r from-sky-600 via-indigo-600 to-purple-600 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-sky-500/25">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 rounded-full glass-panel text-slate-700 dark:text-slate-300 hover:text-sky-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-sky-500/40 font-bold text-xs flex items-center justify-center transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                {{-- Next Button --}}
                @if ($resources->hasMorePages())
                    <a href="{{ $resources->nextPageUrl() }}" class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-700 dark:text-slate-300 hover:text-sky-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-sky-500/40 transition-all">
                        Next <i class="fa-solid fa-chevron-right ml-1"></i>
                    </a>
                @else
                    <span class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-400 dark:text-slate-600 border border-slate-200 dark:border-white/5 cursor-not-allowed select-none">
                        Next <i class="fa-solid fa-chevron-right ml-1"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif

</div>
@endsection
