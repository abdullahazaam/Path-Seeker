@extends('layouts.app')
@section('title', 'Multimedia Center — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">
    {{-- ══════════════════ CINEMATIC HERO MASTERCLASS ══════════════════ --}}
    @php
        $heroItem = $multimedia->first();
    @endphp

    @if($heroItem && $multimedia->currentPage() == 1)
        <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
            {{-- Ambient Corner Glows --}}
            <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-rose-500/10 dark:bg-rose-500/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>

            <!-- Hero Spotlight Content -->
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-500/15 border border-rose-500/25 text-xs font-semibold text-rose-700 dark:text-rose-300 shadow-sm">
                            <i class="fa-solid fa-fire text-rose-500 dark:text-rose-400"></i>
                            <span>Featured Masterclass</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-purple-500/15 border border-purple-500/25 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                            <i class="fa-solid fa-bolt text-[10px] text-purple-500 dark:text-purple-400"></i>
                            <span>HD 1080p Stream</span>
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white leading-[1.1] font-display">
                        {{ $heroItem->title }}
                    </h1>

                    <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base line-clamp-3 leading-relaxed max-w-xl">
                        {{ $heroItem->description ?? 'Explore in-depth engineering walk-throughs, system design architectures, and career pivot strategies in high definition.' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('multimedia.show', $heroItem->id) }}" class="btn-sweep group inline-flex items-center gap-3 px-8 py-3.5 rounded-full font-bold text-sm text-white bg-gradient-to-r from-rose-600 via-purple-600 to-indigo-600 hover:from-rose-500 hover:via-purple-500 hover:to-indigo-500 shadow-lg shadow-purple-500/25 hover:shadow-purple-500/40 transition-all duration-300 hover:scale-105">
                            <i class="fa-solid fa-play text-xs text-white"></i>
                            <span class="text-white">Stream Masterclass</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-full bg-slate-100/80 dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/10 text-xs font-mono text-slate-700 dark:text-slate-300 backdrop-blur-md shadow-sm">
                            <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-indigo-500 dark:text-indigo-400"></i> {{ $heroItem->duration ?? '30:00' }}</span>
                            <span class="text-slate-300 dark:text-white/20">&bull;</span>
                            <span class="text-purple-600 dark:text-purple-300 font-semibold uppercase text-[10px]">{{ $heroItem->type }}</span>
                        </div>
                    </div>
                </div>

                <!-- Cinematic Video Preview Box -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200/80 dark:border-white/[0.12] aspect-video group cursor-pointer bg-slate-950">
                        <img src="{{ $heroItem->thumbnail_url ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80' }}"
                             alt="{{ $heroItem->title }}"
                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        
                        <a href="{{ route('multimedia.show', $heroItem->id) }}" class="absolute inset-0 flex items-center justify-center" aria-label="Play Masterclass">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-rose-600 via-purple-600 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-rose-500/30 group-hover:scale-115 transition-transform duration-300 border border-white/20">
                                <i class="fa-solid fa-play text-lg text-white ml-1"></i>
                            </div>
                        </a>

                        <div class="absolute bottom-3.5 left-3.5 right-3.5 flex items-center justify-between text-xs text-white/90 font-medium">
                            <span class="px-2.5 py-1 rounded-lg bg-black/60 backdrop-blur-md border border-white/10 text-[10px]">
                                <i class="fa-solid fa-sparkles text-rose-400 mr-1"></i> 4K Walkthrough
                            </span>
                            <span class="px-2.5 py-1 rounded-lg bg-black/60 backdrop-blur-md border border-white/10 text-[10px] font-mono">
                                {{ $heroItem->duration ?? '30:00' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ══════════════════ SEARCH & FILTER CONSOLE ══════════════════ --}}
    <div class="relative rounded-3xl p-6 sm:p-8 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-4 overflow-hidden">
        <form action="{{ url('/multimedia') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end relative z-10">
            <div class="md:col-span-6">
                <label for="search" class="text-xs font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-magnifying-glass text-rose-500 dark:text-rose-400 text-xs"></i>
                    <span>Search Masterclasses &amp; Tech Tracks</span>
                </label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Search by topic, keyword, or framework (e.g. AI, React, Cloud)..."
                           class="app-input w-full px-4 py-3 rounded-xl text-sm pl-10 focus:ring-2 focus:ring-rose-500/30">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
            </div>
            <div class="md:col-span-4">
                <label for="type" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-purple-600 dark:text-purple-400 text-xs"></i>
                    <span>Media Format</span>
                </label>
                <select name="type" id="type" class="app-input w-full px-4 py-3 rounded-xl text-sm">
                    <option value="">All Formats (Video &amp; Audio)</option>
                    <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>Video Masterclasses</option>
                    <option value="audio" {{ request('type') === 'audio' ? 'selected' : '' }}>Audio Podcasts</option>
                </select>
            </div>
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="btn-sweep flex-1 py-3 font-bold text-sm rounded-xl text-white bg-gradient-to-r from-rose-600 via-purple-600 to-indigo-600 hover:from-rose-500 hover:via-purple-500 hover:to-indigo-500 shadow-lg shadow-purple-500/20 transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105">
                    <i class="fa-solid fa-sliders text-xs text-white"></i>
                    <span class="text-white">Filter</span>
                </button>
                @if(request('search') || request('type') || request('tag'))
                    <a href="{{ route('multimedia.index') }}" class="px-3 py-3 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-rose-600 dark:hover:text-white bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 transition-all flex items-center justify-center" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
        @if(isset($allTags) && count($allTags) > 0)
            <div class="mt-4 pt-3.5 border-t border-slate-200/60 dark:border-white/[0.06] flex items-center gap-2 overflow-x-auto pb-2.5 [&::-webkit-scrollbar]:h-1.5 [&::-webkit-scrollbar-track]:bg-slate-900/40 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-thumb]:bg-purple-600/40 hover:[&::-webkit-scrollbar-thumb]:bg-purple-500/70 [&::-webkit-scrollbar-thumb]:rounded-full relative z-10">
                <span class="text-[10px] font-bold text-slate-500 shrink-0 uppercase tracking-wider">Quick Topics:</span>
                <a href="{{ route('multimedia.index') }}" class="px-3 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 {{ !request('tag') ? 'border-rose-500/50 text-rose-700 dark:text-rose-300 bg-rose-500/15 dark:bg-rose-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                    All Topics
                </a>
                @foreach($allTags as $tag)
                    <a href="{{ route('multimedia.index', ['tag' => $tag]) }}" class="px-3 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 {{ request('tag') === $tag ? 'border-rose-500/50 text-rose-700 dark:text-rose-300 bg-rose-500/15 dark:bg-rose-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                        {{ $tag }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ══════════════════ MEDIA ARCHIVE HEADER ══════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2 border-b border-slate-200/80 dark:border-white/[0.07] pb-4">
        <div>
            <div class="text-xs font-semibold uppercase tracking-widest text-purple-600 dark:text-purple-400 flex items-center gap-2">
                <i class="fa-solid fa-clapperboard text-xs"></i>
                <span>Multimedia Center</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">
                All Career Tracks &amp; Masterclasses
            </h2>
        </div>
        <div class="text-xs text-slate-500 dark:text-slate-400 font-mono">
            Showing <strong class="text-slate-900 dark:text-white">{{ $multimedia->total() }}</strong> streamable assets
        </div>
    </div>

    {{-- ══════════════════ VIDEO TRACKS GRID ══════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
        @forelse($multimedia as $item)
            <div class="bg-white/90 dark:bg-slate-950/50 border border-slate-200 dark:border-white/5 rounded-3xl p-5 flex flex-col justify-between h-full group relative overflow-hidden shadow-xl dark:shadow-sm hover:shadow-2xl hover:border-purple-500/30 hover:-translate-y-1 transition-all duration-300">
                
                {{-- Card Top Glow Line --}}
                <div class="h-1 w-full bg-gradient-to-r from-rose-500 via-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="relative z-10 flex flex-col flex-grow">
                    
                    {{-- Zoom-on-Hover Thumbnail Container --}}
                    <div class="relative w-full h-48 overflow-hidden rounded-2xl mb-4 bg-slate-950 border border-slate-200/80 dark:border-white/10 shrink-0 group/thumb">
                        <img src="{{ !empty($item->thumbnail_url) ? $item->thumbnail_url : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80' }}"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80';"
                             alt="{{ $item->title }}"
                             loading="lazy"
                             class="w-full h-full object-cover block rounded-2xl group-hover/thumb:scale-110 transition-transform duration-700 ease-out">
                        
                        {{-- Vignette Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-black/20 to-transparent pointer-events-none"></div>
                        
                        {{-- Floating Play Button Overlay --}}
                        <a href="{{ route('multimedia.show', $item->id) }}" class="absolute inset-0 flex items-center justify-center z-10" aria-label="Play {{ $item->title }}">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-rose-600 text-white flex items-center justify-center shadow-lg group-hover/thumb:scale-115 group-hover/thumb:shadow-purple-500/50 transition-all duration-300 pointer-events-auto border border-white/20">
                                <i class="fa-solid fa-play text-sm text-white ml-0.5"></i>
                            </div>
                        </a>

                        {{-- Type Badge --}}
                        <div class="absolute top-3 left-3 z-20 pointer-events-none">
                            <span class="text-[10px] font-semibold uppercase px-2.5 py-1 rounded-full bg-black/70 text-white border border-white/15 backdrop-blur-md flex items-center gap-1.5">
                                <i class="fa-solid {{ $item->type === 'video' ? 'fa-video text-rose-400' : 'fa-podcast text-purple-400' }} text-[9px]"></i>
                                <span>{{ $item->type }}</span>
                            </span>
                        </div>

                        {{-- Duration Badge --}}
                        <div class="absolute bottom-3 right-3 z-20 pointer-events-none">
                            <span class="px-2.5 py-1 text-[10px] font-mono font-semibold text-white bg-black/75 rounded-full backdrop-blur-md flex items-center gap-1.5 border border-white/15">
                                <i class="fa-regular fa-clock text-[9px] text-indigo-300"></i>
                                <span>{{ $item->duration ?? '25:00' }}</span>
                            </span>
                        </div>
                    </div>

                    {{-- Text Details --}}
                    <div class="space-y-2.5 flex-grow flex flex-col justify-start">
                        <h3 class="text-base font-black text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-300 transition-colors leading-snug font-display">
                            <a href="{{ route('multimedia.show', $item->id) }}" class="hover:underline">
                                {{ $item->title }}
                            </a>
                        </h3>

                        @if($item->description)
                            <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $item->description }}
                            </p>
                        @endif

                        @if($item->tags)
                            <div class="flex flex-wrap gap-1.5 pt-1 mt-auto">
                                @foreach(explode(',', $item->tags) as $tag)
                                    <span class="text-[10px] font-medium bg-white/80 dark:bg-white/[0.04] text-slate-700 dark:text-slate-300 px-2 py-0.5 rounded-lg border border-slate-200/80 dark:border-white/[0.06] flex items-center gap-1">
                                        <i class="fa-solid fa-tag text-[8px] text-slate-400"></i>
                                        <span>{{ trim($tag) }}</span>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Card Footer --}}
                <div class="mt-5 pt-4 border-t border-slate-200/80 dark:border-white/[0.07] relative z-10 flex items-center justify-between">
                    <a href="{{ route('multimedia.show', $item->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors group/link">
                        <span>Stream Video</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover/link:translate-x-1.5 transition-transform"></i>
                    </a>
                    <span class="inline-flex items-center gap-1 text-[10px] text-purple-600 dark:text-purple-400 font-semibold px-2 py-0.5 rounded-full bg-purple-500/10 border border-purple-500/20">
                        <i class="fa-solid fa-play text-[8px]"></i> 1080p Stream
                    </span>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 rounded-3xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center space-y-3 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center text-2xl mx-auto mb-2 shadow-sm">
                    <i class="fa-solid fa-film"></i>
                </div>
                <p class="text-base font-bold text-slate-900 dark:text-slate-300">No multimedia assets matched your filter.</p>
                <a href="{{ route('multimedia.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/10 text-purple-600 dark:text-purple-300 border border-purple-500/20 text-xs font-bold hover:bg-purple-500/20 transition-all">
                    <i class="fa-solid fa-rotate-left"></i> Reset Filter
                </a>
            </div>
        @endforelse
    </div>

    {{-- ══════════════════ PAGINATION ══════════════════ --}}
    @if ($multimedia->hasPages())
        <div class="glass-panel rounded-2xl p-4 border border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">
                Showing <strong class="text-slate-900 dark:text-white">{{ $multimedia->firstItem() }}</strong> to <strong class="text-slate-900 dark:text-white">{{ $multimedia->lastItem() }}</strong> of <strong class="text-slate-900 dark:text-white">{{ $multimedia->total() }}</strong> Multimedia Tracks
            </p>

            <div class="flex items-center gap-2">
                {{-- Previous Button --}}
                @if ($multimedia->onFirstPage())
                    <span class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-400 dark:text-slate-600 border border-slate-200 dark:border-white/5 cursor-not-allowed select-none">
                        <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                    </span>
                @else
                    <a href="{{ $multimedia->previousPageUrl() }}" class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-purple-500/40 transition-all">
                        <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                    </a>
                @endif

                {{-- Numeric Page Buttons --}}
                <div class="hidden sm:flex items-center gap-1.5">
                    @foreach ($multimedia->getUrlRange(1, $multimedia->lastPage()) as $page => $url)
                        @if ($page == $multimedia->currentPage())
                            <span class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-purple-500/25">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 rounded-full glass-panel text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-purple-500/40 font-bold text-xs flex items-center justify-center transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                {{-- Next Button --}}
                @if ($multimedia->hasMorePages())
                    <a href="{{ $multimedia->nextPageUrl() }}" class="px-4 py-2 text-xs font-bold rounded-full glass-panel text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-purple-500/40 transition-all">
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
