@extends('layouts.app')
@section('title', $career->title . ' — PathSeeker Career Detail')
@section('content')

@php
    $domLower = strtolower($career->domain);
    $badgeClass = 'badge-software'; $domIcon = 'fa-code'; $accentColor = 'indigo';
    if (str_contains($domLower, 'cloud') || str_contains($domLower, 'devops') || str_contains($domLower, 'infrastructure')) {
        $badgeClass = 'badge-cloud'; $domIcon = 'fa-cloud'; $accentColor = 'sky';
    } elseif (str_contains($domLower, 'ai') || str_contains($domLower, 'artificial') || str_contains($domLower, 'data')) {
        $badgeClass = 'badge-ai'; $domIcon = 'fa-brain'; $accentColor = 'violet';
    } elseif (str_contains($domLower, 'cyber') || str_contains($domLower, 'security')) {
        $badgeClass = 'badge-cyber'; $domIcon = 'fa-shield-halved'; $accentColor = 'rose';
    } elseif (str_contains($domLower, 'mobile')) {
        $badgeClass = 'badge-mobile'; $domIcon = 'fa-mobile-screen'; $accentColor = 'emerald';
    } elseif (str_contains($domLower, 'design') || str_contains($domLower, 'ui')) {
        $badgeClass = 'badge-design'; $domIcon = 'fa-palette'; $accentColor = 'pink';
    } elseif (str_contains($domLower, 'blockchain')) {
        $badgeClass = 'badge-blockchain'; $domIcon = 'fa-cubes'; $accentColor = 'amber';
    } elseif (str_contains($domLower, 'game')) {
        $badgeClass = 'badge-game'; $domIcon = 'fa-gamepad'; $accentColor = 'orange';
    }
    $skills = array_filter(array_map('trim', explode(',', $career->required_skills)));

    // Structured Career Path Flow (Foundation -> Core Skills -> Projects -> Target Career)
    $roadmap = [
        ['step' => '01', 'phase' => 'Foundation',    'status' => 'Completed',   'icon' => 'fa-seedling',    'color' => 'emerald', 'desc' => 'Master computer science fundamentals, data structures, and essential CLI toolchains.'],
        ['step' => '02', 'phase' => 'Core Skills',   'status' => 'Completed',   'icon' => 'fa-wrench',      'color' => 'emerald', 'desc' => 'Gain deep hands-on proficiency in target domain frameworks, APIs, and modern toolsets.'],
        ['step' => '03', 'phase' => 'Projects',      'status' => 'In Progress', 'icon' => 'fa-diagram-project', 'color' => 'indigo',  'desc' => 'Architect production-grade projects, microservices, and end-to-end cloud deployments.'],
        ['step' => '04', 'phase' => 'Target Career', 'status' => 'Upcoming',    'icon' => 'fa-rocket',      'color' => 'purple',  'desc' => 'Industry certification verification, technical portfolio defense, and senior job landing.'],
    ];
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 pb-16 space-y-8">

    {{-- ── Breadcrumb ──────────────────────────────── --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-purple-300 transition-colors group">
            <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1.5 transition-transform"></i>
            <span>Back to Career Bank</span>
        </a>
        <div class="hidden sm:inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100/80 dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/[0.08] text-xs font-mono text-slate-600 dark:text-slate-400 shadow-sm">
            <span class="text-purple-600 dark:text-purple-400 font-bold">TRACK</span>
            <span>&bull;</span>
            <span>#{{ str_pad($career->id, 3, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    {{-- ── SECTION 1: Hero Header ───────────────────── --}}
    <div class="relative rounded-3xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        {{-- Top accent bar --}}
        <div class="h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

        <div class="p-8 sm:p-10 lg:p-12 relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-6">
                <div class="space-y-4 flex-1">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                        <i class="fa-solid {{ $domIcon }} text-[10px]"></i>
                        <span>{{ $career->domain }}</span>
                    </span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white leading-tight font-display">
                        {{ $career->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/25">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Verified 2026 Role
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-indigo-500/15 text-indigo-700 dark:text-indigo-300 border border-indigo-500/25">
                            <i class="fa-solid fa-chart-line text-[10px]"></i> High Demand
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25">
                            <i class="fa-solid fa-trophy text-[10px]"></i> Top Earning Track
                        </span>
                    </div>
                </div>
                {{-- Salary Callout --}}
                <div class="shrink-0 p-6 rounded-2xl bg-slate-100/80 dark:bg-slate-950/60 border border-emerald-500/30 text-center min-w-[160px] shadow-sm backdrop-blur-md">
                    <div class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 mb-1 uppercase tracking-widest font-mono">Salary Benchmark</div>
                    <div class="text-2xl font-black text-slate-900 dark:text-white font-display">{{ $career->expected_salary }}</div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Annual Median</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SECTION 2: Demand & Market Metrics ──────── --}}
    <div class="space-y-4">
        <h2 class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest flex items-center gap-2">
            <i class="fa-solid fa-chart-bar text-indigo-400"></i> Market Intelligence Telemetry
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- Market Demand --}}
            <div class="glass-panel rounded-2xl p-6 border border-slate-200/80 dark:border-white/[0.07] space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-chart-line text-indigo-400"></i>
                    </div>
                    <span class="text-2xl font-black text-indigo-500 dark:text-indigo-400 font-display">{{ $career->market_metrics['demand_score'] }}%</span>
                </div>
                <div>
                    <div class="text-sm font-bold text-slate-900 dark:text-white mb-0.5">Market Demand</div>
                    <div class="text-xs text-slate-500">Global hiring index Q1 2026</div>
                </div>
                <div class="space-y-1">
                    <div class="w-full h-2 rounded-full bg-slate-100 dark:bg-white/[0.06] overflow-hidden">
                        <div class="detail-bar h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500" data-width="{{ $career->market_metrics['demand_score'] }}" style="width:0%;transition:width 1s cubic-bezier(0.4,0,0.2,1)"></div>
                    </div>
                    <div class="flex items-center gap-1 text-[10px] text-emerald-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ $career->market_metrics['hiring_index'] }}</span>
                    </div>
                </div>
            </div>

            {{-- 5-Year Growth --}}
            <div class="glass-panel rounded-2xl p-6 border border-slate-200/80 dark:border-white/[0.07] space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-pink-500/15 border border-pink-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-arrow-trend-up text-pink-400"></i>
                    </div>
                    <span class="text-2xl font-black text-pink-500 dark:text-pink-400 font-display">{{ $career->market_metrics['growth_rate'] }}</span>
                </div>
                <div>
                    <div class="text-sm font-bold text-slate-900 dark:text-white mb-0.5">5-Year Growth</div>
                    <div class="text-xs text-slate-500">Projected sector expansion</div>
                </div>
                <div class="space-y-1">
                    <div class="w-full h-2 rounded-full bg-slate-100 dark:bg-white/[0.06] overflow-hidden">
                        <div class="detail-bar h-full rounded-full bg-gradient-to-r from-purple-500 to-pink-500" data-width="{{ min(100, $career->market_metrics['growth_value'] * 2) }}" style="width:0%;transition:width 1s cubic-bezier(0.4,0,0.2,1) 0.15s"></div>
                    </div>
                    <div class="flex items-center gap-1 text-[10px] text-pink-500">
                        <i class="fa-solid fa-arrow-up text-[9px]"></i>
                        <span>{{ $career->market_metrics['sentiment'] }}</span>
                    </div>
                </div>
            </div>

            {{-- Verification Status --}}
            <div class="glass-panel rounded-2xl p-6 border border-slate-200/80 dark:border-white/[0.07] space-y-4">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/15 border border-emerald-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-shield-check text-emerald-400"></i>
                    </div>
                    <span class="text-sm font-black text-emerald-500 dark:text-emerald-400 font-display">Verified</span>
                </div>
                <div>
                    <div class="text-sm font-bold text-slate-900 dark:text-white mb-0.5">PathSeeker Certified</div>
                    <div class="text-xs text-slate-500">2026 Industry Standard review</div>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    <span class="px-2 py-0.5 text-[9px] font-semibold rounded-full bg-emerald-500/15 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400">ISO Aligned</span>
                    <span class="px-2 py-0.5 text-[9px] font-semibold rounded-full bg-indigo-500/15 border border-indigo-500/20 text-indigo-600 dark:text-indigo-400">Peer-Reviewed</span>
                </div>
            </div>

        </div>
    </div>

    {{-- ── SECTION 2.5: 10-Year Predictive Market Trajectory Graph ──────── --}}
    <div class="glass-panel rounded-3xl border border-slate-200/80 dark:border-white/[0.07] overflow-hidden p-6 sm:p-8 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200/80 dark:border-white/[0.07]">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/25 text-xs font-semibold text-purple-700 dark:text-purple-300">
                    <i class="fa-solid fa-chart-line text-purple-500 dark:text-purple-400 text-xs"></i>
                    <span>Predictive Telemetry (2021 — 2030)</span>
                </div>
                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white font-display">
                    10-Year Market Trajectory (2021-2030)
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Historical industry telemetry (2021-2025) synthesized with predictive machine learning growth modeling (2026-2030).
                </p>
            </div>
            <div class="flex items-center gap-4 text-xs font-mono shrink-0">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-indigo-500 shadow-sm"></span>
                    <span class="text-slate-600 dark:text-slate-300 font-medium">Historical</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-0.5 border-t-2 border-dashed border-purple-500 dark:border-purple-400"></span>
                    <span class="text-purple-600 dark:text-purple-300 font-medium">Predictive Forecast</span>
                </div>
            </div>
        </div>

        {{-- Canvas Chart Container --}}
        <div class="relative w-full h-64 sm:h-80">
            <canvas id="careerGrowthChart"></canvas>
        </div>

        {{-- Chart Bottom Telemetry Indicators --}}
        <div class="pt-4 border-t border-slate-200/60 dark:border-white/[0.05] grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/[0.05] space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 font-mono">Current 2026 Index</div>
                <div class="text-base font-black text-indigo-600 dark:text-indigo-400 font-display">{{ $career->market_metrics['demand_score'] }} pts</div>
                <div class="text-[11px] text-slate-500 dark:text-slate-400">Top quartile industry hiring benchmark</div>
            </div>
            <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/[0.05] space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 font-mono">2030 Forecast Ceiling</div>
                <div class="text-base font-black text-purple-600 dark:text-purple-400 font-display">{{ end($career->market_metrics['trajectory_data']) }} pts</div>
                <div class="text-[11px] text-slate-500 dark:text-slate-400">Compound projected expansion estimate</div>
            </div>
            <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/[0.05] space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 font-mono">Market Velocity</div>
                <div class="text-base font-black text-emerald-600 dark:text-emerald-400 font-display">{{ $career->market_metrics['growth_rate'] }}</div>
                <div class="text-[11px] text-slate-500 dark:text-slate-400">{{ $career->market_metrics['sentiment'] }}</div>
            </div>
        </div>
    </div>

    {{-- ── SECTION 3: Overview ──────────────────────── --}}
    <div class="glass-panel rounded-3xl border border-slate-200/80 dark:border-white/[0.07] overflow-hidden">
        <div class="px-7 py-4 border-b border-slate-200/80 dark:border-white/[0.07] flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-white/[0.05] flex items-center justify-center">
                <i class="fa-solid fa-align-left text-slate-500 dark:text-slate-400 text-sm"></i>
            </div>
            <h2 class="text-sm font-black text-slate-900 dark:text-white">Role Overview</h2>
        </div>
        <div class="p-7">
            <p class="text-slate-700 dark:text-slate-300 text-base leading-relaxed">{{ $career->description }}</p>
        </div>
    </div>

    {{-- ── SECTION 4: Required Skills Matrix ────────── --}}
    <div class="glass-panel rounded-3xl border border-slate-200/80 dark:border-white/[0.07] overflow-hidden">
        <div class="px-7 py-4 border-b border-slate-200/80 dark:border-white/[0.07] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-amber-500/15 flex items-center justify-center border border-amber-500/20">
                    <i class="fa-solid fa-bolt text-amber-500 text-sm"></i>
                </div>
                <h2 class="text-sm font-black text-slate-900 dark:text-white">Required Skills & Technologies</h2>
            </div>
            <span class="text-xs text-slate-400">{{ count($skills) }} competencies</span>
        </div>
        <div class="p-7 space-y-5">
            {{-- Categorized skill pills --}}
            <div class="flex flex-wrap gap-2.5">
                @foreach($skills as $i => $skill)
                    <span class="skill-pill inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold glass-panel rounded-full border border-slate-200/80 dark:border-white/[0.08] text-slate-800 dark:text-slate-200 hover:border-purple-500/40 hover:text-indigo-600 dark:hover:text-indigo-300 transition-all cursor-default opacity-0"
                          style="transition: opacity 0.3s ease {{ $i * 0.05 }}s, transform 0.3s ease {{ $i * 0.05 }}s; transform: translateY(6px);">
                        <i class="fa-solid fa-check text-[9px] text-purple-500"></i>
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
            {{-- Skill proficiency guide --}}
            <div class="pt-4 border-t border-slate-200/60 dark:border-white/[0.05] grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/[0.05] space-y-1">
                    <div class="flex items-center gap-1.5 text-[10px] font-semibold text-indigo-600 dark:text-indigo-400">
                        <span class="w-2 h-2 rounded-full bg-indigo-500"></span> Entry Level
                    </div>
                    <p class="text-[10px] text-slate-500">Core foundations — first {{ min(3, count($skills)) }} skills are entry-level requirements.</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/[0.05] space-y-1">
                    <div class="flex items-center gap-1.5 text-[10px] font-semibold text-purple-600 dark:text-purple-400">
                        <span class="w-2 h-2 rounded-full bg-purple-500"></span> Mid Level
                    </div>
                    <p class="text-[10px] text-slate-500">Professional depth — build specialization across the full skill set.</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/[0.05] space-y-1">
                    <div class="flex items-center gap-1.5 text-[10px] font-semibold text-pink-600 dark:text-pink-400">
                        <span class="w-2 h-2 rounded-full bg-pink-500"></span> Senior Level
                    </div>
                    <p class="text-[10px] text-slate-500">Architectural mastery — architect, mentor, and lead with all competencies.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SECTION 5: Salary Breakdown ─────────────── --}}
    <div class="glass-panel rounded-3xl border border-slate-200/80 dark:border-white/[0.07] overflow-hidden">
        <div class="px-7 py-4 border-b border-slate-200/80 dark:border-white/[0.07] flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-500/15 flex items-center justify-center border border-emerald-500/20">
                <i class="fa-solid fa-circle-dollar-to-slot text-emerald-500 text-sm"></i>
            </div>
            <h2 class="text-sm font-black text-slate-900 dark:text-white">Salary Intelligence</h2>
        </div>
        <div class="p-7">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="p-5 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/[0.06] text-center space-y-1">
                    <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest font-mono">Entry Level</div>
                    <div class="text-xl font-black text-slate-800 dark:text-slate-200 font-display">$70k–$90k</div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400">0–2 years experience</div>
                </div>
                <div class="p-5 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-purple-500/10 dark:from-indigo-950/40 dark:to-purple-950/40 border border-indigo-500/30 text-center space-y-1 relative overflow-hidden">
                    <div class="absolute top-2 right-2 px-1.5 py-0.5 rounded text-[8px] font-bold bg-indigo-500/20 text-indigo-700 dark:text-indigo-400 border border-indigo-500/30 font-mono">MEDIAN</div>
                    <div class="text-[10px] font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest font-mono">Mid Level</div>
                    <div class="text-xl font-black text-slate-900 dark:text-white font-display">{{ $career->expected_salary }}</div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400">3–6 years experience</div>
                </div>
                <div class="p-5 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/[0.06] text-center space-y-1">
                    <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest font-mono">Senior / Lead</div>
                    <div class="text-xl font-black text-emerald-600 dark:text-emerald-400 font-display">$160k+</div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400">7+ years experience</div>
                </div>
            </div>
            {{-- Visual salary bar --}}
            <div class="space-y-2">
                <div class="relative h-3 rounded-full bg-slate-200/80 dark:bg-white/[0.05] overflow-hidden">
                    <div class="absolute left-0 inset-y-0 w-[30%] bg-slate-300 dark:bg-white/10 rounded-l-full"></div>
                    <div class="absolute left-[30%] inset-y-0 w-[40%] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 salary-bar" style="width:0%;transition:width 1.2s cubic-bezier(0.4,0,0.2,1)"></div>
                    <div class="absolute right-0 inset-y-0 w-[30%] bg-emerald-400/40 rounded-r-full"></div>
                </div>
                <div class="flex justify-between text-[9px] text-slate-500 dark:text-slate-400 px-1 font-mono">
                    <span>$70k</span><span class="text-indigo-600 dark:text-indigo-400 font-semibold">Median Range</span><span>$200k+</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SECTION 6: Career Roadmap Journey (Timeline Flow) ────────── --}}
    <div class="glass-panel rounded-3xl border border-slate-200/80 dark:border-white/[0.07] overflow-hidden">
        <div class="px-7 py-4 border-b border-slate-200/80 dark:border-white/[0.07] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-purple-500/15 flex items-center justify-center border border-purple-500/20">
                    <i class="fa-solid fa-map-location-dot text-purple-600 dark:text-purple-400 text-sm"></i>
                </div>
                <h2 class="text-sm font-black text-slate-900 dark:text-white">Career Path Progression Flow</h2>
            </div>
            <span class="text-xs text-purple-600 dark:text-purple-400 font-mono font-semibold">4 Milestones</span>
        </div>
        <div class="p-7">
            <div class="relative">
                {{-- Glowing Desktop Connector Line --}}
                <div class="hidden sm:block absolute top-10 left-12 right-12 h-1 bg-gradient-to-r from-emerald-500 via-indigo-500 to-purple-500/40 rounded-full"></div>
                
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 sm:gap-4">
                    @foreach($roadmap as $i => $stage)
                    @php
                        $statusStyles = [
                            'Completed'   => ['badge' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border-emerald-500/30', 'dot' => 'bg-emerald-500', 'ring' => 'bg-emerald-600', 'glow' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-600 dark:text-emerald-400'],
                            'In Progress' => ['badge' => 'bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 border-indigo-500/40',   'dot' => 'bg-indigo-500 animate-ping', 'ring' => 'bg-indigo-600', 'glow' => 'bg-indigo-500/15 border-indigo-500/40 text-indigo-600 dark:text-indigo-400 shadow-lg shadow-indigo-500/20'],
                            'Upcoming'    => ['badge' => 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-white/10', 'dot' => 'bg-slate-400', 'ring' => 'bg-slate-600', 'glow' => 'bg-slate-100/80 dark:bg-white/[0.03] border-slate-200/80 dark:border-white/[0.08] text-slate-500 dark:text-slate-400'],
                        ];
                        $st = $statusStyles[$stage['status']];
                    @endphp
                    <div class="flex sm:flex-col items-start sm:items-center gap-4 sm:gap-3 sm:text-center roadmap-step opacity-0 group"
                         style="transition: opacity 0.4s ease {{ $i * 0.1 }}s, transform 0.4s ease {{ $i * 0.1 }}s; transform: translateY(12px)">
                        
                        {{-- Node Icon with Glowing Badge --}}
                        <div class="relative shrink-0">
                            <div class="w-16 h-16 rounded-2xl {{ $st['glow'] }} border flex items-center justify-center group-hover:scale-105 transition-transform backdrop-blur-md">
                                <i class="fa-solid {{ $stage['icon'] }} text-xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full {{ $st['ring'] }} text-white text-[9px] font-black flex items-center justify-center border-2 border-white dark:border-[#090b14]">{{ $stage['step'] }}</div>
                        </div>

                        {{-- Node Details & Status Badge --}}
                        <div class="space-y-1.5 flex-1 sm:flex-initial">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-bold border {{ $st['badge'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $st['dot'] }}"></span>
                                <span>{{ $stage['status'] }}</span>
                            </span>
                            <h4 class="text-sm font-black text-slate-900 dark:text-white leading-snug">{{ $stage['phase'] }}</h4>
                            <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed sm:max-w-[170px]">{{ $stage['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ── Action Controls ──────────────────────────── --}}
    <div class="glass-panel rounded-3xl border border-slate-200/80 dark:border-white/[0.07] p-7 flex flex-wrap gap-4 items-center justify-between">
        <div>
            <h3 class="text-base font-black text-slate-900 dark:text-white">Ready to pursue this track?</h3>
            <p class="text-xs text-slate-500 mt-0.5">Take the interest quiz or access masterclasses and toolkits below.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('quiz.index') }}" class="btn-sweep px-6 py-3 rounded-full font-bold text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-lg shadow-purple-500/25 transition-all flex items-center gap-2 hover:scale-105">
                <i class="fa-solid fa-brain text-xs"></i>
                <span>Assess Role Alignment</span>
            </a>
            <a href="{{ route('multimedia.index') }}" class="px-6 py-3 glass-panel rounded-full text-sm font-bold text-slate-800 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-purple-500/30 transition-all flex items-center gap-2 hover:scale-105">
                <i class="fa-solid fa-play text-xs text-purple-400"></i>
                <span>Watch Masterclasses</span>
            </a>
            <a href="{{ route('resources.index') }}" class="px-6 py-3 glass-panel rounded-full text-sm font-bold text-slate-800 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-purple-500/30 transition-all flex items-center gap-2 hover:scale-105">
                <i class="fa-solid fa-download text-xs text-cyan-400"></i>
                <span>Download Toolkits</span>
            </a>
        </div>
    </div>

