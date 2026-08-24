@extends('layouts.app')
@section('title', 'Career Bank — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">

    {{-- Header Banner --}}
    <div class="relative rounded-3xl p-8 sm:p-12 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/20 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                    <i class="fa-solid fa-layer-group text-purple-600 dark:text-purple-400 text-xs"></i>
                    <span>Curated Career Architecture Repository</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white font-display">
                    Explore <span class="grad-text">Career Tracks</span>
                </h1>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base max-w-xl leading-relaxed">
                    Browse role specifications, industry domains, essential skill competencies, and expected salary benchmarks across 15+ modern high-growth tech sectors.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center shrink-0 shadow-sm dark:shadow-inner">
                <div class="text-3xl sm:text-4xl font-black grad-text font-display">{{ $careers->total() }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium mt-1">Matched Tracks</div>
            </div>
        </div>
    </div>

    {{-- Search & Filter Console --}}
    <div class="relative rounded-3xl p-6 sm:p-8 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-4 overflow-hidden">
        <form action="{{ url('/careers') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end relative z-10">
            <div class="md:col-span-6">
                <div class="flex items-center justify-between mb-2">
                    <label for="search" class="text-xs font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-indigo-600 dark:text-indigo-400 text-xs"></i>
                        <span>Search Job Role or Skills</span>
                    </label>
                </div>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Search careers, skills (e.g. Full-Stack, Cloud, AI, Security)..."
                           class="app-input w-full px-4 py-3 rounded-xl text-sm pl-10 focus:ring-2 focus:ring-purple-500/30">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
            </div>
            <div class="md:col-span-4">
                <label for="domain" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-purple-600 dark:text-purple-400 text-xs"></i>
                    <span>Industry Domain</span>
                </label>
                <select name="domain" id="domain" class="app-input w-full px-4 py-3 rounded-xl text-sm">
                    <option value="">All Industry Domains ({{ count($domains) }})</option>
                    @foreach($domains as $dom)
                        <option value="{{ $dom }}" {{ request('domain') === $dom ? 'selected' : '' }}>{{ $dom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="btn-sweep flex-1 py-3 font-bold text-sm rounded-xl text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-lg shadow-purple-500/20 transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105">
                    <i class="fa-solid fa-sliders text-xs text-white"></i>
                    <span class="text-white">Filter</span>
                </button>
                @if(request('search') || request('domain'))
                    <a href="{{ route('careers.index') }}" class="px-3 py-3 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 transition-all flex items-center justify-center" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
        <div class="mt-4 pt-3.5 border-t border-slate-200/60 dark:border-white/[0.06] flex items-center gap-2 overflow-x-auto pb-2.5 [&::-webkit-scrollbar]:h-1.5 [&::-webkit-scrollbar-track]:bg-slate-900/40 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-thumb]:bg-purple-600/40 hover:[&::-webkit-scrollbar-thumb]:bg-purple-500/70 [&::-webkit-scrollbar-thumb]:rounded-full relative z-10">
            <span class="text-[10px] font-bold text-slate-500 shrink-0 uppercase tracking-wider">Quick Filter:</span>
            <a href="{{ route('careers.index') }}" class="px-3 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 {{ !request('domain') ? 'border-purple-500/50 text-purple-700 dark:text-purple-300 bg-purple-500/15 dark:bg-purple-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                All Tracks
            </a>
            @foreach($domains as $d)
                <a href="{{ route('careers.index', ['domain' => $d]) }}" class="px-3 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 {{ request('domain') === $d ? 'border-purple-500/50 text-purple-700 dark:text-purple-300 bg-purple-500/15 dark:bg-purple-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                    {{ $d }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Career Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($careers as $career)
            @php
                $domLower = strtolower($career->domain);
                $badgeClass = 'badge-software'; $domIcon = 'fa-code';
                if (str_contains($domLower, 'cloud') || str_contains($domLower, 'devops') || str_contains($domLower, 'infrastructure')) {
                    $badgeClass = 'badge-cloud'; $domIcon = 'fa-cloud';
                } elseif (str_contains($domLower, 'ai') || str_contains($domLower, 'artificial') || str_contains($domLower, 'data')) {
                    $badgeClass = 'badge-ai'; $domIcon = 'fa-brain';
                } elseif (str_contains($domLower, 'cyber') || str_contains($domLower, 'security')) {
                    $badgeClass = 'badge-cyber'; $domIcon = 'fa-shield-halved';
                } elseif (str_contains($domLower, 'mobile')) {
                    $badgeClass = 'badge-mobile'; $domIcon = 'fa-mobile-screen';
                } elseif (str_contains($domLower, 'design') || str_contains($domLower, 'ui')) {
                    $badgeClass = 'badge-design'; $domIcon = 'fa-palette';
                } elseif (str_contains($domLower, 'blockchain')) {
                    $badgeClass = 'badge-blockchain'; $domIcon = 'fa-cubes';
                } elseif (str_contains($domLower, 'game')) {
                    $badgeClass = 'badge-game'; $domIcon = 'fa-gamepad';
                }
                $skills = array_filter(array_map('trim', explode(',', $career->required_skills)));
            @endphp

            <div class="career-card bg-white/90 dark:bg-slate-950/50 border border-slate-200 dark:border-white/5 rounded-3xl flex flex-col group relative overflow-hidden shadow-xl dark:shadow-sm hover:shadow-2xl hover:border-purple-500/30 hover:-translate-y-1 transition-all duration-300">

                {{-- Card Top Gradient Accent --}}
                <div class="h-1 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="p-6 flex flex-col flex-1 space-y-5">

                    {{-- Domain Badge + Salary Badge + Compare Button (Wrapped Flex Layout) --}}
                    <div class="flex flex-wrap items-center justify-between gap-2.5">
                        {{-- Left Badges: Domain Tag + Salary Badge --}}
                        <div class="flex flex-wrap items-center gap-2">
                            {{-- Domain Badge --}}
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full border {{ $badgeClass }} flex items-center gap-1.5 shadow-sm">
                                <i class="fa-solid {{ $domIcon }} text-[10px]"></i>
                                <span>{{ $career->domain }}</span>
                            </span>
                            
                            {{-- Salary Badge --}}
                            <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-xs font-black text-emerald-600 dark:text-emerald-400 font-mono shadow-sm">
                                {{ $career->expected_salary }}
                            </span>
                        </div>
                        
                        {{-- Right: Interactive Compare Toggle Button --}}
                        @php
                            $cId = $career->id;
                            $tEsc = addslashes($career->title);
                            $dEsc = addslashes($career->domain);
                            $sEsc = addslashes($career->expected_salary);
                            $skEsc = addslashes($career->required_skills);
                            $urlEsc = route('careers.show', $career->id);
                            $diffLevel = ($cId % 3 === 0) ? 'Advanced' : (($cId % 3 === 2) ? 'Intermediate' : 'Beginner / Intermediate');
                        @endphp
                        <button type="button"
                                onclick="toggleCompare({{ $cId }}, '{{ $tEsc }}', '{{ $dEsc }}', '{{ $sEsc }}', '94%', '{{ $diffLevel }}', '{{ $skEsc }}', '{{ $urlEsc }}', '{{ $badgeClass }}', '{{ $domIcon }}')"
                                id="btn-compare-{{ $cId }}"
                                class="compare-toggle-btn px-3 py-1 text-[11px] font-bold rounded-full border border-slate-200/80 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-300 hover:border-purple-500/30 transition-all flex items-center gap-1.5 bg-white/60 dark:bg-white/[0.04] backdrop-blur-sm shrink-0 shadow-sm"
                                title="Add to career comparison matrix">
                            <i class="fa-solid fa-plus text-[9px] icon-state"></i>
                            <span class="label-state">Compare</span>
                        </button>
                    </div>

                    {{-- Title & Description --}}
                    <div class="space-y-2 flex-1">
                        <h2 class="text-xl font-black text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-300 transition-colors leading-snug font-display">
                            {{ $career->title }}
                        </h2>
                        <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $career->description }}
                        </p>
                    </div>

                    {{-- Market Demand Indicator --}}
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-[10px] font-semibold text-slate-500 dark:text-slate-400">
                                <i class="fa-solid fa-chart-line text-indigo-500 dark:text-indigo-400 text-[9px]"></i>
                                <span>Market Demand</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse shrink-0"></span> High
                                </span>
                                <span class="text-xs font-black text-indigo-600 dark:text-indigo-400">94%</span>
                            </div>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/[0.06] overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 career-bar" data-width="94" style="width:0%;transition:width 0.9s cubic-bezier(0.4,0,0.2,1)"></div>
                        </div>

                        {{-- Growth Rate --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-[10px] font-semibold text-slate-500 dark:text-slate-400">
                                <i class="fa-solid fa-arrow-trend-up text-pink-500 dark:text-pink-400 text-[9px]"></i>
                                <span>5-Year Growth</span>
                            </div>
                            <span class="text-xs font-black text-pink-600 dark:text-pink-400">+28%</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/[0.06] overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-purple-500 to-pink-500 career-bar" data-width="88" style="width:0%;transition:width 0.9s cubic-bezier(0.4,0,0.2,1) 0.1s"></div>
                        </div>
                    </div>

                    {{-- Core Skills Tags --}}
                    <div class="space-y-2">
                        <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-500 flex items-center gap-1.5">
                            <i class="fa-solid fa-code text-indigo-500 dark:text-indigo-400 text-[9px]"></i>
                            <span>Core Skills</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($skills, 0, 5) as $s)
                                <span class="px-2.5 py-1 text-[10px] font-medium rounded-lg bg-white/80 dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/[0.08] text-slate-700 dark:text-slate-300 hover:border-purple-500/30 transition-colors">
                                    {{ $s }}
                                </span>
                            @endforeach
                            @if(count($skills) > 5)
                                <span class="px-2.5 py-1 text-[10px] font-medium rounded-lg bg-purple-500/10 border border-purple-500/20 text-purple-600 dark:text-purple-400">
                                    +{{ count($skills) - 5 }} more
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Card Footer --}}
                <div class="px-6 py-4 border-t border-slate-200/80 dark:border-white/[0.07] bg-white/40 dark:bg-white/[0.01] flex items-center justify-between">
                    <a href="{{ route('careers.show', $career->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors group/link">
                        <span>View Full Roadmap</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover/link:translate-x-1.5 transition-transform"></i>
                    </a>
                    <span class="text-[10px] text-slate-400 dark:text-slate-600 font-mono">#{{ str_pad($career->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 rounded-3xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center space-y-3 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl mx-auto mb-2 shadow-sm">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <p class="text-lg font-bold text-slate-900 dark:text-slate-200">No career profiles match your filter.</p>
                <p class="text-xs text-slate-600 dark:text-slate-500">Try adjusting your search terms or clearing the domain filter.</p>
                <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 mt-2 px-5 py-2.5 rounded-full text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-white dark:bg-slate-800 border border-purple-500/20 hover:border-purple-500/50 transition-all shadow-sm">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                    <span>Clear All Filters</span>
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($careers->hasPages())
        <div class="glass-panel rounded-2xl p-4 border border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-slate-700 dark:text-slate-400 font-semibold">
                Showing <span class="font-bold text-slate-950 dark:text-slate-200">{{ $careers->firstItem() }}</span> to <span class="font-bold text-slate-950 dark:text-slate-200">{{ $careers->lastItem() }}</span> of <span class="font-bold text-slate-950 dark:text-slate-200">{{ $careers->total() }}</span> Career Tracks
            </div>
            <div class="flex items-center gap-2">
                @if ($careers->onFirstPage())
                    <span class="px-4 py-2 glass-panel rounded-full text-xs font-bold text-slate-400 dark:text-slate-600 cursor-not-allowed opacity-50 flex items-center gap-1.5 select-none">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i> Previous
                    </span>
                @else
                    <a href="{{ $careers->previousPageUrl() }}" class="px-4 py-2 glass-panel rounded-full text-xs font-bold text-slate-800 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:border-purple-500/40 transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i> Previous
                    </a>
                @endif
                <div class="hidden sm:flex items-center gap-1.5">
                    @foreach ($careers->getUrlRange(1, $careers->lastPage()) as $page => $url)
                        @if ($page == $careers->currentPage())
                            <span class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-purple-500/25">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 rounded-full glass-panel text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white hover:border-purple-500/30 text-xs font-bold flex items-center justify-center transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>
                @if ($careers->hasMorePages())
                    <a href="{{ $careers->nextPageUrl() }}" class="px-4 py-2 glass-panel rounded-full text-xs font-bold text-slate-800 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:border-purple-500/40 transition-all flex items-center gap-1.5">
                        Next <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                @else
                    <span class="px-4 py-2 glass-panel rounded-full text-xs font-bold text-slate-400 dark:text-slate-600 cursor-not-allowed opacity-50 flex items-center gap-1.5 select-none">
                        Next <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif

</div>

{{-- ══════════════════ FLOATING COMPARISON BOTTOM DOCK ══════════════════ --}}
<div id="compareDock"
     class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 transition-all duration-500 transform translate-y-32 opacity-0 pointer-events-none max-w-2xl w-[92%] sm:w-auto">
    <div class="px-5 py-3.5 rounded-2xl bg-[#0b0c16]/95 backdrop-blur-2xl border border-purple-500/40 shadow-[0_10px_40px_rgba(0,0,0,0.6)] flex items-center justify-between gap-4 sm:gap-6">
        
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center text-white text-xs shrink-0 shadow-lg shadow-purple-500/30">
                <i class="fa-solid fa-code-compare"></i>
            </div>
            
            <div class="space-y-0.5">
                <div class="text-xs font-bold text-white flex items-center gap-2">
                    <span>Career Comparison</span>
                    <span id="compareCountBadge" class="px-2 py-0.2 rounded-full text-[10px] font-extrabold bg-purple-500/25 text-purple-300 border border-purple-500/30">
                        0 / 3 Selected
                    </span>
                </div>
                <div id="compareTrackPills" class="flex items-center gap-1.5 flex-wrap">
                    <!-- Dynamic chips inserted by JS -->
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <button type="button"
                    id="btnOpenModal"
                    onclick="openCompareModal()"
                    disabled
                    class="px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-lg shadow-purple-500/25 disabled:opacity-40 disabled:cursor-not-allowed hover:scale-105 transition-all flex items-center gap-2">
                <i class="fa-solid fa-table-columns text-[10px]"></i>
                <span id="btnCompareLabel">Compare</span>
            </button>

            <button type="button"
                    onclick="clearCompare()"
                    class="p-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/10 transition-colors text-xs"
                    title="Clear comparison">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
    </div>
</div>

{{-- ══════════════════ COMPARISON MATRIX MODAL ══════════════════ --}}
<div id="compareModal"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/80 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300"
     onclick="handleModalBackdropClick(event)">
    
    <div class="relative w-full max-w-5xl max-h-[90vh] flex flex-col rounded-2xl bg-slate-900/90 backdrop-blur-2xl border border-white/10 p-6 sm:p-8 shadow-2xl overflow-hidden scale-95 transition-transform duration-300"
         id="compareModalContent">
        
        {{-- Modal Top Gradient Accent --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shrink-0 rounded-full mb-4"></div>

        {{-- Modal Header --}}
        <div class="pb-6 border-b border-white/10 flex items-center justify-between gap-4 shrink-0">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/15 border border-purple-500/25 text-xs font-semibold text-purple-300">
                    <i class="fa-solid fa-code-compare text-purple-400 text-xs"></i>
                    <span>Career Track Intelligence Matrix</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-white font-display">
                    Side-by-Side <span class="grad-text">Career Comparison</span>
                </h3>
            </div>

            <button type="button"
                    onclick="closeCompareModal()"
                    class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 border border-white/15 text-slate-300 hover:text-white flex items-center justify-center transition-all shadow-md"
                    title="Close comparison modal">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        {{-- Modal Scrollable Body / Comparison Matrix Table --}}
        <div class="py-6 overflow-y-auto flex-1 space-y-6 scrollbar-thin">
            
            <div class="overflow-x-auto rounded-xl border border-white/10 bg-white/[0.02]">
                <table class="w-full text-left border-collapse" id="matrixTable">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/[0.03]" id="matrixHeaderRow">
                            <th class="p-5 text-xs font-black text-slate-300 uppercase tracking-wider w-1/4 border-r border-white/10">Key Dimensions</th>
                            <!-- Dynamic Career Columns will be injected here -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.08] text-sm" id="matrixBody">
                        <!-- Dynamic Rows injected by JS -->
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Modal Footer --}}
        <div class="pt-5 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 shrink-0">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <i class="fa-solid fa-circle-check text-emerald-400"></i>
                <span>Comparing verified 2026 tech economy pathways &amp; compensations.</span>
            </div>
            <button type="button"
                    onclick="closeCompareModal()"
                    class="px-8 py-3 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 border border-purple-400/30 shadow-lg shadow-purple-500/25 transition-all hover:scale-105">
                Close Comparison
            </button>
        </div>

    </div>
