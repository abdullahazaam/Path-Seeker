@extends('layouts.app')
@section('title', 'Resource Library — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8"
     x-data="{
         showPreviewModal: false,
         activeResource: null,
         openPreview(item) {
             this.activeResource = item;
             this.showPreviewModal = true;
             document.body.style.overflow = 'hidden';
         },
         closePreview() {
             this.showPreviewModal = false;
             document.body.style.overflow = 'auto';
         }
     }">

    {{-- ══════════════════ HERO RESOURCE BANNER ══════════════════ --}}
    <div data-aos="fade-up" class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-blue-500/10 dark:bg-blue-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-4 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/15 border border-cyan-500/25 text-xs font-semibold text-cyan-700 dark:text-cyan-300 shadow-sm font-mono">
                    <i class="fa-solid fa-book-bookmark text-cyan-500 dark:text-cyan-400"></i>
                    <span>Verified Career Assets &amp; Blueprints</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white leading-tight font-display">
                    Resource <span class="bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 bg-clip-text text-transparent">Library</span>
                </h1>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                    Explore interactive document previews for verified resume blueprints, system design cheat sheets, interview roadmaps, and career transition toolkits.
                </p>
            </div>

            <div class="px-8 py-6 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center shrink-0 shadow-sm backdrop-blur-md">
                <div class="text-3xl sm:text-4xl font-black text-cyan-600 dark:text-cyan-400 font-display">{{ $resources->total() }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium mt-1 font-mono">Toolkits Available</div>
            </div>
        </div>
    </div>

    {{-- ══════════════════ SEARCH & FILTER CONSOLE ══════════════════ --}}
    <div data-aos="fade-up" data-aos-delay="100" class="relative rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-4 overflow-hidden">
        <form action="{{ url('/resources') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end relative z-10">
            <div class="md:col-span-6">
                <label for="search" class="text-xs font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-magnifying-glass text-cyan-500 dark:text-cyan-400 text-xs"></i>
                    <span>Search Toolkits &amp; Engineering Documents</span>
                </label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Search by title or topic (e.g. System Design, Resume, Cheat Sheet)..."
                           class="app-input w-full px-4 py-3 rounded-xl text-sm pl-10 focus:ring-2 focus:ring-cyan-500/30">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
            </div>
            <div class="md:col-span-4">
                <label for="category" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-400 text-xs"></i>
                    <span>Asset Category</span>
                </label>
                <select name="category" id="category" class="app-input w-full px-4 py-3 rounded-xl text-sm">
                    <option value="">All Categories ({{ isset($categories) ? count($categories) : 0 }})</option>
                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="btn-sweep flex-1 py-3 font-black text-sm rounded-xl text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-lg shadow-cyan-500/20 transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105 cursor-pointer">
                    <i class="fa-solid fa-sliders text-xs text-slate-950"></i>
                    <span class="text-slate-950 font-black">Filter</span>
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('resources.index') }}" class="px-3 py-3 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 transition-all flex items-center justify-center" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
        @if(isset($categories) && count($categories) > 0)
            <div class="mt-4 pt-3.5 border-t border-slate-200/60 dark:border-white/[0.06] flex items-center gap-2 overflow-x-auto pb-2.5 [&::-webkit-scrollbar]:h-1.5 [&::-webkit-scrollbar-track]:bg-slate-900/40 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-thumb]:bg-cyan-600/40 hover:[&::-webkit-scrollbar-thumb]:bg-cyan-500/70 [&::-webkit-scrollbar-thumb]:rounded-full relative z-10">
                <span class="text-[10px] font-bold text-slate-500 shrink-0 uppercase tracking-wider font-mono">Quick Filter:</span>
                <a href="{{ route('resources.index') }}" class="px-3 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 font-mono {{ !request('category') ? 'border-cyan-500/50 text-cyan-700 dark:text-cyan-300 bg-cyan-500/15 dark:bg-cyan-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                    All Categories
                </a>
                @foreach($categories as $c)
                    <a href="{{ route('resources.index', ['category' => $c]) }}" class="px-3 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 font-mono {{ request('category') === $c ? 'border-cyan-500/50 text-cyan-700 dark:text-cyan-300 bg-cyan-500/15 dark:bg-cyan-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                        {{ $c }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ══════════════════ ROW HEADER ══════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2 border-b border-slate-200/80 dark:border-white/[0.07] pb-4 reveal-element">
        <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-cyan-600 dark:text-cyan-400 flex items-center gap-2 font-mono">
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch" data-stagger-grid id="resourcesGrid">
        @forelse($resources as $res)
            @php
                $id = $res->id;
                $titleLower = strtolower($res->title);
                
                if (str_contains($titleLower, 'architecture') || str_contains($titleLower, 'advanced') || str_contains($titleLower, 'expert') || $id % 3 === 0) {
                    $level = 'Advanced';
                    $levelBadge = 'bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border-cyan-500/25';
                    $levelDot = 'bg-cyan-400';
                } elseif (str_contains($titleLower, 'cheat') || str_contains($titleLower, 'guide') || str_contains($titleLower, 'roadmap') || $id % 3 === 2) {
                    $level = 'Intermediate';
                    $levelBadge = 'bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/25';
                    $levelDot = 'bg-amber-400';
                } else {
                    $level = 'Beginner';
                    $levelBadge = 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/25';
                    $levelDot = 'bg-emerald-400';
                }

                $docType = 'PDF Document';
                $docIcon = 'fa-file-pdf text-cyan-400';
                if (str_contains($titleLower, 'cheat sheet') || str_contains($titleLower, 'cheatsheet')) {
                    $docType = 'Cheat Sheet';
                    $docIcon = 'fa-file-code text-cyan-400';
                } elseif (str_contains($titleLower, 'kit') || str_contains($titleLower, 'template')) {
                    $docType = 'Asset Kit';
                    $docIcon = 'fa-file-lines text-sky-400';
                }

                $itemData = json_encode([
                    'id' => $res->id,
                    'title' => $res->title,
                    'category' => $res->category,
                    'file_url' => $res->file_url,
                    'stream_url' => route('resources.stream', $res->id),
                    'download_url' => route('resources.download', $res->id),
                    'description' => $res->description ?? 'Verified engineering blueprint and technical reference checklist.',
                    'file_type' => $res->file_type ?? 'PDF',
                    'level' => $level,
                    'download_count' => $res->download_count ?? 0,
                ]);
            @endphp

            <div data-aos="fade-up" data-aos-delay="{{ (($loop->iteration - 1) % 6 + 1) * 80 }}" class="app-card bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 rounded-3xl p-6 flex flex-col justify-between h-full group relative overflow-hidden shadow-md dark:shadow-sm hover:shadow-xl hover:border-cyan-500/40 hover:-translate-y-1 transition-all duration-300">
                
                <div class="relative z-10 flex flex-col flex-grow">
                    
                    {{-- Document Cover Preview Container (Intercept Click -> Open Preview Modal) --}}
                    <div @click="openPreview({{ $itemData }})" 
                         class="relative w-full h-48 overflow-hidden rounded-2xl mb-4 bg-slate-100 dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shrink-0 group/thumb cursor-pointer">
                        <img src="{{ !empty($res->thumbnail_url) ? $res->thumbnail_url : 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80' }}"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80';"
                             alt="{{ $res->title }}"
                             loading="lazy"
                             class="w-full h-full object-cover block rounded-2xl group-hover/thumb:scale-105 transition-transform duration-500 ease-out">
                        
                        {{-- Dark Document Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-black/20 to-transparent pointer-events-none"></div>
                        
                        {{-- Quick Preview Trigger Overlay --}}
                        <div class="absolute inset-0 flex items-center justify-center z-10" aria-label="Preview {{ $res->title }}">
                            <div class="w-12 h-12 rounded-full bg-white/90 dark:bg-slate-900/90 text-cyan-600 dark:text-cyan-400 flex items-center justify-center shadow-lg group-hover/thumb:scale-110 transition-transform duration-300 border border-white/40 dark:border-white/20">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </div>
                        </div>

                        {{-- Category Badge --}}
                        <div class="absolute top-3 left-3 z-20 pointer-events-none">
                            <span class="text-[10px] font-semibold uppercase px-2.5 py-1 rounded-full bg-slate-900/80 dark:bg-black/75 text-white border border-white/15 backdrop-blur-md flex items-center gap-1.5 shadow-sm font-mono">
                                <i class="fa-solid fa-folder text-cyan-400 text-[9px]"></i>
                                <span>{{ $res->category }}</span>
                            </span>
                        </div>

                        {{-- Format Badge --}}
                        <div class="absolute bottom-3 right-3 z-20 pointer-events-none">
                            <span class="px-2.5 py-1 text-[10px] font-mono font-semibold text-white bg-slate-900/80 dark:bg-black/75 rounded-full backdrop-blur-md flex items-center gap-1 border border-white/15 shadow-sm">
                                <i class="fa-solid {{ $docIcon }} text-[9px]"></i>
                                <span>{{ $docType }}</span>
                            </span>
                        </div>
                    </div>

                    {{-- Text Details & Difficulty Level --}}
                    <div class="space-y-3 flex-grow flex flex-col justify-start">
                        <div class="flex items-center justify-between gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-semibold border font-mono {{ $levelBadge }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $levelDot }}"></span>
                                <span>{{ $level }}</span>
                            </span>
                            <span class="text-[10px] text-slate-400 font-mono">Verified 2026</span>
                        </div>

                        <h3 class="text-base font-black text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors leading-snug font-display cursor-pointer"
                            @click="openPreview({{ $itemData }})">
                            {{ $res->title }}
                        </h3>

                        <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $res->description ?? 'Verified technical document including architecture diagrams, industry workflows, and core reference checklists.' }}
                        </p>
                    </div>

                </div>

                {{-- Bottom Action Row (1. Intercept Download Click -> Open Auto-Preview Modal) --}}
                <div class="mt-5 pt-4 border-t border-slate-200/80 dark:border-white/[0.07] relative z-10">
                    <button type="button" 
                            @click="openPreview({{ $itemData }})"
                            class="w-full py-2.5 px-4 rounded-xl text-xs font-black text-center text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-md shadow-cyan-500/20 hover:scale-[1.02] transition-all flex items-center justify-center gap-2 group/link cursor-pointer">
                        <i class="fa-solid fa-eye text-xs text-slate-950"></i>
                        <span class="text-slate-950 font-black">Preview &amp; Download Toolkit</span>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-950 group-hover/link:translate-x-1 transition-transform"></i>
                    </button>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 rounded-3xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center space-y-3 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-2xl mx-auto mb-2 shadow-sm">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <p class="text-base font-bold text-slate-900 dark:text-slate-300">No resources matched your filter.</p>
                <a href="{{ route('resources.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 text-cyan-600 dark:text-cyan-300 border border-cyan-500/20 text-xs font-bold hover:bg-cyan-500/20 transition-all font-mono">
                    <i class="fa-solid fa-rotate-left"></i> Reset Filter
                </a>
            </div>
        @endforelse
    </div>

    {{-- ══════════════════ UNIFIED PAGINATION CONTROLS ══════════════════ --}}
    @if ($resources->hasPages())
        <div class="rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 relative overflow-hidden">
            {{-- Ambient decorative glow --}}
            <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-2xl pointer-events-none"></div>

            <p class="relative z-10 text-xs text-slate-600 dark:text-slate-400 font-medium">
                Showing <strong class="text-slate-900 dark:text-white font-bold">{{ $resources->firstItem() }}</strong> to <strong class="text-slate-900 dark:text-white font-bold">{{ $resources->lastItem() }}</strong> of <strong class="text-slate-900 dark:text-white font-bold">{{ $resources->total() }}</strong> Toolkits
            </p>

            <div class="relative z-10 flex items-center gap-2">
                @if ($resources->onFirstPage())
                    <span class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100/50 dark:bg-white/[0.02] text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-white/5 cursor-not-allowed select-none flex items-center gap-1.5">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        <span>Previous</span>
                    </span>
                @else
                    <a href="{{ $resources->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100 dark:bg-white/[0.04] hover:bg-slate-200 dark:hover:bg-white/[0.08] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-all flex items-center gap-1.5 hover:scale-105 shadow-xs">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        <span>Previous</span>
                    </a>
                @endif

                <div class="hidden sm:flex items-center gap-1.5">
                    @foreach ($resources->appends(request()->query())->getUrlRange(1, $resources->lastPage()) as $page => $url)
                        @if ($page == $resources->currentPage())
                            <span class="px-4 py-2.5 text-xs font-black rounded-2xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 text-slate-950 font-black shadow-lg shadow-cyan-500/25 border border-cyan-400/30 flex items-center justify-center min-w-[40px]">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100 dark:bg-white/[0.04] hover:bg-slate-200 dark:hover:bg-white/[0.08] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-all flex items-center justify-center min-w-[40px] hover:scale-105 shadow-xs">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                @if ($resources->hasMorePages())
                    <a href="{{ $resources->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100 dark:bg-white/[0.04] hover:bg-slate-200 dark:hover:bg-white/[0.08] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-all flex items-center gap-1.5 hover:scale-105 shadow-xs">
                        <span>Next</span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                @else
                    <span class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100/50 dark:bg-white/[0.02] text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-white/5 cursor-not-allowed select-none flex items-center gap-1.5">
                        <span>Next</span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif

    {{-- ══════════════════ 2 & 3. AUTO-PREVIEW GLASSMORPHIC MODAL ══════════════════ --}}
    <div x-show="showPreviewModal" 
         x-cloak 
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/85 backdrop-blur-xl transition-all duration-300">
        
        <div @click.outside="closePreview()" 
             class="relative w-full max-w-4xl max-h-[92vh] rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/15 shadow-2xl flex flex-col overflow-hidden text-slate-900 dark:text-white">
            
            {{-- Ambient Corner Glow --}}
            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/15 blur-3xl pointer-events-none"></div>

            {{-- Modal Header --}}
            <div class="relative z-10 p-5 sm:p-6 bg-slate-50 dark:bg-slate-950/80 border-b border-slate-200 dark:border-white/10 flex items-start justify-between gap-4">
                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25" 
                              x-text="activeResource?.category || 'Engineering Blueprint'"></span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/25">
                            <i class="fa-solid fa-shield-check mr-1"></i> Verified Safe
                        </span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-black font-display text-slate-900 dark:text-white leading-snug" 
                        x-text="activeResource?.title"></h3>
                </div>

                <button type="button" 
                        @click="closePreview()"
                        class="w-9 h-9 rounded-xl bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-300 dark:hover:bg-white/20 transition-all flex items-center justify-center cursor-pointer shrink-0">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            {{-- Modal Document Preview Frame --}}
            <div class="relative z-10 p-4 sm:p-6 flex-1 overflow-y-auto space-y-4">
                <div class="w-full h-80 sm:h-[480px] rounded-2xl bg-slate-950 border border-slate-200 dark:border-white/10 overflow-hidden relative shadow-inner">
                    <template x-if="activeResource">
                        <object :data="(activeResource.stream_url || activeResource.file_url) + '#toolbar=0&view=FitH'" 
                                type="application/pdf" 
                                class="w-full h-full border-0">
                            <iframe :src="(activeResource.stream_url || activeResource.file_url) + '#toolbar=0'"
                                    class="w-full h-full border-0"
                                    :title="activeResource.title"
                                    loading="lazy">
                                <div class="p-8 text-center space-y-3">
                                    <p class="text-sm text-slate-300">Your browser does not support in-line PDF previews.</p>
                                    <a :href="activeResource.download_url" class="btn-sweep px-5 py-2 rounded-xl text-xs font-black text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600">Download PDF</a>
                                </div>
                            </iframe>
                        </object>
                    </template>
                </div>

                {{-- Document Metadata Details --}}
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-white/[0.03] border border-slate-200/80 dark:border-white/5 space-y-1">
                    <div class="text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider">
                        <i class="fa-solid fa-circle-info mr-1"></i> Blueprint Description
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed" 
                       x-text="activeResource?.description"></p>
                </div>
            </div>

            {{-- Modal Footer with Download Action --}}
            <div class="relative z-10 p-5 sm:p-6 bg-slate-50 dark:bg-slate-950/80 border-t border-slate-200 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-2">
                    <i class="fa-solid fa-file-shield text-cyan-500"></i>
                    <span>Direct HTTPS download verified by PathSeeker Security</span>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="button" 
                            @click="closePreview()"
                            class="flex-1 sm:flex-none px-5 py-2.5 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 bg-slate-200 dark:bg-white/10 hover:bg-slate-300 dark:hover:bg-white/20 transition-all cursor-pointer">
                        Close
                    </button>

                    {{-- 3. ACTUAL DOWNLOAD FILE BUTTON INSIDE PREVIEW MODAL --}}
                    <template x-if="activeResource">
                        <a :href="activeResource.download_url" 
                           class="flex-1 sm:flex-none btn-sweep px-7 py-2.5 rounded-xl font-black text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-md shadow-cyan-500/25 transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-file-arrow-down text-slate-950"></i>
                            <span class="text-slate-950 font-black">Download File</span>
                        </a>
                    </template>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