</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Animate bars on scroll-into-view
    const allBars = document.querySelectorAll('.detail-bar');
    const salBar  = document.querySelector('.salary-bar');
    const skills  = document.querySelectorAll('.skill-pill');
    const steps   = document.querySelectorAll('.roadmap-step');

    function reveal(els, extra) {
        if (!('IntersectionObserver' in window)) {
            els.forEach(el => { extra(el); }); return;
        }
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { extra(e.target); obs.unobserve(e.target); } });
        }, { threshold: 0.15 });
        els.forEach(el => obs.observe(el));
    }

    reveal(allBars, el => { el.style.width = el.getAttribute('data-width') + '%'; });

    if (salBar) {
        const obs2 = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { salBar.style.width = '40%'; obs2.disconnect(); } });
        }, { threshold: 0.2 });
        obs2.observe(salBar);
    }

    reveal(skills, el => { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; });
    reveal(steps,  el => { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; });

    // 2. Initialize 10-Year Predictive Chart
    const chartCanvas = document.getElementById('careerGrowthChart');
    if (chartCanvas) {
        const ctx = chartCanvas.getContext('2d');
        const gradientFill = ctx.createLinearGradient(0, 0, 0, 300);
        gradientFill.addColorStop(0, 'rgba(168, 85, 247, 0.4)');
        gradientFill.addColorStop(0.5, 'rgba(99, 102, 241, 0.15)');
        gradientFill.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

        const labels = {!! json_encode($career->market_metrics['trajectory_labels']) !!};
        const dataValues = {!! json_encode($career->market_metrics['trajectory_data']) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Market Index',
                    data: dataValues,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: (context) => context.dataIndex === 5 ? 7 : 4,
                    pointHoverRadius: 8,
                    pointBackgroundColor: (context) => {
                        if (context.dataIndex === 5) return '#ec4899';
                        return context.dataIndex > 5 ? '#a855f7' : '#6366f1';
                    },
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    segment: {
                        borderColor: (ctx) => ctx.p0DataIndex >= 5 ? '#a855f7' : '#6366f1',
                        borderDash: (ctx) => ctx.p0DataIndex >= 5 ? [6, 6] : undefined,
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            title: (tooltipItems) => {
                                const item = tooltipItems[0];
                                return `Year: ${item.label}`;
                            },
                            label: (context) => {
                                const isProj = context.dataIndex > 5;
                                const isCurrent = context.dataIndex === 5;
                                const status = isCurrent ? ' (Current Telemetry)' : (isProj ? ' (Predictive Forecast)' : ' (Historical Telemetry)');
                                return `Market Capitalization Index: ${context.parsed.y} pts${status}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 11,
                                family: "'Plus Jakarta Sans', sans-serif"
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(148, 163, 184, 0.08)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 11,
                                family: "'Plus Jakarta Sans', sans-serif"
                            },
                            callback: (value) => `${value} pts`
                        },
                        suggestedMin: 40
                    }
                }
            }
        });
    }
});
</script>
@endsection