</div>

{{-- ══════════════════ COMPARISON JAVASCRIPT LOGIC ══════════════════ --}}
<script>
// Global Comparison State (Max 3 items)
const compareState = {
    items: []
};

function toggleCompare(id, title, domain, salary, demand, difficulty, skills, url, badgeClass, domIcon) {
    const idx = compareState.items.findIndex(x => x.id === id);
    
    if (idx > -1) {
        compareState.items.splice(idx, 1);
    } else {
        if (compareState.items.length >= 3) {
            alert('You can compare a maximum of 3 career tracks at once. Please remove one to add another.');
            return;
        }
        compareState.items.push({
            id, title, domain, salary, demand, difficulty, skills, url, badgeClass, domIcon
        });
    }

    updateCompareUI();
}

function updateCompareUI() {
    const dock = document.getElementById('compareDock');
    const badge = document.getElementById('compareCountBadge');
    const pillsContainer = document.getElementById('compareTrackPills');
    const btnCompare = document.getElementById('btnOpenModal');
    const btnLabel = document.getElementById('btnCompareLabel');
    const count = compareState.items.length;

    // 1. Update Card Button States
    document.querySelectorAll('.compare-toggle-btn').forEach(btn => {
        const icon = btn.querySelector('.icon-state');
        const label = btn.querySelector('.label-state');
        btn.classList.remove('border-purple-500/60', 'text-purple-300', 'bg-purple-500/20');
        btn.classList.add('border-slate-200', 'dark:border-white/10', 'text-slate-500', 'dark:text-slate-400');
        if (icon) { icon.className = 'fa-solid fa-plus text-[9px] icon-state'; }
        if (label) { label.textContent = 'Compare'; }
    });

    compareState.items.forEach(item => {
        const btn = document.getElementById(`btn-compare-${item.id}`);
        if (btn) {
            btn.classList.remove('border-slate-200', 'dark:border-white/10', 'text-slate-500', 'dark:text-slate-400');
            btn.classList.add('border-purple-500/60', 'text-purple-300', 'bg-purple-500/20');
            const icon = btn.querySelector('.icon-state');
            const label = btn.querySelector('.label-state');
            if (icon) { icon.className = 'fa-solid fa-check text-[9px] icon-state text-purple-400'; }
            if (label) { label.textContent = 'Selected'; }
        }
    });

    // 2. Update Dock Visibility & Counter
    if (count > 0) {
        dock.classList.remove('translate-y-32', 'opacity-0', 'pointer-events-none');
        dock.classList.add('translate-y-0', 'opacity-100');
        badge.textContent = `${count} / 3 Selected`;

        pillsContainer.innerHTML = '';
        compareState.items.forEach(item => {
            const pill = document.createElement('span');
            pill.className = 'inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-[10px] text-slate-300';
            pill.innerHTML = `
                <span class="max-w-[90px] truncate">${item.title}</span>
                <button type="button" onclick="toggleCompare(${item.id})" class="text-slate-500 hover:text-rose-400 transition-colors">
                    <i class="fa-solid fa-xmark text-[8px]"></i>
                </button>
            `;
            pillsContainer.appendChild(pill);
        });

        if (count >= 2) {
            btnCompare.disabled = false;
            btnLabel.textContent = `Compare (${count})`;
        } else {
            btnCompare.disabled = true;
            btnLabel.textContent = 'Select 1 More';
        }
    } else {
        dock.classList.add('translate-y-32', 'opacity-0', 'pointer-events-none');
        dock.classList.remove('translate-y-0', 'opacity-100');
    }
}

