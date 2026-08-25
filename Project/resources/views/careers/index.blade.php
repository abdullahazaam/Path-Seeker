@extends('layouts.app')
@section('title', 'Career Bank — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">

    {{-- Header Banner --}}
    <div class="relative rounded-3xl p-8 sm:p-12 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/20 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                    <i class="fa-solid fa-bolt text-purple-600 dark:text-purple-400 text-xs"></i>
                    <span>Live Career Intelligence Matrix &bull; Real-Time Market Data</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white font-display">
                    Explore <span class="grad-text">Career Tracks</span>
                </h1>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base max-w-xl leading-relaxed">
                    Real-time market analytics, core competencies, verified 2026 toolchains, and predictive salary benchmarks across 15+ modern high-growth tech sectors.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-center shrink-0 shadow-sm dark:shadow-inner">
                <div class="text-3xl sm:text-4xl font-black grad-text font-display">{{ $careers->total() }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium mt-1">Matched Tracks</div>
            </div>
        </div>
    </div>

    {{-- Search & Filter Console --}}
    {{-- Search & Filter Console with Smart Autocomplete & Save Preferences --}}
    <div class="relative rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-4 overflow-visible"
         x-data="{
             searchQuery: '{{ request('search') }}',
             suggestions: [],
             loading: false,
             isOpen: false,
             selectedIndex: -1,
             saveMessage: '',
             saveLoading: false,

             fetchAutocomplete() {
                 if (this.searchQuery.trim().length < 2) {
                     this.suggestions = [];
                     this.isOpen = false;
                     return;
                 }
                 this.loading = true;
                 fetch('{{ route('api.careers.autocomplete') }}?q=' + encodeURIComponent(this.searchQuery))
                     .then(r => r.json())
                     .then(data => {
                         this.suggestions = data;
                         this.isOpen = data.length > 0;
                         this.loading = false;
                     })
                     .catch(() => {
                         this.loading = false;
                     });
             },

             selectSuggestion(title) {
                 this.searchQuery = title;
                 this.isOpen = false;
                 document.getElementById('careerSearchForm').submit();
             },

             savePreferences() {
                 this.saveLoading = true;
                 const domainVal = document.getElementById('domainSelect')?.value || '';
                 const roleVal = '{{ request('role') }}';
                 
                 fetch('{{ route('careers.save-preferences') }}', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}',
                         'Accept': 'application/json'
                     },
                     body: JSON.stringify({
                         search: this.searchQuery,
                         domain: domainVal,
                         role: roleVal
                     })
                 })
                 .then(r => r.json())
                 .then(data => {
                     this.saveLoading = false;
                     this.saveMessage = data.message || 'Preferences saved!';
                     setTimeout(() => { this.saveMessage = ''; }, 3500);
                 })
                 .catch(() => {
                     this.saveLoading = false;
                 });
             }
         }">
        
        <form id="careerSearchForm" action="{{ url('/careers') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end relative z-20">
            @if(request('role'))
                <input type="hidden" name="role" value="{{ request('role') }}">
            @endif
            
            {{-- Smart Autocomplete Input Column --}}
            <div class="md:col-span-5 relative">
                <div class="flex items-center justify-between mb-2">
                    <label for="search" class="text-xs font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-indigo-600 dark:text-indigo-400 text-xs"></i>
                        <span>Search Job Role or Skills</span>
                    </label>
                    <span x-show="loading" class="text-[10px] text-purple-600 font-mono flex items-center gap-1">
                        <i class="fa-solid fa-spinner fa-spin text-[9px]"></i> Searching...
                    </span>
                </div>
                
                <div class="relative">
                    <input type="text" name="search" id="search" 
                           x-model="searchQuery"
                           @input.debounce.250ms="fetchAutocomplete()"
                           @focus="if(suggestions.length) isOpen = true"
                           @click.outside="isOpen = false"
                           @keydown.escape="isOpen = false"
                           placeholder="Type role or skill (e.g. Full-Stack, AI, Cloud, Rust)..."
                           autocomplete="off"
                           class="app-input w-full px-4 py-3 rounded-xl text-sm pl-10 focus:ring-2 focus:ring-purple-500/30">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>

                {{-- Autocomplete Dropdown List --}}
                <div x-show="isOpen && suggestions.length > 0" 
                     x-cloak 
                     style="display: none;" 
                     class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 rounded-2xl shadow-2xl z-50 max-h-72 overflow-y-auto divide-y divide-slate-100 dark:divide-white/5">
                    <template x-for="item in suggestions" :key="item.id">
                        <div @click="selectSuggestion(item.title)" 
                             class="p-3 hover:bg-purple-500/10 cursor-pointer transition-colors flex items-center justify-between gap-3">
                            <div>
                                <div class="font-bold text-xs text-slate-900 dark:text-white" x-text="item.title"></div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 font-mono" x-text="item.domain"></div>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-300" x-text="item.expected_salary"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Domain Filter Select --}}
            <div class="md:col-span-3">
                <label for="domainSelect" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-purple-600 dark:text-purple-400 text-xs"></i>
                    <span>Industry Domain</span>
                </label>
                <select name="domain" id="domainSelect" class="app-input w-full px-4 py-3 rounded-xl text-sm">
                    <option value="">All Industry Domains ({{ count($domains) }})</option>
                    @foreach($domains as $dom)
                        <option value="{{ $dom }}" {{ request('domain') === $dom ? 'selected' : '' }}>{{ $dom }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Action Buttons (Filter + Save Preferences + Reset) --}}
            <div class="md:col-span-4 flex items-center gap-2">
                <button type="submit" class="btn-sweep flex-1 py-3 font-bold text-xs rounded-xl text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-md transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-sliders text-xs text-white"></i>
                    <span class="text-white">Filter</span>
                </button>

                {{-- SAVE PREFERENCES BUTTON --}}
                <button type="button" 
                        @click="savePreferences()" 
                        :disabled="saveLoading"
                        class="px-3.5 py-3 rounded-xl text-xs font-bold bg-amber-500/15 text-amber-700 dark:text-amber-300 hover:bg-amber-500/25 border border-amber-500/30 transition-all flex items-center gap-1.5 cursor-pointer whitespace-nowrap" 
                        title="Save these search filters as your default preference">
                    <i class="fa-solid fa-bookmark text-amber-500 text-xs" :class="saveLoading ? 'animate-spin' : ''"></i>
                    <span>Save Prefs</span>
                </button>

                @if(request('search') || request('domain') || request('role'))
                    <a href="{{ route('careers.index') }}" class="px-3 py-3 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 transition-all flex items-center justify-center" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>

        {{-- Toast / Save Message Notification --}}
        <div x-show="saveMessage" x-cloak style="display: none;" class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs font-bold text-emerald-700 dark:text-emerald-400 flex items-center gap-2 transition-all">
            <i class="fa-solid fa-circle-check"></i>
            <span x-text="saveMessage"></span>
        </div>

        {{-- Role-Based Dynamic Filters --}}
        <div class="mt-4 pt-3.5 border-t border-slate-200/60 dark:border-white/[0.06] space-y-3 relative z-10">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 overflow-x-auto pb-1.5 [&::-webkit-scrollbar]:h-1">
                    <span class="text-[10px] font-bold text-slate-500 shrink-0 uppercase tracking-wider">Role Track:</span>
                    
                    {{-- All Roles --}}
                    <a href="{{ route('careers.index', array_merge(request()->query(), ['role' => null])) }}"
                       class="px-3 py-1.5 text-xs font-bold rounded-xl border transition-all shrink-0 flex items-center gap-1.5 {{ !request('role') ? 'border-purple-500 text-white bg-gradient-to-r from-indigo-600 to-purple-600 shadow-md shadow-purple-500/20' : 'border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:border-purple-500/30 bg-slate-100/80 dark:bg-white/[0.03]' }}">
                        <i class="fa-solid fa-layer-group text-[10px]"></i>
                        <span>All Tracks</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[9px] bg-black/20 text-white">{{ $roleCounts['all'] ?? $careers->total() }}</span>
                    </a>

                    {{-- Student --}}
                    <a href="{{ route('careers.index', array_merge(request()->query(), ['role' => 'student'])) }}"
                       class="px-3 py-1.5 text-xs font-bold rounded-xl border transition-all shrink-0 flex items-center gap-1.5 {{ request('role') === 'student' ? 'border-sky-500 text-white bg-gradient-to-r from-sky-600 to-indigo-600 shadow-md shadow-sky-500/20' : 'border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:border-sky-500/30 bg-slate-100/80 dark:bg-white/[0.03]' }}">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        <span>Student &bull; Foundational</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[9px] bg-sky-500/20 text-sky-700 dark:text-sky-300">{{ $roleCounts['student'] ?? 6 }}</span>
                    </a>

                    {{-- Graduate --}}
                    <a href="{{ route('careers.index', array_merge(request()->query(), ['role' => 'graduate'])) }}"
                       class="px-3 py-1.5 text-xs font-bold rounded-xl border transition-all shrink-0 flex items-center gap-1.5 {{ request('role') === 'graduate' ? 'border-purple-500 text-white bg-gradient-to-r from-purple-600 to-pink-600 shadow-md shadow-purple-500/20' : 'border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:border-purple-500/30 bg-slate-100/80 dark:bg-white/[0.03]' }}">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Graduate &bull; Entry &amp; Portfolio</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[9px] bg-purple-500/20 text-purple-700 dark:text-purple-300">{{ $roleCounts['graduate'] ?? 8 }}</span>
                    </a>

                    {{-- Professional --}}
                    <a href="{{ route('careers.index', array_merge(request()->query(), ['role' => 'professional'])) }}"
                       class="px-3 py-1.5 text-xs font-bold rounded-xl border transition-all shrink-0 flex items-center gap-1.5 {{ request('role') === 'professional' ? 'border-amber-500 text-white bg-gradient-to-r from-amber-600 to-rose-600 shadow-md shadow-amber-500/20' : 'border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:border-amber-500/30 bg-slate-100/80 dark:bg-white/[0.03]' }}">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>Professional &bull; Architecture</span>
                        <span class="px-1.5 py-0.2 rounded-full text-[9px] bg-amber-500/20 text-amber-700 dark:text-amber-300">{{ $roleCounts['professional'] ?? 6 }}</span>
                    </a>
                </div>

                @auth
                    <div class="hidden lg:flex items-center gap-2 text-xs font-medium text-slate-500 dark:text-slate-400">
                        <i class="fa-solid fa-circle-user text-purple-500"></i>
                        <span>Logged in as: <strong class="text-slate-900 dark:text-white capitalize">{{ Auth::user()->role }}</strong></span>
                    </div>
                @endauth
            </div>

            {{-- Domain Filter Quick Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-1.5 [&::-webkit-scrollbar]:h-1">
                <span class="text-[10px] font-bold text-slate-500 shrink-0 uppercase tracking-wider">Domains:</span>
                <a href="{{ route('careers.index', array_merge(request()->query(), ['domain' => null])) }}" class="px-2.5 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 {{ !request('domain') ? 'border-purple-500/50 text-purple-700 dark:text-purple-300 bg-purple-500/15 dark:bg-purple-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                    All Domains
                </a>
                @foreach($domains as $d)
                    <a href="{{ route('careers.index', array_merge(request()->query(), ['domain' => $d])) }}" class="px-2.5 py-1 text-xs font-semibold rounded-full border transition-all shrink-0 {{ request('domain') === $d ? 'border-purple-500/50 text-purple-700 dark:text-purple-300 bg-purple-500/15 dark:bg-purple-500/20' : 'border-slate-200 dark:border-white/5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                        {{ $d }}
                    </a>
                @endforeach
            </div>
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

                $cRole = $career->target_role ?? 'all';
                if ($cRole === 'student') {
                    $roleLabel = 'Student Foundational';
                    $roleIconSvg = '<svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>';
                    $roleBadge = 'bg-sky-500/10 text-sky-700 dark:text-sky-300 border-sky-500/20';
                } elseif ($cRole === 'graduate') {
                    $roleLabel = 'Graduate Track';
                    $roleIconSvg = '<svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>';
                    $roleBadge = 'bg-purple-500/10 text-purple-700 dark:text-purple-300 border-purple-500/20';
                } elseif ($cRole === 'professional') {
                    $roleLabel = 'Professional Architecture';
                    $roleIconSvg = '<svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>';
                    $roleBadge = 'bg-amber-500/10 text-amber-700 dark:text-amber-300 border-amber-500/20';
                } else {
                    $roleLabel = 'Universal Track';
                    $roleIconSvg = '<svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>';
                    $roleBadge = 'bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 border-indigo-500/20';
                }
            @endphp

                <div class="career-card bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 rounded-3xl flex flex-col justify-between group relative overflow-hidden shadow-md dark:shadow-sm hover:shadow-xl hover:border-purple-500/30 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6 flex flex-col flex-1 space-y-5">
                        {{-- Domain Badge + Salary Badge + Compare Button --}}
                        <div class="flex items-center justify-between gap-2.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full border {{ $badgeClass }} flex items-center gap-1.5 shadow-sm">
                                    <i class="fa-solid {{ $domIcon }} text-[10px]"></i>
                                    <span>{{ $career->domain }}</span>
                                </span>

                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md border {{ $roleBadge }} inline-flex items-center gap-1.5 shadow-sm">
                                    {!! $roleIconSvg !!}
                                    <span>{{ $roleLabel }}</span>
                                </span>
                            </div>
                            
                            @php
                                $cId = $career->id;
                                $tEsc = addslashes($career->title);
                                $dEsc = addslashes($career->domain);
                                $sEsc = addslashes($career->expected_salary);
                                $skEsc = addslashes($career->required_skills);
                                $urlEsc = route('careers.show', $career->id);
                                $diffLevel = ($cId % 3 === 0) ? 'Advanced' : (($cId % 3 === 2) ? 'Intermediate' : 'Beginner / Intermediate');
                                $demandVal = $career->market_metrics['demand_score'] ?? 94;
                            @endphp
                            <button type="button"
                                    onclick="toggleCompare({{ $cId }}, '{{ $tEsc }}', '{{ $dEsc }}', '{{ $sEsc }}', '{{ $demandVal }}%', '{{ $diffLevel }}', '{{ $skEsc }}', '{{ $urlEsc }}', '{{ $badgeClass }}', '{{ $domIcon }}')"
                                    id="btn-compare-{{ $cId }}"
                                    class="compare-toggle-btn px-2.5 py-1 text-[10px] font-bold rounded-full border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-300 hover:border-purple-500/30 transition-all flex items-center gap-1.5 bg-slate-50 dark:bg-white/[0.04] shrink-0 shadow-sm"
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
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $career->description }}
                            </p>
                        </div>

                        {{-- Primary Metric Row --}}
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 flex items-center justify-between">
                            <div>
                                <span class="block text-[10px] uppercase font-mono font-bold text-slate-500 dark:text-slate-400">Target Benchmark</span>
                                <span class="text-sm font-black text-emerald-600 dark:text-emerald-400 font-mono">{{ $career->expected_salary }}</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-[10px] uppercase font-mono font-bold text-slate-500 dark:text-slate-400">Market Demand</span>
                                <span class="inline-flex items-center gap-1 text-xs font-black text-indigo-600 dark:text-indigo-400 font-mono">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> {{ $career->market_metrics['demand_score'] ?? '94' }}% High
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Clean CTA Footer --}}
                    <div class="px-6 py-4 border-t border-slate-200/80 dark:border-white/[0.07] bg-slate-50/50 dark:bg-white/[0.01]">
                        <a href="{{ route('careers.show', $career->id) }}" class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-center text-indigo-600 dark:text-indigo-400 bg-indigo-500/10 dark:bg-indigo-500/15 border border-indigo-500/20 hover:bg-indigo-500/20 transition-all flex items-center justify-center gap-2 group/link">
                            <span>View Full Roadmap</span>
                            <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
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

    {{-- ══════════════════ PAGINATION ══════════════════ --}}
    @if ($careers->hasPages())
        <div class="glass-panel rounded-2xl p-4 border border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 backdrop-blur-md shadow-xl">
            <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">
                Showing <strong class="text-slate-900 dark:text-white">{{ $careers->firstItem() }}</strong> to <strong class="text-slate-900 dark:text-white">{{ $careers->lastItem() }}</strong> of <strong class="text-slate-900 dark:text-white">{{ $careers->total() }}</strong> Career Tracks
            </p>

            <div class="flex items-center gap-2">
                {{-- Previous Button --}}
                @if ($careers->onFirstPage())
                    <span class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/40 dark:bg-slate-800/40 text-slate-400 dark:text-slate-600 border border-slate-200/40 dark:border-slate-700/30 cursor-not-allowed select-none flex items-center gap-1.5">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                        <span>Previous</span>
                    </span>
                @else
                    <a href="{{ $careers->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 backdrop-blur-md transition-all flex items-center gap-1.5 hover:scale-105">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                        <span>Previous</span>
                    </a>
                @endif

                {{-- Numeric Page Buttons --}}
                <div class="hidden sm:flex items-center gap-1.5">
                    @foreach ($careers->appends(request()->query())->getUrlRange(1, $careers->lastPage()) as $page => $url)
                        @if ($page == $careers->currentPage())
                            <span class="px-3.5 py-2 text-sm font-bold rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-lg shadow-purple-500/25 border border-purple-400/30 flex items-center justify-center min-w-[38px]">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3.5 py-2 text-sm font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 backdrop-blur-md transition-all flex items-center justify-center min-w-[38px] hover:scale-105">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                {{-- Next Button --}}
                @if ($careers->hasMorePages())
                    <a href="{{ $careers->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 backdrop-blur-md transition-all flex items-center gap-1.5 hover:scale-105">
                        <span>Next</span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                @else
                    <span class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/40 dark:bg-slate-800/40 text-slate-400 dark:text-slate-600 border border-slate-200/40 dark:border-slate-700/30 cursor-not-allowed select-none flex items-center gap-1.5">
                        <span>Next</span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif

</div>

{{-- ══════════════════ FLOATING COMPARISON BOTTOM DOCK ══════════════════ --}}
<div id="compareDock"
     class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 transition-all duration-500 transform translate-y-32 opacity-0 pointer-events-none max-w-2xl w-[92%] sm:w-auto">
    <div class="px-5 py-3.5 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-slate-200 dark:border-slate-800 shadow-[0_10px_40px_rgba(0,0,0,0.15)] dark:shadow-[0_10px_40px_rgba(0,0,0,0.6)] flex items-center justify-between gap-4 sm:gap-6">
        
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center text-white text-xs shrink-0 shadow-lg shadow-purple-500/30">
                <i class="fa-solid fa-code-compare"></i>
            </div>
            
            <div class="space-y-0.5">
                <div class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>Career Comparison</span>
                    <span id="compareCountBadge" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-purple-500/15 dark:bg-purple-500/25 text-purple-700 dark:text-purple-300 border border-purple-500/30">
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
                    class="p-2.5 rounded-xl text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition-colors text-xs"
                    title="Clear comparison">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
    </div>
</div>

{{-- ══════════════════ COMPARISON MATRIX MODAL ══════════════════ --}}
<div id="compareModal"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 pt-24 sm:pt-28 bg-black/70 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300"
     onclick="handleModalBackdropClick(event)">
    
    <div class="relative w-full max-w-5xl max-h-[85vh] flex flex-col rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-2xl overflow-hidden scale-95 transition-transform duration-300"
         id="compareModalContent">
        
        {{-- Modal Top Gradient Accent --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shrink-0 rounded-full mb-4"></div>

        {{-- Modal Header --}}
        <div class="pb-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between gap-4 shrink-0">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/25 text-xs font-semibold text-purple-700 dark:text-purple-300">
                    <i class="fa-solid fa-code-compare text-purple-500 dark:text-purple-400 text-xs"></i>
                    <span>Career Track Intelligence Matrix</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display">
                    Side-by-Side <span class="grad-text">Career Comparison</span>
                </h3>
            </div>

            <button type="button"
                    onclick="closeCompareModal()"
                    class="w-10 h-10 rounded-full bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/20 border border-slate-200 dark:border-white/15 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white flex items-center justify-center transition-all shadow-sm"
                    title="Close comparison modal">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        {{-- Modal Scrollable Body / Comparison Matrix Table --}}
        <div class="py-6 overflow-y-auto flex-1 space-y-6 scrollbar-thin" id="matrixContainer">
            
            <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-white/[0.02]" id="matrixTableWrapper">
                <table class="w-full text-left border-collapse" id="matrixTable">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-100/70 dark:bg-white/[0.03]" id="matrixHeaderRow">
                            <th class="p-5 text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider w-1/4 border-r border-slate-200 dark:border-slate-800">Key Dimensions</th>
                            <!-- Dynamic Career Columns will be injected here -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-white/[0.08] text-sm" id="matrixBody">
                        <!-- Dynamic Rows injected by JS -->
                    </tbody>
                </table>
            </div>

            {{-- Empty State when 0 items selected --}}
            <div id="matrixEmptyState" class="hidden py-12 px-6 text-center space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl mx-auto shadow-sm">
                    <i class="fa-solid fa-code-compare"></i>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-black text-slate-900 dark:text-white font-display">Choose up to three roles to compare</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 max-w-md mx-auto">Select 2 or 3 career tracks from the list above to see live side-by-side salary benchmarks, market demand scores, and skill requirements.</p>
                </div>
            </div>

        </div>

        {{-- Modal Footer --}}
        <div class="pt-5 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 shrink-0">
            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                <i class="fa-solid fa-circle-check text-emerald-500 dark:text-emerald-400"></i>
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
        btn.classList.remove('border-purple-500/60', 'text-purple-600', 'dark:text-purple-300', 'bg-purple-500/20');
        btn.classList.add('border-slate-200', 'dark:border-white/10', 'text-slate-500', 'dark:text-slate-400');
        if (icon) { icon.className = 'fa-solid fa-plus text-[9px] icon-state'; }
        if (label) { label.textContent = 'Compare'; }
    });

    compareState.items.forEach(item => {
        const btn = document.getElementById(`btn-compare-${item.id}`);
        if (btn) {
            btn.classList.remove('border-slate-200', 'dark:border-white/10', 'text-slate-500', 'dark:text-slate-400');
            btn.classList.add('border-purple-500/60', 'text-purple-600', 'dark:text-purple-300', 'bg-purple-500/20');
            const icon = btn.querySelector('.icon-state');
            const label = btn.querySelector('.label-state');
            if (icon) { icon.className = 'fa-solid fa-check text-[9px] icon-state text-purple-600 dark:text-purple-400'; }
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
            pill.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-[10px] font-medium text-slate-700 dark:text-slate-300';
            pill.innerHTML = `
                <span class="max-w-[90px] truncate">${item.title}</span>
                <button type="button" onclick="toggleCompare(${item.id})" class="text-slate-400 hover:text-rose-500 transition-colors">
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
    const tableWrapper = document.getElementById('matrixTableWrapper');
    const emptyState = document.getElementById('matrixEmptyState');
    const headerRow = document.getElementById('matrixHeaderRow');
    const body = document.getElementById('matrixBody');

    if (items.length === 0) {
        if (tableWrapper) tableWrapper.classList.add('hidden');
        if (emptyState) emptyState.classList.remove('hidden');
        return;
    }

    if (tableWrapper) tableWrapper.classList.remove('hidden');
    if (emptyState) emptyState.classList.add('hidden');

    // Header Row with dismissal actions
    headerRow.innerHTML = `<th class="p-5 text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider w-1/4 min-w-[170px] border-r border-slate-200 dark:border-slate-800">Key Dimensions</th>`;
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
                    <button type="button" onclick="toggleCompare(${item.id}); renderComparisonMatrix();" class="w-6 h-6 rounded-full bg-slate-100 dark:bg-white/5 hover:bg-rose-500/20 text-slate-500 dark:text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 flex items-center justify-center transition-colors text-[10px]" title="Remove from comparison">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <h4 class="text-base sm:text-lg font-black text-slate-900 dark:text-white font-display leading-tight">${item.title}</h4>
            </div>
        `;
        headerRow.appendChild(th);
    });

    // Difficulty badge helper
    const diffStyles = {
        'Advanced': 'bg-purple-500/15 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border-purple-500/30',
        'Intermediate': 'bg-amber-500/15 dark:bg-amber-500/20 text-amber-700 dark:text-amber-300 border-amber-500/30',
        'Beginner / Intermediate': 'bg-emerald-500/15 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border-emerald-500/30'
    };

    // Body Rows
    body.innerHTML = `
        {{-- Row: Salary Range --}}
        <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-700 dark:text-slate-300 text-xs border-r border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                    <span>Salary Range</span>
                </div>
            </td>
            ${items.map(item => `
                <td class="p-5 align-middle">
                    <div class="text-lg font-black text-emerald-600 dark:text-emerald-400 font-display">${item.salary}</div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium mt-0.5">Annual Median Benchmark</div>
                </td>
            `).join('')}
        </tr>

        {{-- Row: Market Demand --}}
        <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-700 dark:text-slate-300 text-xs border-r border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span>Market Demand</span>
                </div>
            </td>
            ${items.map(item => `
                <td class="p-5 align-middle space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/30 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-pulse"></span>
                            <span>High Growth</span>
                        </span>
                        <span class="text-xs font-black text-indigo-600 dark:text-indigo-300 font-mono">${item.demand}</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 via-indigo-500 to-purple-500" style="width: 94%;"></div>
                    </div>
                </td>
            `).join('')}
        </tr>

        {{-- Row: Core Difficulty --}}
        <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-700 dark:text-slate-300 text-xs border-r border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <span>Core Difficulty</span>
                </div>
            </td>
            ${items.map(item => {
                const dClass = diffStyles[item.difficulty] || 'bg-purple-500/15 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border-purple-500/30';
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
        <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-700 dark:text-slate-300 text-xs border-r border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xs shrink-0">
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
                                <span class="px-2.5 py-1 text-[11px] font-semibold rounded-lg bg-slate-100 dark:bg-white/[0.05] border border-slate-200 dark:border-white/10 text-slate-800 dark:text-slate-200 shadow-sm">
                                    ${s}
                                </span>
                            `).join('')}
                        </div>
                    </td>
                `;
            }).join('')}
        </tr>

        {{-- Row: Full Roadmap Action --}}
        <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-700 dark:text-slate-300 text-xs border-r border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-purple-500/15 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs shrink-0">
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