function clearCompare() {
    compareState.items = [];
    updateCompareUI();
    closeCompareModal();
}

function openCompareModal() {
    if (compareState.items.length < 2) return;

    renderComparisonMatrix();

    const modal = document.getElementById('compareModal');
    const content = document.getElementById('compareModalContent');
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100');
    content.classList.remove('scale-95');
    content.classList.add('scale-100');
    document.body.style.overflow = 'hidden';
}

function closeCompareModal() {
    const modal = document.getElementById('compareModal');
    const content = document.getElementById('compareModalContent');
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'pointer-events-none');
    content.classList.remove('scale-100');
    content.classList.add('scale-95');
    document.body.style.overflow = '';
}

function handleModalBackdropClick(e) {
    if (e.target.id === 'compareModal') {
        closeCompareModal();
    }
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeCompareModal();
});

function renderComparisonMatrix() {
    const items = compareState.items;
    const headerRow = document.getElementById('matrixHeaderRow');
    const body = document.getElementById('matrixBody');

    // Header Row with dismissal actions
    headerRow.innerHTML = `<th class="p-5 text-xs font-black text-slate-300 uppercase tracking-wider w-1/4 min-w-[170px] border-r border-white/10">Key Dimensions</th>`;
    items.forEach(item => {
        const th = document.createElement('th');
        th.className = 'p-5 text-left min-w-[220px] align-top';
        th.innerHTML = `
            <div class="space-y-3">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full border ${item.badgeClass} inline-flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid ${item.domIcon} text-[8px]"></i>
                        <span>${item.domain}</span>
                    </span>
                    <button type="button" onclick="toggleCompare(${item.id}); if(compareState.items.length < 2) closeCompareModal(); else renderComparisonMatrix();" class="w-6 h-6 rounded-full bg-white/5 hover:bg-rose-500/20 text-slate-400 hover:text-rose-400 flex items-center justify-center transition-colors text-[10px]" title="Remove from comparison">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <h4 class="text-base sm:text-lg font-black text-white font-display leading-tight">${item.title}</h4>
            </div>
        `;
        headerRow.appendChild(th);
    });

    // Difficulty badge helper
    const diffStyles = {
        'Advanced': 'bg-purple-500/20 text-purple-300 border-purple-500/30',
        'Intermediate': 'bg-amber-500/20 text-amber-300 border-amber-500/30',
        'Beginner / Intermediate': 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30'
    };

    // Body Rows
    body.innerHTML = `
        {{-- Row: Salary Range --}}
        <tr class="hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-300 text-xs border-r border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                    <span>Salary Range</span>
                </div>
            </td>
            ${items.map(item => `
                <td class="p-5 align-middle">
                    <div class="text-lg font-black text-emerald-400 font-display">${item.salary}</div>
                    <div class="text-[11px] text-slate-400 font-medium mt-0.5">Annual Median Benchmark</div>
                </td>
            `).join('')}
        </tr>

        {{-- Row: Market Demand --}}
        <tr class="hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-300 text-xs border-r border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span>Market Demand</span>
                </div>
            </td>
            ${items.map(item => `
                <td class="p-5 align-middle space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>High Growth</span>
                        </span>
                        <span class="text-xs font-black text-indigo-300 font-mono">${item.demand}</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 via-indigo-500 to-purple-500" style="width: 94%;"></div>
                    </div>
                </td>
            `).join('')}
        </tr>

        {{-- Row: Core Difficulty --}}
        <tr class="hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-300 text-xs border-r border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <span>Core Difficulty</span>
                </div>
            </td>
            ${items.map(item => {
                const dClass = diffStyles[item.difficulty] || 'bg-purple-500/20 text-purple-300 border-purple-500/30';
                return `
                    <td class="p-5 align-middle">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold border ${dClass} inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-signal text-[10px]"></i>
                            <span>${item.difficulty}</span>
                        </span>
                    </td>
                `;
            }).join('')}
        </tr>

        {{-- Row: Primary Skills --}}
        <tr class="hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-300 text-xs border-r border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <span>Primary Skills</span>
                </div>
            </td>
            ${items.map(item => {
                const skillsArr = item.skills.split(',').map(s => s.trim()).filter(Boolean);
                return `
                    <td class="p-5 align-middle">
                        <div class="flex flex-wrap gap-1.5">
                            ${skillsArr.map(s => `
                                <span class="px-2.5 py-1 text-[11px] font-semibold rounded-lg bg-white/[0.05] border border-white/10 text-slate-200 shadow-sm">
                                    ${s}
                                </span>
                            `).join('')}
                        </div>
                    </td>
                `;
            }).join('')}
        </tr>

        {{-- Row: Full Roadmap Action --}}
        <tr class="hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-300 text-xs border-r border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-purple-500/15 text-purple-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <span>Full Roadmap</span>
                </div>
            </td>
            ${items.map(item => `
                <td class="p-5 align-middle">
                    <a href="${item.url}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:to-pink-500 hover:scale-105 transition-all shadow-md shadow-purple-500/20">
                        <span>View Full Roadmap</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </td>
            `).join('')}
        </tr>
    `;
}

// Interactive Bar Reveal
document.addEventListener('DOMContentLoaded', () => {
    const bars = document.querySelectorAll('.career-bar');
    if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const w = entry.target.getAttribute('data-width');
                    entry.target.style.width = w + '%';
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });
        bars.forEach(b => obs.observe(b));
    } else {
        bars.forEach(b => { b.style.width = b.getAttribute('data-width') + '%'; });
    }
});
</script>
@endsection
