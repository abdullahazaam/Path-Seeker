@extends('layouts.app')
@section('title', 'Career Passport Dashboard — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2 sm:pt-3 space-y-6 md:space-y-8 mb-8">


@if(auth()->user()->role !== 'admin' && auth()->user()->email !== 'admin@pathseeker.com')
    {{-- Passport User Profile Header --}}
    <div class="card-tilt-3d relative rounded-3xl p-8 md:p-10 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 overflow-hidden shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-500/15 dark:bg-blue-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-cyan-500/15 dark:bg-cyan-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                {{-- Executive Large Avatar --}}
                <div class="w-20 h-20 md:w-24 md:h-24 rounded-3xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 font-black text-3xl shadow-xl shadow-cyan-500/25 border-2 border-white/20 shrink-0">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="space-y-2.5">
                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white font-display tracking-tight leading-none">{{ $user->name }}</h1>
                        <span class="px-3.5 py-1 text-xs font-black uppercase tracking-wider rounded-full bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25 shadow-sm font-mono">
                            {{ $user->role }}
                        </span>
                        <span class="px-3.5 py-1 text-xs font-black uppercase tracking-wider rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25 flex items-center gap-1.5 shadow-sm">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Active Passport
                        </span>
                        {{-- Subtle Edit Profile Pill --}}
                        <button type="button" onclick="document.getElementById('pathBuilderSection')?.scrollIntoView({behavior: 'smooth'})" title="Edit Focus & Roadmap" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-white/10 hover:bg-cyan-500/20 border border-slate-300 dark:border-white/10 hover:border-cyan-500/40 text-xs font-semibold text-slate-700 dark:text-slate-300 hover:text-cyan-600 dark:hover:text-white transition-all shadow-sm cursor-pointer">
                            <i class="fa-solid fa-pen text-[10px] text-cyan-600 dark:text-cyan-400"></i>
                            <span>Edit Profile</span>
                        </button>
                    </div>
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 font-medium flex items-center gap-2 flex-wrap">
                        <span><i class="fa-regular fa-envelope text-xs text-cyan-500 mr-1"></i>{{ $user->email }}</span>
                        <span class="text-slate-400 dark:text-slate-600">&bull;</span>
                        <span><i class="fa-solid fa-graduation-cap text-xs text-sky-500 mr-1"></i>{{ $user->profile->education_level ?? 'Career Explorer' }}</span>
                    </p>
                    @if($user->profile && $user->profile->interests)
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 flex items-center gap-1.5 flex-wrap pt-0.5">
                            <strong class="text-slate-800 dark:text-slate-200"><i class="fa-solid fa-crosshairs text-cyan-500 mr-1 text-xs"></i>Focus Areas:</strong>
                            <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200/80 dark:border-white/10 font-medium text-slate-700 dark:text-slate-300">{{ $user->profile->interests }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('quiz.index') }}" class="btn-sweep group inline-flex items-center gap-3 px-8 py-4 rounded-full font-black text-sm sm:text-base text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_25px_rgba(0,242,254,0.35)] transition-all duration-300 hover:scale-105">
                    <i class="fa-solid fa-brain text-sm text-slate-950"></i>
                    <span class="text-slate-950 font-black">Take Assessment</span>
                    <i class="fa-solid fa-arrow-right text-xs text-slate-950 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Role-Personalized Guidance Banner --}}
    @if(isset($rolePersonalization))
        <div class="relative rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
            {{-- Ambient glow --}}
            <div class="absolute -top-16 -right-16 w-60 h-60 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-2xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-cyan-700 dark:text-cyan-400 font-mono">
                        <i class="fa-solid fa-bullseye text-cyan-600 dark:text-cyan-400"></i>
                        <span>Personalized for {{ $userRole === 'student' ? 'Students' : ($userRole === 'graduate' ? 'Graduates' : ($userRole === 'professional' ? 'Professionals' : 'Users')) }}</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white font-display">{{ $rolePersonalization['tagline'] ?? 'Role Guidance' }}</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $rolePersonalization['focus'] ?? 'Explore your specialized resources and career trajectories.' }}</p>
                </div>
                <a href="{{ $rolePersonalization['action_route'] ?? route('careers.index') }}" class="px-5 py-2.5 rounded-xl font-bold text-xs text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-white/[0.06] hover:bg-slate-200 dark:hover:bg-white/[0.12] border border-slate-200 dark:border-white/10 transition-all shrink-0 flex items-center gap-2 shadow-sm hover:scale-105">
                    <span>{{ $rolePersonalization['action_label'] ?? 'Explore' }}</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    @endif

    {{-- ══════════════════ 2.5 MY CAREER CONTROL ROOM (FUTURISTIC OS COMMAND CENTER) ══════════════════ --}}
    <div class="control-room-card app-card relative rounded-3xl p-6 sm:p-8 md:p-10 bg-white dark:bg-[#080B12] border-0 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden reveal-element">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-28 -right-28 w-80 h-80 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-[120px] pointer-events-none"></div>
        <div class="absolute -bottom-28 -left-28 w-80 h-80 rounded-full bg-blue-500/10 dark:bg-blue-500/15 blur-[120px] pointer-events-none"></div>

        <div class="relative z-10 space-y-6">
            {{-- Control Room Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 text-xs font-mono font-bold text-cyan-700 dark:text-cyan-400">
                        <span class="w-2 h-2 rounded-full bg-cyan-500 dark:bg-cyan-400 animate-ping"></span>
                        <span>MY CAREER CONTROL ROOM // OS v4.0</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-gamepad text-cyan-600 dark:text-cyan-400 text-lg"></i>
                        <span>Autonomous Command Center</span>
                    </h2>
                </div>

                <div class="flex items-center gap-2 font-mono text-xs text-slate-600 dark:text-slate-400">
                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 text-cyan-700 dark:text-cyan-300 font-bold">
                        NODE: {{ strtoupper($user->role ?? 'SCHOLAR') }}
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 flex items-center gap-1.5 font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-pulse"></span>
                        TELEMETRY SYNCED
                    </span>
                </div>
            </div>

            {{-- 3-Column Control Console Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                {{-- Column 1: Multi-Tier Readiness Telemetry Bars --}}
                <div class="lg:col-span-5 p-5 rounded-2xl bg-slate-50/80 dark:bg-white/[0.03] space-y-4">
                    <div class="flex items-center justify-between font-mono text-xs">
                        <span class="text-slate-600 dark:text-slate-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-chart-simple text-cyan-600 dark:text-cyan-400"></i> Competency Flight Deck
                        </span>
                        <span class="text-cyan-600 dark:text-cyan-400 font-bold">88% Aggregate</span>
                    </div>

                    <div class="space-y-3 font-mono text-xs">
                        {{-- Bar 1 --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-slate-700 dark:text-slate-300 font-medium">
                                <span>Foundational Architecture</span>
                                <span class="text-cyan-600 dark:text-cyan-400 font-bold">92%</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-sky-500" style="width: 92%;"></div>
                            </div>
                        </div>

                        {{-- Bar 2 --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-slate-700 dark:text-slate-300 font-medium">
                                <span>Toolchain &amp; Cloud Mastery</span>
                                <span class="text-sky-600 dark:text-sky-400 font-bold">85%</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-sky-400 to-blue-600" style="width: 85%;"></div>
                            </div>
                        </div>

                        {{-- Bar 3 --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-slate-700 dark:text-slate-300 font-medium">
                                <span>Interview &amp; System Design</span>
                                <span class="text-emerald-600 dark:text-emerald-400 font-bold">80%</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-400" style="width: 80%;"></div>
                            </div>
                        </div>

                        {{-- Bar 4 --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-slate-700 dark:text-slate-300 font-medium">
                                <span>Threat Defense &amp; Security</span>
                                <span class="text-cyan-600 dark:text-cyan-400 font-bold">94%</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-blue-600" style="width: 94%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Column 2: Active Tactical Directives --}}
                <div class="lg:col-span-4 p-5 rounded-2xl bg-slate-50/80 dark:bg-white/[0.03] space-y-3 font-mono">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600 dark:text-slate-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-crosshairs text-cyan-600 dark:text-cyan-400"></i> Next Mission Objectives
                        </span>
                        <span class="text-cyan-600 dark:text-cyan-400 font-bold">3 Pending</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="p-2.5 rounded-xl bg-white dark:bg-white/[0.03] flex items-start gap-2.5 hover:border-cyan-500/40 transition-colors shadow-2xs dark:shadow-none">
                            <i class="fa-regular fa-circle-dot text-cyan-600 dark:text-cyan-400 mt-0.5 text-xs"></i>
                            <div class="min-w-0 flex-1">
                                <div class="text-slate-900 dark:text-white font-bold truncate">01. Execute Interest Assessment</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">Recalculate RIASEC weighted matches</div>
                            </div>
                        </div>

                        <div class="p-2.5 rounded-xl bg-white dark:bg-white/[0.03] flex items-start gap-2.5 hover:border-cyan-500/40 transition-colors shadow-2xs dark:shadow-none">
                            <i class="fa-regular fa-circle-dot text-sky-600 dark:text-sky-400 mt-0.5 text-xs"></i>
                            <div class="min-w-0 flex-1">
                                <div class="text-slate-900 dark:text-white font-bold truncate">02. Synchronize Verified Resume</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">Upload latest PDF for AI parsing</div>
                            </div>
                        </div>

                        <div class="p-2.5 rounded-xl bg-white dark:bg-white/[0.03] flex items-start gap-2.5 hover:border-cyan-500/40 transition-colors shadow-2xs dark:shadow-none">
                            <i class="fa-regular fa-circle-dot text-emerald-600 dark:text-emerald-400 mt-0.5 text-xs"></i>
                            <div class="min-w-0 flex-1">
                                <div class="text-slate-900 dark:text-white font-bold truncate">03. Compare 3 Target Pathways</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">Benchmarking salary &amp; toolchains</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Column 3: Instant Action Command Hub --}}
                <div class="lg:col-span-3 p-5 rounded-2xl bg-slate-50/80 dark:bg-white/[0.03] flex flex-col justify-between space-y-3 font-mono">
                    <div class="text-xs text-slate-600 dark:text-slate-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-bolt text-cyan-600 dark:text-cyan-400"></i> Command Hub
                    </div>

                    <div class="space-y-2">
                        <a href="{{ route('quiz.index') }}" class="btn-sweep w-full py-2.5 px-3 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs flex items-center justify-between transition-all shadow-[0_0_20px_rgba(0,242,254,0.3)] hover:scale-102">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-brain"></i> Assessment</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>

                        <a href="{{ route('careers.index') }}" class="w-full py-2.5 px-3 rounded-xl bg-white dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 text-slate-800 dark:text-white font-bold text-xs flex items-center justify-between transition-all hover:border-cyan-500/40 shadow-2xs dark:shadow-none">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-compass text-cyan-600 dark:text-cyan-400"></i> Career Bank</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>

                        <a href="{{ route('resources.index') }}" class="w-full py-2.5 px-3 rounded-xl bg-white dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 text-slate-800 dark:text-white font-bold text-xs flex items-center justify-between transition-all hover:border-cyan-500/40 shadow-2xs dark:shadow-none">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-file-pdf text-cyan-600 dark:text-cyan-400"></i> Toolkits</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ══════════════════ 3. CAREER OPERATING SYSTEM CORE MATRIX ══════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

        {{-- Widget 1: Career Readiness Index --}}
        <div data-aos="fade-up" data-aos-delay="100" class="md:col-span-4 rounded-3xl p-7 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-6 flex flex-col justify-between overflow-hidden hover:-translate-y-1 hover:shadow-2xl hover:border-cyan-500/40 transition-all duration-300">
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-shield-halved text-cyan-600 dark:text-cyan-400"></i> Readiness Index
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/25">Tier 1 Ready</span>
                </div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white font-display">Career Readiness Score</h3>
            </div>

            {{-- Circular Visual Gauge --}}
            <div class="flex items-center justify-center py-2">
                <div class="relative w-36 h-36">
                    <svg class="w-36 h-36 -rotate-90" viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="48" fill="none" stroke="currentColor" class="text-slate-200 dark:text-white/[0.06]" stroke-width="10"/>
                        <circle cx="60" cy="60" r="48" fill="none"
                                stroke="url(#readinessGrad)" stroke-width="10"
                                stroke-linecap="round"
                                stroke-dasharray="301.6"
                                stroke-dashoffset="42.2"
                                style="transition: stroke-dashoffset 1.2s cubic-bezier(0.4,0,0.2,1)"/>
                        <defs>
                            <linearGradient id="readinessGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#00f2fe"/>
                                <stop offset="50%" stop-color="#38bdf8"/>
                                <stop offset="100%" stop-color="#2563eb"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-display leading-none">86</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono mt-0.5">/ 100 PTS</span>
                    </div>
                </div>
            </div>

            {{-- Readiness Breakdown --}}
            <div class="space-y-2 pt-2 border-t border-slate-200/80 dark:border-white/[0.05]">
                <div class="flex justify-between text-xs text-slate-600 dark:text-slate-400 font-medium">
                    <span>Quiz Verification</span>
                    <span class="text-cyan-600 dark:text-cyan-400 font-bold font-mono">92%</span>
                </div>
                <div class="flex justify-between text-xs text-slate-600 dark:text-slate-400 font-medium">
                    <span>Skill Alignment</span>
                    <span class="text-sky-600 dark:text-sky-400 font-bold font-mono">84%</span>
                </div>
                <div class="flex justify-between text-xs text-slate-600 dark:text-slate-400 font-medium">
                    <span>Portfolio Blueprint</span>
                    <span class="text-blue-600 dark:text-blue-400 font-bold font-mono">82%</span>
                </div>
            </div>
        </div>

        {{-- Widget 2: Active Career Direction --}}
        <div data-aos="fade-up" data-aos-delay="200" class="md:col-span-4 rounded-3xl p-7 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-6 flex flex-col justify-between overflow-hidden hover:-translate-y-1 hover:shadow-2xl hover:border-cyan-500/40 transition-all duration-300">
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-compass text-cyan-600 dark:text-cyan-400"></i> Target Pathway
                    </span>
                    <span class="text-xs text-emerald-600 dark:text-emerald-400 font-black font-mono">$120k/yr</span>
                </div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white font-display">Active Direction</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    {{ $rolePersonalization['recommended_domain'] ?? 'Software Engineering & Cloud Architecture' }}
                </p>
            </div>

            <div class="space-y-3.5 p-4 rounded-2xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/[0.05] shadow-inner">
                <div class="flex items-center justify-between text-xs font-medium">
                    <span class="text-slate-600 dark:text-slate-400">Market Demand Index</span>
                    <span class="text-cyan-600 dark:text-cyan-400 font-bold font-mono">96% High</span>
                </div>
                <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-cyan-400 to-sky-500 w-[96%]"></div>
                </div>
                <div class="flex items-center justify-between text-xs font-medium">
                    <span class="text-slate-600 dark:text-slate-400">5-Year Growth Rate</span>
                    <span class="text-sky-600 dark:text-sky-400 font-bold font-mono">+28% YoY</span>
                </div>
                <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-sky-400 to-blue-600 w-[88%]"></div>
                </div>
            </div>

            <a href="{{ route('careers.index') }}" class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-center text-cyan-700 dark:text-cyan-300 bg-cyan-500/10 dark:bg-cyan-500/15 border border-cyan-500/25 hover:bg-cyan-500/20 transition-all flex items-center justify-center gap-2">
                <span>Explore Track Details</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        {{-- Widget 3: Skill Development Progress --}}
        <div data-aos="fade-up" data-aos-delay="300" class="md:col-span-4 rounded-3xl p-7 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-6 flex flex-col justify-between overflow-hidden hover:-translate-y-1 hover:shadow-2xl hover:border-cyan-500/40 transition-all duration-300">
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-code text-cyan-600 dark:text-cyan-400"></i> Competency Matrix
                    </span>
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-mono">4 Tracks</span>
                </div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white font-display">Skill Development</h3>
            </div>

            <div class="space-y-3">
                <div class="space-y-1">
                    <div class="flex justify-between text-[11px] text-slate-700 dark:text-slate-300 font-medium">
                        <span>Backend API Architecture</span>
                        <span class="text-cyan-600 dark:text-cyan-400 font-bold font-mono">90%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-cyan-400 to-sky-500 w-[90%]"></div>
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between text-[11px] text-slate-700 dark:text-slate-300 font-medium">
                        <span>Cloud &amp; DevOps Pipelines</span>
                        <span class="text-sky-600 dark:text-sky-400 font-bold font-mono">75%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-sky-400 to-blue-600 w-[75%]"></div>
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between text-[11px] text-slate-700 dark:text-slate-300 font-medium">
                        <span>Frontend UI &amp; Design Systems</span>
                        <span class="text-cyan-600 dark:text-cyan-400 font-bold font-mono">85%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-cyan-400 to-blue-600 w-[85%]"></div>
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between text-[11px] text-slate-700 dark:text-slate-300 font-medium">
                        <span>Database Design &amp; Optimizations</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold font-mono">70%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-500 to-cyan-500 w-[70%]"></div>
                    </div>
                </div>
            </div>

            <a href="{{ route('resources.index') }}" class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-center text-cyan-700 dark:text-cyan-300 bg-cyan-500/10 dark:bg-cyan-500/15 border border-cyan-500/25 hover:bg-cyan-500/20 transition-all flex items-center justify-center gap-2">
                <span>Access Skill Toolkits</span>
                <i class="fa-solid fa-download text-[10px]"></i>
            </a>
        </div>

    </div>

    {{-- ══════════════════ 3.5 DYNAMIC SYSTEM INTELLIGENCE & RECOMMENDATION ENGINES ══════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        {{-- Section A: Recently Viewed Careers --}}
        <div data-aos="fade-up" data-aos-delay="100" class="lg:col-span-6 rounded-3xl p-7 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl flex flex-col justify-between space-y-6">
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-sky-600 dark:text-sky-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-clock-rotate-left"></i> System Intelligence
                    </span>
                    <span class="text-[11px] text-slate-500 dark:text-slate-400 font-mono">Session &amp; DB Sync</span>
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Recently Viewed Careers</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400">Quickly resume exploration of your recently browsed career profiles.</p>
            </div>

            @if(isset($recentlyViewedCareers) && $recentlyViewedCareers->isNotEmpty())
                <div class="space-y-3">
                    @foreach($recentlyViewedCareers->take(3) as $rCareer)
                        <a href="{{ route('careers.show', $rCareer->id) }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 hover:border-sky-500/40 hover:bg-sky-50/50 dark:hover:bg-sky-950/20 transition-all group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl bg-sky-500/10 dark:bg-sky-500/20 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-compass"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors font-display">{{ $rCareer->title }}</h4>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono">{{ $rCareer->domain }}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-3">
                                <div class="text-xs font-black text-emerald-600 dark:text-emerald-400 font-mono">{{ $rCareer->expected_salary }}</div>
                                <div class="text-[9px] text-slate-400 flex items-center justify-end gap-1">
                                    <span>View</span>
                                    <i class="fa-solid fa-arrow-right text-[8px] group-hover:translate-x-0.5 transition-transform"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/40 border border-dashed border-slate-300 dark:border-white/10 text-center space-y-2">
                    <i class="fa-regular fa-compass text-2xl text-slate-400"></i>
                    <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">No careers viewed in this session yet.</p>
                    <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-sky-600 dark:text-sky-400 hover:underline">
                        <span>Browse Career Bank</span> &rarr;
                    </a>
                </div>
            @endif

            <div class="pt-2 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between text-xs">
                <a href="{{ route('careers.index') }}" class="text-sky-600 dark:text-sky-400 font-bold hover:underline inline-flex items-center gap-1.5">
                    <span>Explore All Roles</span>
                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>
        </div>

        {{-- Section B: "Because you liked X..." Suggestion Engine --}}
        <div data-aos="fade-up" data-aos-delay="200" class="lg:col-span-6 rounded-3xl p-7 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl flex flex-col justify-between space-y-6">
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-sky-600 dark:text-sky-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-clock-rotate-left"></i> System Intelligence
                    </span>
                    <span class="text-[11px] text-slate-500 dark:text-slate-400 font-mono">Session &amp; DB Sync</span>
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Recently Viewed Careers</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400">Quickly resume exploration of your recently browsed career profiles.</p>
            </div>

            @if(isset($recentlyViewedCareers) && $recentlyViewedCareers->isNotEmpty())
                <div class="space-y-3">
                    @foreach($recentlyViewedCareers->take(3) as $rCareer)
                        <a href="{{ route('careers.show', $rCareer->id) }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 hover:border-sky-500/40 hover:bg-sky-50/50 dark:hover:bg-sky-950/20 transition-all group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl bg-sky-500/10 dark:bg-sky-500/20 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-compass"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors font-display">{{ $rCareer->title }}</h4>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono">{{ $rCareer->domain }}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-3">
                                <div class="text-xs font-black text-emerald-600 dark:text-emerald-400 font-mono">{{ $rCareer->expected_salary }}</div>
                                <div class="text-[9px] text-slate-400 flex items-center justify-end gap-1">
                                    <span>View</span>
                                    <i class="fa-solid fa-arrow-right text-[8px] group-hover:translate-x-0.5 transition-transform"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/40 border border-dashed border-slate-300 dark:border-white/10 text-center space-y-2">
                    <i class="fa-regular fa-compass text-2xl text-slate-400"></i>
                    <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">No careers viewed in this session yet.</p>
                    <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-sky-600 dark:text-sky-400 hover:underline">
                        <span>Browse Career Bank</span> &rarr;
                    </a>
                </div>
            @endif

            <div class="pt-2 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between text-xs">
                <a href="{{ route('careers.index') }}" class="text-sky-600 dark:text-sky-400 font-bold hover:underline inline-flex items-center gap-1.5">
                    <span>Explore All Roles</span>
                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>
        </div>

        {{-- Section B: "Because you liked X..." Suggestion Engine --}}
        <div class="lg:col-span-6 rounded-3xl p-7 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl flex flex-col justify-between space-y-6">
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-sky-600 dark:text-sky-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-clock-rotate-left"></i> System Intelligence
                    </span>
                    <span class="text-[11px] text-slate-500 dark:text-slate-400 font-mono">Session &amp; DB Sync</span>
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Recently Viewed Careers</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400">Quickly resume exploration of your recently browsed career profiles.</p>
            </div>

            @if(isset($recentlyViewedCareers) && $recentlyViewedCareers->isNotEmpty())
                <div class="space-y-3">
                    @foreach($recentlyViewedCareers->take(3) as $rCareer)
                        <a href="{{ route('careers.show', $rCareer->id) }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 hover:border-sky-500/40 hover:bg-sky-50/50 dark:hover:bg-sky-950/20 transition-all group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl bg-sky-500/10 dark:bg-sky-500/20 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-compass"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors font-display">{{ $rCareer->title }}</h4>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono">{{ $rCareer->domain }}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-3">
                                <div class="text-xs font-black text-emerald-600 dark:text-emerald-400 font-mono">{{ $rCareer->expected_salary }}</div>
                                <div class="text-[9px] text-slate-400 flex items-center justify-end gap-1">
                                    <span>View</span>
                                    <i class="fa-solid fa-arrow-right text-[8px] group-hover:translate-x-0.5 transition-transform"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/40 border border-dashed border-slate-300 dark:border-white/10 text-center space-y-2">
                    <i class="fa-regular fa-compass text-2xl text-slate-400"></i>
                    <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">No careers viewed in this session yet.</p>
                    <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-sky-600 dark:text-sky-400 hover:underline">
                        <span>Browse Career Bank</span> &rarr;
                    </a>
                </div>
            @endif

            <div class="pt-2 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between text-xs">
                <a href="{{ route('careers.index') }}" class="text-sky-600 dark:text-sky-400 font-bold hover:underline inline-flex items-center gap-1.5">
                    <span>Explore All Roles</span>
                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>
        </div>

        {{-- Section B: "Because you liked X..." Suggestion Engine --}}
        <div class="lg:col-span-6 rounded-3xl p-7 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl flex flex-col justify-between space-y-6">
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> AI Recommendation Engine
                    </span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/20">
                        Tag &amp; Skill Synergy
                    </span>
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">
                    Because you liked <span class="grad-text">{{ $anchorCareer ? $anchorCareer->title : 'Engineering' }}</span>
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-400">
                    Algorithmic suggestions matched via domain synergy in <strong>{{ $anchorCareer->domain ?? 'Tech' }}</strong>.
                </p>
            </div>

            @if(isset($suggestedCareers) && $suggestedCareers->isNotEmpty())
                <div class="space-y-3">
                    @foreach($suggestedCareers->take(3) as $sCareer)
                        <a href="{{ route('careers.show', $sCareer->id) }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 hover:border-cyan-500/40 hover:bg-cyan-50/50 dark:hover:bg-cyan-950/20 transition-all group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl bg-cyan-500/10 dark:bg-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-sparkles"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors font-display">{{ $sCareer->title }}</h4>
                                        <span class="px-1.5 py-0.2 rounded text-[8px] font-mono font-bold bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 shrink-0">94% Fit</span>
                                    </div>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono">{{ $sCareer->domain }}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-3">
                                <div class="text-xs font-black text-cyan-600 dark:text-cyan-400 font-mono">{{ $sCareer->expected_salary }}</div>
                                <div class="text-[9px] text-slate-400 flex items-center justify-end gap-1">
                                    <span>Discover</span>
                                    <i class="fa-solid fa-arrow-right text-[8px] group-hover:translate-x-0.5 transition-transform"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/40 border border-dashed border-slate-300 dark:border-white/10 text-center space-y-2">
                    <i class="fa-solid fa-wand-magic-sparkles text-2xl text-cyan-400"></i>
                    <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">Bookmark or view roles to activate personalized suggestions.</p>
                </div>
            @endif

            <div class="pt-2 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between text-xs">
                <a href="{{ route('quiz.index') }}" class="text-cyan-600 dark:text-cyan-400 font-bold hover:underline inline-flex items-center gap-1.5">
                    <span>Recalibrate Fit with Quiz</span>
                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- ══════════════════ 4. RECOMMENDED NEXT STEPS ROADMAP ══════════════════ --}}
    <div class="relative rounded-3xl p-8 sm:p-10 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-6 overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-1">
                <div class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider flex items-center gap-1.5 font-mono">
                    <i class="fa-solid fa-list-check"></i> Action Plan
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Recommended Next Steps</h3>
            </div>
            <span class="text-xs text-slate-500 dark:text-slate-400 font-mono">Personalized for {{ $user->name }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Step 1 --}}
            <div class="p-5 rounded-2xl bg-white/90 dark:bg-slate-950/50 border border-slate-200 dark:border-white/5 shadow-xl dark:shadow-sm space-y-3 hover:border-cyan-500/30 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-xs font-black">01</div>
                    <span class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1"><i class="fa-solid fa-clock text-[9px]"></i> 5 Mins</span>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors font-display">Complete Interest Assessment</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">Map your instincts and cognitive strengths against verified roles.</p>
                </div>
                <a href="{{ route('quiz.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors pt-1">
                    <span>Take Quiz</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>

            {{-- Step 2 --}}
            <div class="p-5 rounded-2xl bg-white/90 dark:bg-slate-950/50 border border-slate-200 dark:border-white/5 shadow-xl dark:shadow-sm space-y-3 hover:border-sky-500/30 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-sky-500/20 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs font-black">02</div>
                    <span class="text-[10px] font-semibold text-sky-600 dark:text-sky-400 flex items-center gap-1"><i class="fa-solid fa-clock text-[9px]"></i> 15 Mins</span>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-300 transition-colors font-display">Download Tech Toolkits</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">Acquire curated cheat sheets and architecture patterns.</p>
                </div>
                <a href="{{ route('resources.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 transition-colors pt-1">
                    <span>Explore Blueprints</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>

            {{-- Step 3 --}}
            <div class="p-5 rounded-2xl bg-white/90 dark:bg-slate-950/50 border border-slate-200 dark:border-white/5 shadow-xl dark:shadow-sm space-y-3 hover:border-blue-500/30 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs font-black">03</div>
                    <span class="text-[10px] font-semibold text-blue-600 dark:text-blue-400 flex items-center gap-1"><i class="fa-solid fa-clock text-[9px]"></i> 30 Mins</span>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-300 transition-colors font-display">Stream Masterclass</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">Watch HD technical breakdowns and engineering insights.</p>
                </div>
                <a href="{{ route('multimedia.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors pt-1">
                    <span>Watch Media</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- ══════════════════ 4.5 QUIZ ASSESSMENT HISTORY & EXPLAINABLE CAREER FIT ══════════════════ --}}
    <div class="relative rounded-3xl p-8 sm:p-10 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 space-y-8 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200/80 dark:border-white/[0.08]">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-cyan-600 dark:text-cyan-400 font-mono">
                    <i class="fa-solid fa-brain text-cyan-500"></i>
                    <span>Evaluation Records &amp; Career Recommendations</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">
                    Interest Assessment <span class="grad-text">History</span>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-xl">
                    Persistent, versioned cognitive assessment records and deterministic explainable career recommendations.
                </p>
            </div>
            <a href="{{ route('quiz.index') }}" class="btn-sweep px-5 py-2.5 rounded-full font-black text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-md transition-all shrink-0 flex items-center gap-2">
                <i class="fa-solid fa-rotate-left text-[11px] text-slate-950"></i>
                <span>Take New Assessment</span>
            </a>
        </div>

        @if($quizAttempts->isEmpty())
            <div class="p-8 sm:p-12 text-center space-y-4 rounded-2xl bg-slate-100/60 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/5">
                <div class="w-14 h-14 rounded-2xl bg-cyan-500/15 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-2xl mx-auto shadow-sm">
                    <i class="fa-solid fa-clipboard-question"></i>
                </div>
                <div class="space-y-1 max-w-md mx-auto">
                    <h4 class="text-base font-black text-slate-900 dark:text-white font-display">No Assessment History Found</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        Take the 2026 Career Alignment Quiz to uncover your top technology affinity domain, recommended career tracks, and personalized milestones.
                    </p>
                </div>
                <a href="{{ route('quiz.index') }}" class="btn-sweep inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-black text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 hover:scale-105 transition-all shadow-md">
                    <i class="fa-solid fa-play text-[10px] text-slate-950"></i>
                    <span>Start Career Assessment</span>
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($quizAttempts as $attempt)
                    <div class="p-6 sm:p-7 rounded-3xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/10 space-y-6 shadow-md hover:border-cyan-500/40 transition-all">
                        {{-- Attempt Header --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200/80 dark:border-white/5">
                            <div class="flex flex-wrap items-center gap-2.5">
                                <span class="px-3 py-1 rounded-full text-xs font-black bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25 font-mono">
                                    <i class="fa-solid fa-bullseye text-[10px] mr-1"></i>{{ $attempt->top_domain }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold text-slate-600 dark:text-slate-400 bg-slate-200/70 dark:bg-white/5 font-mono">
                                    Version {{ $attempt->quiz_version }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold text-emerald-700 dark:text-emerald-300 bg-emerald-500/10 border border-emerald-500/20 font-mono">
                                    {{ $attempt->total_score }} Pts
                                </span>
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 font-mono flex items-center gap-1.5">
                                <i class="fa-regular fa-calendar text-[11px]"></i>
                                <span>{{ $attempt->completed_at ? $attempt->completed_at->format('M d, Y · h:i A') : $attempt->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>

                        {{-- Domain Scores Progress Mini Bars --}}
                        @if(!empty($attempt->domain_scores))
                            <div class="space-y-2">
                                <div class="text-[10px] font-black uppercase tracking-wider text-slate-500 font-mono">Domain Affinity Scores</div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                    @foreach($attempt->domain_scores as $domain => $scorePct)
                                        <div class="p-2.5 rounded-xl bg-white/80 dark:bg-white/[0.03] border border-slate-200/80 dark:border-white/5 space-y-1">
                                            <div class="flex justify-between text-[11px] font-bold">
                                                <span class="text-slate-700 dark:text-slate-300 truncate text-[10px]">{{ $domain }}</span>
                                                <span class="font-mono text-cyan-600 dark:text-cyan-400 text-[10px]">{{ $scorePct }}%</span>
                                            </div>
                                            <div class="w-full h-1.5 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full" style="width: {{ $scorePct }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Top Recommended Careers with Explainability --}}
                        @if(!empty($attempt->recommended_careers))
                            <div class="space-y-2.5">
                                <div class="text-[10px] font-black uppercase tracking-wider text-slate-500 font-mono">Recommended Careers &amp; Explainability Factors</div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($attempt->recommended_careers as $rec)
                                        <div class="p-4 rounded-2xl bg-white/90 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/5 flex flex-col justify-between space-y-3">
                                            <div class="space-y-1.5">
                                                <div class="flex items-center justify-between gap-2">
                                                    <h5 class="text-sm font-black text-slate-900 dark:text-white font-display">{{ $rec['title'] }}</h5>
                                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-black bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25 font-mono shrink-0">
                                                        {{ $rec['match_percentage'] ?? 90 }}% Match
                                                    </span>
                                                </div>
                                                <div class="text-[11px] font-mono text-emerald-600 dark:text-emerald-400 font-bold">
                                                    {{ $rec['expected_salary'] ?? 'Tech Benchmark' }}
                                                </div>
                                                @if(!empty($rec['reason']))
                                                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed bg-slate-50 dark:bg-white/[0.02] p-2.5 rounded-xl border border-slate-200/60 dark:border-white/5">
                                                        <strong class="text-cyan-600 dark:text-cyan-400 font-semibold"><i class="fa-solid fa-sparkles text-[9px] mr-1"></i>Match Factor:</strong> {{ $rec['reason'] }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="pt-2 border-t border-slate-200/60 dark:border-white/5 flex justify-end">
                                                <a href="{{ route('careers.show', $rec['career_id'] ?? $rec['id']) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors">
                                                    <span>View Career Track</span>
                                                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Card Footer Link --}}
                        <div class="flex items-center justify-between pt-2">
                            <span class="text-xs text-slate-500 dark:text-slate-400 font-mono">
                                {{ $attempt->answers->count() }} question answers persisted
                            </span>
                            <a href="{{ route('quiz.results', $attempt->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:underline">
                                <span>View Full Assessment Audit</span>
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- ══════════════════ 5. INTERACTIVE CAREER PATH BUILDER ══════════════════ --}}
    <div class="relative rounded-3xl p-8 sm:p-10 bg-white dark:bg-[#080B12] border border-slate-200/80 dark:border-cyan-500/25 space-y-8 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden" id="pathBuilderSection">
        
        {{-- Section Header --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-200/80 dark:border-white/[0.08]">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/15 border border-cyan-500/25 text-xs font-semibold text-cyan-700 dark:text-cyan-300">
                    <i class="fa-solid fa-route text-cyan-600 dark:text-cyan-400"></i>
                    <span>Interactive Career Path Builder</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">
                    Your Personalized <span class="grad-text">Roadmap Generator</span>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed">
                    Interactive milestone progression engine. Complete foundational nodes, master core competencies, deploy production projects, and land target roles.
                </p>
            </div>

            {{-- Pathway Overall Telemetry Box --}}
            <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-100/80 dark:bg-white/[0.03] border border-slate-200/80 dark:border-white/[0.08] shrink-0">
                <div class="space-y-1">
                    <div class="text-[10px] uppercase font-bold text-slate-500 dark:text-slate-400 tracking-wider">Pathway Progress</div>
                    <div class="text-2xl font-black text-emerald-600 dark:text-emerald-400 font-display" id="pathwayProgressText">75% Complete</div>
                    <div class="w-36 h-2 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                        <div id="pathwayProgressBar" class="h-full rounded-full bg-gradient-to-r from-emerald-500 via-cyan-500 to-blue-600" style="width: 75%; transition: width 0.6s cubic-bezier(0.4,0,0.2,1);"></div>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/25 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-lg shrink-0">
                    <i class="fa-solid fa-trophy"></i>
                </div>
            </div>
        </div>

        {{-- Interactive Track Selector --}}
        <div class="flex flex-wrap gap-2" id="builderTrackPills">
            <button type="button" onclick="switchBuilderTrack('fullstack', this)" class="builder-track-pill active px-4 py-2 text-xs font-bold rounded-xl border border-cyan-500/50 text-cyan-700 dark:text-cyan-300 bg-cyan-500/15 dark:bg-cyan-500/20 transition-all flex items-center gap-2">
                <i class="fa-solid fa-code text-xs text-cyan-500"></i> Full-Stack Architect
            </button>
            <button type="button" onclick="switchBuilderTrack('cloud', this)" class="builder-track-pill px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-cloud text-xs text-sky-500"></i> Cloud &amp; DevOps Lead
            </button>
            <button type="button" onclick="switchBuilderTrack('ai', this)" class="builder-track-pill px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-brain text-xs text-cyan-500"></i> AI &amp; Machine Learning
            </button>
            <button type="button" onclick="switchBuilderTrack('security', this)" class="builder-track-pill px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-shield-halved text-xs text-emerald-500"></i> Cybersecurity Architect
            </button>
        </div>

        {{-- 4-Stage Timeline Flow --}}
        <div class="relative">
            {{-- Glowing Glassmorphic Horizontal Connector (Desktop) --}}
            <div class="hidden lg:block absolute top-[52px] left-12 right-12 h-1 bg-gradient-to-r from-emerald-500 via-cyan-500 to-blue-600/40 rounded-full z-0 pointer-events-none"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10" id="builderNodesContainer">
                
                {{-- Node 01: Foundation --}}
                <div class="relative z-10 p-6 rounded-3xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border border-emerald-500/30 shadow-lg space-y-4 flex flex-col justify-between group hover:border-emerald-500/60 transition-all w-full min-w-0">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-lg shadow-lg shadow-emerald-500/10">
                                <i class="fa-solid fa-seedling"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/30 flex items-center gap-1">
                                <i class="fa-solid fa-check text-[8px]"></i> Completed
                            </span>
                        </div>
                        <div>
                            <div class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400 font-bold">STAGE 01</div>
                            <h4 class="text-base font-black text-slate-900 dark:text-white font-display">Foundation</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">Computer science basics, Git workflows &amp; data structures.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 pt-3 border-t border-slate-200/80 dark:border-white/[0.06]">
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-emerald-500">
                            <span>Data Structures &amp; Algorithms</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-emerald-500">
                            <span>Git &amp; Version Control</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-emerald-500">
                            <span>Linux CLI &amp; Shell Scripting</span>
                        </label>
                    </div>
                </div>

                {{-- Node 02: Core Skills --}}
                <div class="relative z-10 p-6 rounded-3xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border border-emerald-500/30 shadow-lg space-y-4 flex flex-col justify-between group hover:border-emerald-500/60 transition-all w-full min-w-0">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-lg shadow-lg shadow-emerald-500/10">
                                <i class="fa-solid fa-wrench"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/30 flex items-center gap-1">
                                <i class="fa-solid fa-check text-[8px]"></i> Completed
                            </span>
                        </div>
                        <div>
                            <div class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400 font-bold">STAGE 02</div>
                            <h4 class="text-base font-black text-slate-900 dark:text-white font-display">Core Skills</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">Target domain frameworks, REST APIs &amp; database design.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 pt-3 border-t border-slate-200/80 dark:border-white/[0.06]">
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-emerald-500">
                            <span>Framework Mastery (Laravel/React)</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-emerald-500">
                            <span>RESTful APIs &amp; Auth Tokens</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-emerald-500">
                            <span>MySQL &amp; Index Optimization</span>
                        </label>
                    </div>
                </div>

                {{-- Node 03: Projects --}}
                <div class="relative z-10 p-6 rounded-3xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border border-indigo-500/40 shadow-lg space-y-4 flex flex-col justify-between group hover:border-indigo-500/70 transition-all w-full min-w-0">
                    <div class="absolute -top-2.5 right-6 px-2.5 py-0.5 rounded-full text-[9px] font-black bg-indigo-500 text-white uppercase tracking-wider shadow-md">Active</div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 border border-indigo-500/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-lg shadow-lg shadow-indigo-500/20">
                                <i class="fa-solid fa-diagram-project"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-500/15 text-indigo-700 dark:text-indigo-300 border border-indigo-500/40 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 dark:bg-indigo-400 animate-pulse"></span>
                                <span>In Progress</span>
                            </span>
                        </div>
                        <div>
                            <div class="text-[10px] font-mono text-indigo-600 dark:text-indigo-400 font-bold">STAGE 03</div>
                            <h4 class="text-base font-black text-slate-900 dark:text-white font-display">Production Projects</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">Full-stack deployments, containerization &amp; microservices.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 pt-3 border-t border-slate-200/80 dark:border-white/[0.06]">
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" checked onchange="recalcPathwayProgress()" class="builder-check rounded accent-indigo-500">
                            <span>Deploy Containerized Web App</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" onchange="recalcPathwayProgress()" class="builder-check rounded accent-indigo-500">
                            <span>CI/CD Automated Deployment</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                            <input type="checkbox" onchange="recalcPathwayProgress()" class="builder-check rounded accent-indigo-500">
                            <span>Multi-Tier Architecture Demo</span>
                        </label>
                    </div>
                </div>

                {{-- Node 04: Target Career --}}
                <div class="relative z-10 p-6 rounded-3xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border border-slate-200/80 dark:border-white/[0.08] shadow-lg space-y-4 flex flex-col justify-between group hover:border-cyan-500/40 transition-all w-full min-w-0">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 dark:bg-white/[0.04] border border-cyan-500/20 dark:border-white/[0.08] flex items-center justify-center text-cyan-600 dark:text-cyan-400 text-lg">
                                <i class="fa-solid fa-rocket"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-white/10 flex items-center gap-1">
                                <i class="fa-solid fa-hourglass-half text-[8px]"></i> Upcoming
                            </span>
                        </div>
                        <div>
                            <div class="text-[10px] font-mono text-cyan-600 dark:text-cyan-400 font-bold">STAGE 04</div>
                            <h4 class="text-base font-black text-slate-900 dark:text-white font-display">Target Career</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">System design review, portfolio defense &amp; senior landing.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 pt-3 border-t border-slate-200/80 dark:border-white/[0.06]">
                        <label class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                            <input type="checkbox" onchange="recalcPathwayProgress()" class="builder-check rounded accent-cyan-500">
                            <span>System Design Mock Interview</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                            <input type="checkbox" onchange="recalcPathwayProgress()" class="builder-check rounded accent-cyan-500">
                            <span>Verified Portfolio Audit</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                            <input type="checkbox" onchange="recalcPathwayProgress()" class="builder-check rounded accent-cyan-500">
                            <span>Senior Role Offer Placement</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        {{-- Builder Action Footer --}}
        <div class="pt-4 border-t border-slate-200/80 dark:border-white/[0.08] flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-xs text-slate-600 dark:text-slate-400">
                <i class="fa-solid fa-circle-info text-cyan-600 dark:text-cyan-400"></i>
                <span>Check off completed milestones to recalculate your live Career Readiness Index.</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('resources.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-download text-xs text-cyan-600 dark:text-cyan-400"></i>
                    <span>Download Checklists</span>
                </a>
                <a href="{{ route('careers.index') }}" class="btn-sweep px-5 py-2.5 rounded-full text-xs font-black text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 hover:scale-105 transition-all shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-compass text-xs text-slate-950"></i>
                    <span>View Role Roadmap</span>
                </a>
            </div>
        </div>

    </div>

    {{-- ══════════════════ 6. BENTO STATISTICS SUMMARY ══════════════════ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ $stats['total_careers'] ?? 0 }}</div>
            <div class="text-xs text-slate-600 dark:text-slate-400 font-semibold uppercase tracking-wider font-mono">Active Careers</div>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-sky-500/20 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-play"></i>
            </div>
            <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ $stats['total_multimedia'] ?? 0 }}</div>
            <div class="text-xs text-slate-600 dark:text-slate-400 font-semibold uppercase tracking-wider font-mono">Video Assets</div>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ $stats['total_resources'] ?? 0 }}</div>
            <div class="text-xs text-slate-600 dark:text-slate-400 font-semibold uppercase tracking-wider font-mono">Toolkits</div>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-2 flex flex-col justify-between hover:-translate-y-1 hover:shadow-2xl hover:border-cyan-500/30 transition-all duration-300">
            <div>
                <div class="w-10 h-10 rounded-2xl bg-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-lg mb-2">
                    <i class="fa-solid fa-bookmark"></i>
                </div>
                <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ $stats['total_bookmarks'] ?? 0 }}</div>
                <div class="text-xs text-slate-600 dark:text-slate-400 font-semibold uppercase tracking-wider font-mono">Saved Careers</div>
            </div>
            @if(($stats['total_bookmarks'] ?? 0) === 0)
                <div class="pt-2 border-t border-slate-200/80 dark:border-white/5 text-[11px] text-slate-500 dark:text-slate-400">
                    <span>You haven't saved any careers yet. </span>
                    <a href="{{ route('careers.index') }}" class="text-cyan-600 dark:text-cyan-400 hover:underline font-semibold inline-flex items-center gap-1 mt-0.5">
                        <span>Explore Career Bank &rarr;</span>
                    </a>
                </div>
            @else
                <a href="{{ route('careers.index') }}" class="text-xs text-cyan-600 dark:text-cyan-400 hover:underline font-semibold inline-flex items-center gap-1 pt-1">
                    <span>View Saved &rarr;</span>
                </a>
            @endif
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         AI CAREER MATCH INTELLIGENCE CARD
    ════════════════════════════════════════════════ --}}
    <div class="relative rounded-3xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-white dark:bg-[#080B12] shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-blue-500/10 dark:bg-blue-500/15 blur-3xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-2 relative z-10">

            {{-- Left: Copy + Pills --}}
            <div class="p-8 sm:p-10 space-y-6 flex flex-col justify-center border-b lg:border-b-0 lg:border-r border-slate-200/80 dark:border-white/[0.07]">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/15 border border-indigo-500/20 text-xs font-semibold text-indigo-700 dark:text-indigo-300 shadow-sm">
                        <i class="fa-solid fa-wand-magic-sparkles text-indigo-600 dark:text-indigo-400"></i>
                        <span>AI Career Match Advisor</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display leading-tight">
                        Know your market<br>value <span class="grad-text">before you apply.</span>
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed max-w-xs">
                        Select a tech track for live role alignment, compensation benchmarks, and the exact skills you need.
                    </p>
                </div>

                {{-- Track pills --}}
                <div class="flex flex-wrap gap-2" id="dbAdvisorPills">
                    <button type="button" onclick="selectDbTrack('fullstack', this)" class="db-pill active px-3.5 py-2 text-xs font-semibold rounded-xl border border-cyan-500/50 text-cyan-700 dark:text-cyan-300 bg-cyan-500/15 dark:bg-cyan-500/20 transition-all"><i class="fa-solid fa-code mr-1.5 text-cyan-500"></i>Full-Stack</button>
                    <button type="button" onclick="selectDbTrack('cloud', this)"     class="db-pill px-3.5 py-2 text-xs font-semibold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all"><i class="fa-solid fa-cloud mr-1.5 text-sky-500"></i>Cloud &amp; DevOps</button>
                    <button type="button" onclick="selectDbTrack('ai', this)"        class="db-pill px-3.5 py-2 text-xs font-semibold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all"><i class="fa-solid fa-brain mr-1.5 text-cyan-500"></i>AI &amp; Data</button>
                    <button type="button" onclick="selectDbTrack('security', this)"  class="db-pill px-3.5 py-2 text-xs font-semibold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all"><i class="fa-solid fa-shield-halved mr-1.5 text-emerald-500"></i>Cybersecurity</button>
                    <button type="button" onclick="selectDbTrack('design', this)"    class="db-pill px-3.5 py-2 text-xs font-semibold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all"><i class="fa-solid fa-palette mr-1.5 text-blue-500"></i>UI/UX Design</button>
                </div>

                <a href="{{ route('careers.index') }}" class="self-start group inline-flex items-center gap-1.5 text-sm font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-500 dark:hover:text-cyan-300 transition-colors">
                    <span>Explore all career tracks</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Right: Intelligence Preview Card --}}
            <div class="p-8 sm:p-10 flex flex-col justify-center">
                <div id="dbAdvisorOutput" class="space-y-6" style="transition: opacity 0.18s ease;">

                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[10px] font-semibold text-cyan-600 dark:text-cyan-400 mb-1 tracking-wider uppercase font-mono">Intelligence Preview</p>
                            <h4 id="db-roleTitle" class="text-lg sm:text-xl font-black text-slate-900 dark:text-white font-display leading-tight">Full-Stack Web Architect</h4>
                            <p id="db-salary" class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mt-1 font-mono">$115k – $155k / yr</p>
                        </div>
                        <span id="db-matchScore" class="shrink-0 px-3 py-1.5 text-xs font-bold rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border border-emerald-500/30 mt-1 whitespace-nowrap shadow-sm font-mono">98% Match</span>
                    </div>

                    {{-- Animated Arc Rings --}}
                    <div class="grid grid-cols-3 gap-3">
                        {{-- Career Fit --}}
                        <div class="flex flex-col items-center gap-1.5">
                            <div class="relative w-18 h-18" style="width:72px;height:72px">
                                <svg width="72" height="72" viewBox="0 0 72 72" class="-rotate-90">
                                    <circle cx="36" cy="36" r="28" fill="none" stroke="currentColor" class="text-slate-200 dark:text-white/[0.06]" stroke-width="5"/>
                                    <circle id="db-arc-fit" cx="36" cy="36" r="28" fill="none"
                                        stroke="url(#db-grad-fit)" stroke-width="5"
                                        stroke-linecap="round"
                                        stroke-dasharray="176" stroke-dashoffset="176"
                                        style="transition:stroke-dashoffset 1s cubic-bezier(0.4,0,0.2,1)"/>
                                    <defs>
                                        <linearGradient id="db-grad-fit" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#00f2fe"/>
                                            <stop offset="100%" stop-color="#38bdf8"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span id="db-arc-fit-label" class="text-sm font-black text-slate-900 dark:text-white">94%</span>
                                </div>
                            </div>
                            <span class="text-[10px] text-slate-500 dark:text-slate-400 text-center font-medium">Career Fit</span>
                        </div>
                        {{-- Interest Alignment --}}
                        <div class="flex flex-col items-center gap-1.5">
                            <div class="relative" style="width:72px;height:72px">
                                <svg width="72" height="72" viewBox="0 0 72 72" class="-rotate-90">
                                    <circle cx="36" cy="36" r="28" fill="none" stroke="currentColor" class="text-slate-200 dark:text-white/[0.06]" stroke-width="5"/>
                                    <circle id="db-arc-align" cx="36" cy="36" r="28" fill="none"
                                        stroke="url(#db-grad-align)" stroke-width="5"
                                        stroke-linecap="round"
                                        stroke-dasharray="176" stroke-dashoffset="176"
                                        style="transition:stroke-dashoffset 1s cubic-bezier(0.4,0,0.2,1) 0.15s"/>
                                    <defs>
                                        <linearGradient id="db-grad-align" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#38bdf8"/>
                                            <stop offset="100%" stop-color="#2563eb"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span id="db-arc-align-label" class="text-sm font-black text-slate-900 dark:text-white">91%</span>
                                </div>
                            </div>
                            <span class="text-[10px] text-slate-500 dark:text-slate-400 text-center font-medium">Interest Align</span>
                        </div>
                        {{-- Market Demand --}}
                        <div class="flex flex-col items-center gap-1.5">
                            <div class="relative" style="width:72px;height:72px">
                                <svg width="72" height="72" viewBox="0 0 72 72" class="-rotate-90">
                                    <circle cx="36" cy="36" r="28" fill="none" stroke="currentColor" class="text-slate-200 dark:text-white/[0.06]" stroke-width="5"/>
                                    <circle id="db-arc-demand" cx="36" cy="36" r="28" fill="none"
                                        stroke="url(#db-grad-demand)" stroke-width="5"
                                        stroke-linecap="round"
                                        stroke-dasharray="176" stroke-dashoffset="176"
                                        style="transition:stroke-dashoffset 1s cubic-bezier(0.4,0,0.2,1) 0.3s"/>
                                    <defs>
                                        <linearGradient id="db-grad-demand" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#00f2fe"/>
                                            <stop offset="100%" stop-color="#10b981"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span id="db-arc-demand-label" class="text-sm font-black text-slate-900 dark:text-white">96%</span>
                                </div>
                            </div>
                            <span class="text-[10px] text-slate-500 dark:text-slate-400 text-center font-medium">Market Demand</span>
                        </div>
                    </div>

                    {{-- Demand bar --}}
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-[10px] text-slate-600 dark:text-slate-400 font-medium">
                            <span>Market Position</span>
                            <span id="db-demand" class="text-cyan-600 dark:text-cyan-400 font-semibold">High (96%)</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-slate-200 dark:bg-white/[0.06] overflow-hidden">
                            <div id="db-bar-demand" class="h-full bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full" style="width:0%;transition:width 1s cubic-bezier(0.4,0,0.2,1) 0.2s"></div>
                        </div>
                    </div>

                    {{-- Core Skills pills --}}
                    <div class="space-y-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wider font-mono">Core Required Skills</p>
                        <div id="db-skills" class="flex flex-wrap gap-1.5"></div>
                    </div>

                    {{-- Major + toolchain --}}
                    <div class="pt-2 border-t border-slate-200/80 dark:border-white/[0.07] flex items-center justify-between gap-3">
                        <div>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 mb-0.5 font-medium">Recommended Major</p>
                            <p id="db-major" class="text-xs font-semibold text-cyan-600 dark:text-cyan-400">CS / Software Eng.</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 mb-0.5 font-medium">Toolchain</p>
                            <p id="db-toolchain" class="text-[11px] text-slate-600 dark:text-slate-400 max-w-[160px] text-right leading-relaxed">Laravel, Vue/React, Tailwind</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════
         7. SAVED BOOKMARKS & STICKY NOTES WITH PDF EXPORT & SOCIAL SHARE
    ══════════════════════════════════════════════════════════════════ --}}
    <div class="space-y-6" x-data="{
        copiedBmId: null,
        copyShareUrl(url, id) {
            navigator.clipboard.writeText(url).then(() => {
                this.copiedBmId = id;
                setTimeout(() => { this.copiedBmId = null; }, 2500);
            });
        },
        exportSinglePdf(elementId, title) {
            const element = document.getElementById(elementId);
            if (!element) return;
            const opt = {
                margin: 10,
                filename: 'PathSeeker-' + title.toLowerCase().replace(/[^a-z0-9]/g, '-') + '-Notes.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    }">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="text-xs font-bold text-amber-600 dark:text-amber-400 flex items-center gap-1.5 font-mono uppercase tracking-wider">
                    <i class="fa-solid fa-note-sticky text-amber-500"></i> Candidate Study Space
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white font-display">
                    Saved Bookmarks &amp; <span class="grad-text">Sticky Notes</span>
                </h2>
                <p class="text-xs text-slate-600 dark:text-slate-400">
                    Your bookmarked career tracks, masterclasses, and learning toolkits with private revision notes.
                </p>
            </div>
            
            <div class="flex items-center gap-2.5 flex-wrap">
                @if(count($bookmarks ?? []) > 0)
                    <a href="{{ route('bookmarks.export-all-pdf') }}" target="_blank" class="btn-sweep px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs shadow-md shadow-cyan-500/20 hover:shadow-cyan-500/30 transition-all duration-300 hover:scale-[1.02] flex items-center gap-1.5">
                        <i class="fa-solid fa-file-pdf text-xs text-slate-950"></i>
                        <span class="text-slate-950 font-black">Export All Dossier (PDF)</span>
                    </a>
                @endif
                <a href="{{ route('bookmarks.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 text-xs font-bold text-slate-700 dark:text-slate-300 transition-all flex items-center gap-1">
                    <span>Manage All ({{ count($bookmarks ?? []) }})</span> &rarr;
                </a>
            </div>
        </div>

        @if(($bookmarks ?? collect())->isEmpty())
            <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 text-center space-y-3 shadow-xl">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl mx-auto">
                    <i class="fa-solid fa-note-sticky"></i>
                </div>
                <div class="space-y-1 max-w-sm mx-auto">
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white font-display">No Bookmarks Saved Yet</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Explore career tracks or toolkits, click the bookmark icon to save items, and attach private sticky notes.
                    </p>
                </div>
                <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow transition-all">
                    <i class="fa-solid fa-compass text-[10px]"></i>
                    <span>Browse Careers</span>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(($bookmarks ?? [])->take(6) as $bm)
                    @php 
                        $item = $bm->item;
                        $itemTitle = $item->title ?? 'Saved Resource';
                        $shareUrl = match($bm->item_type) {
                            'career' => $item ? route('careers.show', $item->id) : url('/careers'),
                            'multimedia' => $item ? route('multimedia.show', $item->id) : url('/multimedia'),
                            'resource' => $item ? route('resources.show', $item->id) : url('/resources'),
                            default => url('/'),
                        };
                    @endphp
                    <div id="db-bm-{{ $bm->id }}" x-data="{ 
                        editingNote: false, 
                        showShare: false,
                        noteContent: '{{ addslashes($bm->notes ?? '') }}',
                        saving: false,
                        saveNote() {
                            this.saving = true;
                            fetch('{{ route('bookmarks.update', $bm->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-HTTP-Method-Override': 'PUT',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ notes: this.noteContent })
                            })
                            .then(r => r.json())
                            .then(data => {
                                this.saving = false;
                                this.editingNote = false;
                            })
                            .catch(() => {
                                this.saving = false;
                            });
                        }
                    }" class="p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-4 flex flex-col justify-between hover:border-amber-500/30 transition-all group">
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25">
                                    {{ ucfirst($bm->item_type) }}
                                </span>
                                
                                <div class="flex items-center gap-1">
                                    {{-- Export PDF --}}
                                    <a href="{{ route('bookmarks.export-pdf', $bm->id) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-slate-100 dark:hover:bg-white/5 transition-all text-xs" title="Export as PDF">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>

                                    {{-- Social Share Button & Dropdown --}}
                                    <div class="relative">
                                        <button @click="showShare = !showShare" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-500 hover:bg-slate-100 dark:hover:bg-white/5 transition-all text-xs" title="Share">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </button>
                                        
                                        <div x-show="showShare" @click.outside="showShare = false" x-cloak style="display: none;" class="absolute right-0 top-7 z-30 w-44 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-1.5 space-y-1 text-xs">
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300">
                                                <i class="fa-brands fa-linkedin text-[#0A66C2]"></i>
                                                <span>LinkedIn</span>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?text={{ urlencode('Exploring ' . $itemTitle . ' on PathSeeker!') }}&url={{ urlencode($shareUrl) }}" target="_blank" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300">
                                                <i class="fa-brands fa-x-twitter text-slate-900 dark:text-white"></i>
                                                <span>Twitter / X</span>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?text={{ urlencode('PathSeeker Career: ' . $itemTitle . ' - ' . $shareUrl) }}" target="_blank" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300">
                                                <i class="fa-brands fa-whatsapp text-[#25D366]"></i>
                                                <span>WhatsApp</span>
                                            </a>
                                            <a href="mailto:?subject={{ urlencode('PathSeeker Track: ' . $itemTitle) }}&body={{ urlencode('Check this out: ' . $shareUrl) }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300">
                                                <i class="fa-regular fa-envelope text-cyan-500"></i>
                                                <span>Email</span>
                                            </a>
                                            <button @click="copyShareUrl('{{ $shareUrl }}', {{ $bm->id }})" class="w-full flex items-center gap-2 px-2.5 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 text-left">
                                                <i class="fa-solid fa-link text-amber-500"></i>
                                                <span x-text="copiedBmId === {{ $bm->id }} ? 'Copied!' : 'Copy Link'"></span>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Delete Bookmark --}}
                                    <form action="{{ route('bookmarks.destroy', $bm->id) }}" method="POST" onsubmit="return confirm('Remove this bookmark?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-500/10 transition-all text-xs" title="Remove">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm font-display line-clamp-1">
                                    {{ $itemTitle }}
                                </h4>
                                @if($item && isset($item->expected_salary))
                                    <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-mono font-semibold mt-0.5">{{ $item->expected_salary }}</p>
                                @endif
                            </div>

                            {{-- Sticky Note Box --}}
                            <div class="p-3.5 rounded-2xl bg-amber-50/90 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-500/25 space-y-1.5">
                                <div class="flex items-center justify-between pb-1 border-b border-amber-200/80 dark:border-amber-500/20">
                                    <div class="flex items-center gap-1.5 text-[9px] font-mono font-black uppercase text-amber-900 dark:text-amber-300">
                                        <i class="fa-solid fa-note-sticky text-amber-600 dark:text-amber-400 text-[10px]"></i>
                                        <span>Sticky Note</span>
                                    </div>
                                    <button type="button" @click="editingNote = !editingNote" class="text-[9px] font-bold text-amber-700 dark:text-amber-300 hover:underline flex items-center gap-1">
                                        <i class="fa-solid fa-pencil text-[8px]"></i>
                                        <span x-text="editingNote ? 'Cancel' : (noteContent ? 'Edit' : 'Add Note')"></span>
                                    </button>
                                </div>

                                <div x-show="!editingNote" class="text-[11px] text-amber-950 dark:text-amber-100 leading-relaxed whitespace-pre-line line-clamp-3 min-h-[28px]">
                                    <span x-show="noteContent" x-text="noteContent"></span>
                                    <span x-show="!noteContent" class="italic text-amber-600/70 dark:text-amber-400/60 text-[10px]">
                                        Click "Add Note" to write personal revision checkpoints.
                                    </span>
                                </div>

                                <div x-show="editingNote" x-cloak style="display: none;" class="space-y-1.5 pt-1">
                                    <textarea x-model="noteContent" rows="2" placeholder="Write private revision takeaways..." class="w-full px-2.5 py-1.5 text-[11px] rounded-xl bg-white dark:bg-slate-900 border border-amber-300 dark:border-amber-500/40 text-slate-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-amber-500"></textarea>
                                    <div class="flex justify-end gap-1.5">
                                        <button type="button" @click="editingNote = false" class="px-2 py-0.5 text-[9px] font-bold text-slate-500">Cancel</button>
                                        <button type="button" @click="saveNote()" :disabled="saving" class="px-2.5 py-0.5 rounded-lg text-[9px] font-bold text-white bg-amber-600 hover:bg-amber-500 shadow-xs flex items-center gap-1">
                                            <i x-show="saving" class="fa-solid fa-spinner fa-spin text-[8px]"></i>
                                            <span x-text="saving ? 'Saving...' : 'Save Note'"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Actions --}}
                        <div class="pt-3 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between gap-2">
                            <button type="button" @click="exportSinglePdf('db-bm-{{ $bm->id }}', '{{ addslashes($itemTitle) }}')" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-cyan-500/15 hover:text-cyan-600 dark:hover:text-cyan-400 text-[10px] font-bold text-slate-700 dark:text-slate-300 transition-all flex items-center gap-1">
                                <i class="fa-solid fa-download text-[9px] text-cyan-500"></i>
                                <span>PDF</span>
                            </button>

                            @if($item)
                                @if($bm->item_type === 'career')
                                    <a href="{{ route('careers.show', $item->id) }}" class="text-[11px] font-bold text-cyan-600 dark:text-cyan-400 hover:underline flex items-center gap-1">
                                        <span>View Track</span> <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                    </a>
                                @elseif($bm->item_type === 'multimedia')
                                    <a href="{{ route('multimedia.show', $item->id) }}" class="text-[11px] font-bold text-cyan-600 dark:text-cyan-400 hover:underline flex items-center gap-1">
                                        <span>Watch</span> <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                    </a>
                                @elseif($bm->item_type === 'resource')
                                    <a href="{{ route('resources.show', $item->id) }}" class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                                        <span>Open</span> <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                    </a>
                                @endif
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Success Stories / Alumni Network --}}
    <div class="space-y-6">
        <div class="space-y-1">
            <div class="text-xs font-bold text-cyan-600 dark:text-cyan-400 flex items-center gap-1.5 font-mono uppercase tracking-wider">
                <i class="fa-solid fa-trophy"></i> Success Trajectories
            </div>
            <h2 class="text-2xl font-black text-slate-900 dark:text-white font-display">Alumni &amp; Community Breakthroughs</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($stories as $story)
                <div class="card-tilt rounded-3xl p-6 sm:p-7 flex flex-col justify-between bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] hover:border-cyan-500/30 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-semibold px-2.5 py-1 rounded-full bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25 shadow-sm font-mono">
                                {{ $story->domain }}
                            </span>
                            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                                <i class="fa-solid fa-circle-check text-[9px]"></i> Verified Trajectory
                            </span>
                        </div>
                        <h3 class="text-base font-black text-slate-900 dark:text-white font-display">{{ $story->title }}</h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $story->story_text }}</p>
                    </div>
                    <div class="pt-3 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between text-[11px] text-slate-500 font-medium">
                        <span>PathSeeker Alumni Network</span>
                        <i class="fa-solid fa-award text-cyan-500 text-xs"></i>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 text-slate-500 text-xs shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] space-y-2">
                    <i class="fa-solid fa-graduation-cap text-2xl text-cyan-400 block mb-1"></i>
                    <p class="font-bold text-slate-700 dark:text-slate-300 text-sm">No alumni breakthroughs submitted yet.</p>
                    <p class="text-slate-500">Check back soon for verified career transition stories from our community.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Support & Feedback Responses Section --}}
    @if(isset($userFeedbacks) && $userFeedbacks->isNotEmpty())
    <div class="space-y-6">
        <div class="flex items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="text-xs font-bold text-indigo-600 dark:text-indigo-400 flex items-center gap-1.5 font-mono uppercase tracking-wider">
                    <i class="fa-solid fa-comments"></i> Support Inquiries
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white font-display">My Submitted Feedback &amp; Responses</h2>
            </div>
            <a href="{{ route('feedback.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1">
                <span>View Full History</span> &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($userFeedbacks->take(4) as $fb)
                <div class="rounded-3xl p-6 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-4 flex flex-col justify-between hover:border-indigo-500/30 transition-all">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono bg-indigo-500/15 text-indigo-700 dark:text-indigo-300 border border-indigo-500/25">
                                {{ $fb->category }} Ticket
                            </span>
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-mono font-bold
                                {{ $fb->status === 'resolved' ? 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25' : ($fb->status === 'in_review' ? 'bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/25' : 'bg-sky-500/15 text-sky-700 dark:text-sky-400 border border-sky-500/25') }}">
                                {{ ucfirst(str_replace('_', ' ', $fb->status)) }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-700 dark:text-slate-300 line-clamp-2 leading-relaxed font-medium">
                            "{{ $fb->message }}"
                        </p>
                        @if($fb->admin_response)
                            <div class="p-3.5 rounded-2xl bg-emerald-500/[0.08] dark:bg-emerald-500/10 border border-emerald-500/20 text-xs space-y-1">
                                <div class="flex items-center gap-1.5 text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase font-mono">
                                    <i class="fa-solid fa-headset"></i>
                                    <span>Staff Reply · {{ $fb->responder?->name ?? 'Admin' }}</span>
                                </div>
                                <p class="text-xs text-slate-800 dark:text-slate-200 line-clamp-2">
                                    {{ $fb->admin_response }}
                                </p>
                            </div>
                        @else
                            <p class="text-[11px] text-slate-400 font-mono italic">
                                <i class="fa-solid fa-hourglass-half mr-1"></i>Awaiting engineering review
                            </p>
                        @endif
                    </div>

                    <div class="pt-3 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between">
                        <span class="text-[10px] text-slate-400 font-mono">{{ $fb->created_at->format('M d, Y') }}</span>
                        <a href="{{ route('feedback.show', $fb->id) }}" class="px-3 py-1 rounded-lg bg-indigo-500/10 hover:bg-indigo-600 hover:text-white text-indigo-600 dark:text-indigo-400 text-xs font-bold transition-all inline-flex items-center gap-1">
                            <span>Open Thread</span> &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

@else
    {{-- ══════════════════════════════════════════════════════════════════════
         ADMIN MASTER CONTROL CENTER & FULL CRUD MANAGEMENT INTERFACE
    ══════════════════════════════════════════════════════════════════════ --}}
    <div x-data="{
        currentTab: '{{ request('tab', 'users') }}',
        showAddUser: false,
        showAddCareer: false,
        showAddMedia: false,
        showAddResource: false,
        editCareerModal: false,
        editCareer: { id: '', title: '', domain: '', expected_salary: '', required_skills: '', description: '' },
        openEditCareer(track) {
            this.editCareer = { ...track };
            this.editCareerModal = true;
        },
        editMediaModal: false,
        editMedia: { id: '', title: '', description: '', type: 'video', url: '', thumbnail_url: '', duration: '', tags: '' },
        openEditMedia(item) {
            this.editMedia = { ...item };
            this.editMediaModal = true;
        },
        editResourceModal: false,
        editResource: { id: '', title: '', category: '', file_url: '', thumbnail_url: '', description: '' },
        openEditResource(item) {
            this.editResource = { ...item };
            this.editResourceModal = true;
        }
    }" class="space-y-8 md:space-y-10">

        {{-- Admin Executive Header --}}
        <div class="relative rounded-3xl p-8 md:p-10 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 overflow-hidden shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
            {{-- Ambient Glows --}}
            <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-indigo-500/15 dark:bg-indigo-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-blue-500/15 dark:bg-blue-500/20 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                    {{-- Admin Shield Avatar --}}
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-3xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 font-black text-3xl shadow-xl shadow-cyan-500/25 border-2 border-white/20 shrink-0">
                        <i class="fa-solid fa-user-shield text-2xl md:text-3xl text-slate-950"></i>
                    </div>
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-3 flex-wrap">
                            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white font-display tracking-tight leading-none">{{ $user->name }}</h1>
                            <span class="px-3.5 py-1 text-xs font-black uppercase tracking-wider rounded-full bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25 shadow-sm font-mono flex items-center gap-1.5">
                                <i class="fa-solid fa-crown text-[10px]"></i> System Administrator
                            </span>
                            <span class="px-3.5 py-1 text-xs font-black uppercase tracking-wider rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25 flex items-center gap-1.5 shadow-sm font-mono">
                                <i class="fa-solid fa-circle-check text-[10px]"></i> Full Root Privileges
                            </span>
                        </div>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 font-medium flex items-center gap-2 flex-wrap">
                            <span><i class="fa-regular fa-envelope text-xs text-cyan-500 mr-1"></i>{{ $user->email }}</span>
                            <span class="text-slate-400 dark:text-slate-600">&bull;</span>
                            <span><i class="fa-solid fa-server text-xs text-sky-500 mr-1"></i>PathSeeker Core Infrastructure v2.4</span>
                            <span class="text-slate-400 dark:text-slate-600">&bull;</span>
                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1"><i class="fa-solid fa-bolt text-xs"></i>System Status: Nominal</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0 flex-wrap">
                    <button @click="showAddUser = true" class="btn-sweep inline-flex items-center gap-2 px-5 py-3 rounded-full font-bold text-xs text-white bg-indigo-600 hover:bg-indigo-500 shadow-md transition-all">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Add User</span>
                    </button>
                    <button @click="showAddCareer = true" class="btn-sweep inline-flex items-center gap-2 px-5 py-3 rounded-full font-bold text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-md transition-all font-black">
                        <i class="fa-solid fa-plus text-xs text-slate-950"></i>
                        <span class="text-slate-950 font-black">Add Career Track</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- 1. Top Metrics Row (5 Stat Cards) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
            {{-- Metric 1: Total Active Users --}}
            <div @click="currentTab = 'users'" class="card-tilt-3d p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-3 hover:-translate-y-1 hover:shadow-2xl hover:border-cyan-500/30 transition-all duration-300 cursor-pointer" :class="currentTab === 'users' ? 'ring-2 ring-cyan-500/50' : ''">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider font-mono">User Base</span>
                    <div class="w-10 h-10 rounded-2xl bg-cyan-500/15 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ count($allUsers ?? []) }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold font-mono">+18% MoM</span>
                        <span>active registrations</span>
                    </div>
                </div>
            </div>

            {{-- Metric 2: Total Career Tracks --}}
            <div @click="currentTab = 'careers'" class="card-tilt-3d p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-3 hover:-translate-y-1 hover:shadow-2xl hover:border-cyan-500/30 transition-all duration-300 cursor-pointer" :class="currentTab === 'careers' ? 'ring-2 ring-cyan-500/50' : ''">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider font-mono">Career Tracks</span>
                    <div class="w-10 h-10 rounded-2xl bg-cyan-500/15 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-compass"></i>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ count($allCareers ?? []) }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                        <span class="text-cyan-600 dark:text-cyan-400 font-bold font-mono">5 Domains</span>
                        <span>with salary telemetry</span>
                    </div>
                </div>
            </div>

            {{-- Metric 3: Multimedia Assets --}}
            <div @click="currentTab = 'multimedia'" class="card-tilt-3d p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-3 hover:-translate-y-1 hover:shadow-2xl hover:border-sky-500/30 transition-all duration-300 cursor-pointer" :class="currentTab === 'multimedia' ? 'ring-2 ring-sky-500/50' : ''">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-sky-600 dark:text-sky-400 uppercase tracking-wider font-mono">Media Assets</span>
                    <div class="w-10 h-10 rounded-2xl bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ count($allMultimedia ?? []) }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                        <span class="text-sky-600 dark:text-sky-400 font-bold font-mono">4K Ultra HD</span>
                        <span>masterclasses online</span>
                    </div>
                </div>
            </div>

            {{-- Metric 4: Total Resource Toolkits --}}
            <div @click="currentTab = 'resources'" class="card-tilt-3d p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-3 hover:-translate-y-1 hover:shadow-2xl hover:border-emerald-500/30 transition-all duration-300 cursor-pointer" :class="currentTab === 'resources' ? 'ring-2 ring-emerald-500/50' : ''">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider font-mono">Resource Toolkits</span>
                    <div class="w-10 h-10 rounded-2xl bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ count($allResources ?? []) }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold font-mono">PDF Toolkits</span>
                        <span>ready for download</span>
                    </div>
                </div>
            </div>

            {{-- Metric 5: Feedback Inbox --}}
            <div @click="currentTab = 'feedback'" class="card-tilt-3d p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-3 hover:-translate-y-1 hover:shadow-2xl hover:border-amber-500/30 transition-all duration-300 cursor-pointer" :class="currentTab === 'feedback' ? 'ring-2 ring-amber-500/50' : ''">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider font-mono">Feedback Inbox</span>
                    <div class="w-10 h-10 rounded-2xl bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                </div>
                <div>
                    <div class="text-3xl font-black text-slate-900 dark:text-white font-display">{{ count($allFeedbacks ?? []) }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                        <span class="text-amber-600 dark:text-amber-400 font-bold font-mono">{{ isset($allFeedbacks) ? $allFeedbacks->where('status', 'open')->count() : 0 }} Open</span>
                        <span>user tickets</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Interactive Navigation Tabs Bar --}}
        <div class="flex items-center gap-3 p-2 rounded-2xl bg-white/90 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 shadow-md overflow-x-auto">
            <button @click="currentTab = 'users'"
                    :class="currentTab === 'users' ? 'bg-cyan-600 text-slate-950 font-black shadow-md' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                <i class="fa-solid fa-users text-xs"></i>
                <span>User Management ({{ count($allUsers ?? []) }})</span>
            </button>
            <button @click="currentTab = 'careers'"
                    :class="currentTab === 'careers' ? 'bg-gradient-to-r from-cyan-400 to-blue-600 text-slate-950 font-black shadow-md' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                <i class="fa-solid fa-compass text-xs"></i>
                <span>Career Tracks ({{ count($allCareers ?? []) }})</span>
            </button>
            <button @click="currentTab = 'multimedia'"
                    :class="currentTab === 'multimedia' ? 'bg-gradient-to-r from-sky-400 to-blue-600 text-slate-950 font-black shadow-md' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                <i class="fa-solid fa-film text-xs"></i>
                <span>Multimedia Assets ({{ count($allMultimedia ?? []) }})</span>
            </button>
            <button @click="currentTab = 'resources'"
                    :class="currentTab === 'resources' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                <i class="fa-solid fa-folder-open text-xs"></i>
                <span>Resource Toolkits ({{ count($allResources ?? []) }})</span>
            </button>
            <button @click="currentTab = 'feedback'"
                    :class="currentTab === 'feedback' ? 'bg-amber-600 text-white shadow-md' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                <i class="fa-solid fa-comments text-xs"></i>
                <span>Feedback Inbox ({{ count($allFeedbacks ?? []) }})</span>
            </button>
            <button @click="currentTab = 'stories'"
                    :class="currentTab === 'stories' ? 'bg-gradient-to-r from-cyan-400 to-blue-600 text-slate-950 font-black shadow-md' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                <i class="fa-solid fa-feather-pointed text-xs"></i>
                <span>Stories Review ({{ count($allStories ?? []) }})</span>
                @if(count($pendingStories ?? []) > 0)
                    <span class="px-1.5 py-0.5 rounded-full text-[9px] font-black bg-slate-950 text-cyan-400 shadow-sm animate-pulse">
                        {{ count($pendingStories) }} Pending
                    </span>
                @endif
            </button>
        </div>

        {{-- ══════════════════ TAB 1: USER MANAGEMENT ══════════════════ --}}
        <div x-show="currentTab === 'users'" class="rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Registered Users Directory</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Manage authentication, modify roles, or remove accounts</p>
                </div>
                <button @click="showAddUser = true" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold shadow-md transition-all cursor-pointer">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>➕ Add New User</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-white/10 text-[10px] font-mono uppercase tracking-wider text-slate-400">
                            <th class="pb-3 font-semibold">User</th>
                            <th class="pb-3 font-semibold">Email</th>
                            <th class="pb-3 font-semibold">Role</th>
                            <th class="pb-3 font-semibold">Registered</th>
                            <th class="pb-3 font-semibold">Role Modification</th>
                            <th class="pb-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($allUsers as $u)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                <td class="py-4 pr-3 font-bold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-cyan-400 to-blue-600 flex items-center justify-center text-slate-950 text-xs font-black shrink-0">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 dark:text-white">{{ $u->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-normal">ID: #{{ $u->id }}</div>
                                    </div>
                                </td>
                                <td class="py-4 pr-3 text-slate-600 dark:text-slate-300 font-mono text-[11px]">{{ $u->email }}</td>
                                <td class="py-4 pr-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider font-mono
                                        {{ $u->role === 'admin' ? 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25' : ($u->role === 'professional' ? 'bg-indigo-500/15 text-indigo-700 dark:text-indigo-400 border border-indigo-500/25' : 'bg-cyan-500/15 text-cyan-700 dark:text-cyan-400 border border-cyan-500/25') }}">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="py-4 pr-3 text-slate-500 text-[11px] font-mono">{{ $u->created_at ? $u->created_at->format('M d, Y') : 'N/A' }}</td>
                                <td class="py-4 pr-3">
                                    <form action="{{ url('/admin/users/' . $u->id . '/role') }}" method="POST" class="flex items-center gap-1.5">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()" class="bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-lg px-2.5 py-1 text-[11px] text-slate-800 dark:text-slate-200 focus:outline-none focus:border-cyan-500">
                                            <option value="student" {{ $u->role === 'student' ? 'selected' : '' }}>Student</option>
                                            <option value="graduate" {{ $u->role === 'graduate' ? 'selected' : '' }}>Graduate</option>
                                            <option value="professional" {{ $u->role === 'professional' ? 'selected' : '' }}>Professional</option>
                                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-4 text-right">
                                    @if($u->email !== 'admin@pathseeker.com' && $u->id !== auth()->id())
                                        <form action="{{ url('/admin/users/' . $u->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete user {{ $u->name }}?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/10 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-500/20 text-[11px] font-bold transition-all cursor-pointer" title="Delete User">
                                                <i class="fa-solid fa-trash-can mr-1"></i> Delete
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 text-slate-400 text-[10px] font-mono">Protected</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ══════════════════ TAB 2: CAREER TRACKS MANAGEMENT ══════════════════ --}}
        <div x-show="currentTab === 'careers'" class="rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Career Tracks Catalog</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Add, edit, or remove industry career trajectories and salary data</p>
                </div>
                <button @click="showAddCareer = true" class="btn-sweep inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 text-xs font-black shadow-md transition-all cursor-pointer">
                    <i class="fa-solid fa-compass text-xs text-slate-950"></i>
                    <span>➕ Create Career Track</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-white/10 text-[10px] font-mono uppercase tracking-wider text-slate-400">
                            <th class="pb-3 font-semibold">Track Title</th>
                            <th class="pb-3 font-semibold">Domain</th>
                            <th class="pb-3 font-semibold">Expected Salary</th>
                            <th class="pb-3 font-semibold">Required Skills</th>
                            <th class="pb-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($allCareers as $c)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                <td class="py-4 pr-3 font-bold text-slate-900 dark:text-white">
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $c->title }}</div>
                                    <div class="text-[10px] text-slate-400 line-clamp-1 max-w-xs font-normal">{{ $c->description }}</div>
                                </td>
                                <td class="py-4 pr-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/20 font-mono">
                                        {{ $c->domain }}
                                    </span>
                                </td>
                                <td class="py-4 pr-3 text-emerald-600 dark:text-emerald-400 font-mono font-bold">{{ $c->expected_salary }}</td>
                                <td class="py-4 pr-3 text-slate-500 dark:text-slate-400 max-w-xs truncate">{{ $c->required_skills }}</td>
                                <td class="py-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('careers.show', $c->id) }}" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-cyan-600 hover:text-slate-950 text-slate-700 dark:text-slate-300 text-[11px] font-bold transition-all inline-flex items-center gap-1" title="View Track">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> View
                                    </a>
                                    <button @click="openEditCareer({{ json_encode($c) }})" class="px-2.5 py-1 rounded-lg bg-indigo-500/10 hover:bg-indigo-600 hover:text-white text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 text-[11px] font-bold transition-all cursor-pointer">
                                        <i class="fa-solid fa-pencil text-[10px]"></i> Edit
                                    </button>
                                    <form action="{{ url('/admin/careers/' . $c->id) }}" method="POST" onsubmit="return confirm('Delete career track {{ $c->title }}?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/10 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-500/20 text-[11px] font-bold transition-all cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">No career tracks recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ══════════════════ TAB 3: MULTIMEDIA ASSETS MANAGEMENT ══════════════════ --}}
        <div x-show="currentTab === 'multimedia'" class="rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Multimedia Asset Library</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Publish masterclasses, tech documentaries, and engineering walkthroughs</p>
                </div>
                <button @click="showAddMedia = true" class="btn-sweep inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 text-xs font-black shadow-md transition-all cursor-pointer">
                    <i class="fa-solid fa-film text-xs text-slate-950"></i>
                    <span>Publish Multimedia</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($allMultimedia as $m)
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-white/10 flex flex-col justify-between gap-4 shadow-sm hover:border-cyan-500/30 transition-all group">
                        <div class="space-y-3">
                            {{-- Thumbnail Preview --}}
                            <div class="relative w-full h-36 rounded-xl overflow-hidden bg-slate-900 border border-slate-200 dark:border-white/10">
                                <img src="{{ $m->thumbnail_url ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $m->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                <div class="absolute top-2.5 left-2.5">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase font-mono bg-cyan-500/90 text-slate-950 shadow-sm font-black">
                                        {{ $m->type ?? 'video' }}
                                    </span>
                                </div>
                                <div class="absolute bottom-2.5 right-2.5">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-black/80 text-white backdrop-blur-sm">
                                        <i class="fa-regular fa-clock text-[9px] mr-1"></i>{{ $m->duration ?? '15m' }}
                                    </span>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-1 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">{{ $m->title }}</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 mt-1">{{ $m->description }}</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-200 dark:border-white/10 flex items-center justify-between gap-2">
                            <a href="{{ $m->url }}" target="_blank" class="text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-play text-[10px]"></i> Stream &rarr;
                            </a>
                            <div class="flex items-center gap-1.5">
                                <button @click="openEditMedia({{ json_encode($m) }})" class="px-2.5 py-1 rounded-lg bg-cyan-500/10 hover:bg-cyan-600 hover:text-white text-cyan-600 dark:text-cyan-400 border border-cyan-500/20 text-[11px] font-bold transition-all cursor-pointer inline-flex items-center gap-1" title="Edit Multimedia Asset">
                                    <i class="fa-solid fa-pencil text-[10px]"></i> Edit
                                </button>
                                <form action="{{ url('/admin/multimedia/' . $m->id) }}" method="POST" onsubmit="return confirm('Delete multimedia item {{ $m->title }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/10 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-500/20 text-[11px] font-bold transition-all cursor-pointer" title="Delete Asset">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-slate-400 text-xs">No multimedia assets published yet.</div>
                @endforelse
            </div>
        </div>

        {{-- ══════════════════ TAB 4: RESOURCE TOOLKITS MANAGEMENT ══════════════════ --}}
        <div x-show="currentTab === 'resources'" class="rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Resource Toolkits &amp; Blueprints</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Upload downloadable cheat sheets, architectural blueprints, and interview templates</p>
                </div>
                <button @click="showAddResource = true" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md transition-all cursor-pointer">
                    <i class="fa-solid fa-file-arrow-up text-xs"></i>
                    <span>Upload Resource</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($allResources as $r)
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-white/10 flex flex-col justify-between gap-4 shadow-sm hover:border-emerald-500/30 transition-all group">
                        <div class="space-y-3">
                            {{-- Thumbnail Preview --}}
                            <div class="relative w-full h-36 rounded-xl overflow-hidden bg-slate-900 border border-slate-200 dark:border-white/10">
                                <img src="{{ $r->thumbnail_url ?? 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $r->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                <div class="absolute top-2.5 left-2.5">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-emerald-500/90 text-white shadow-sm">
                                        {{ $r->category }}
                                    </span>
                                </div>
                                <div class="absolute bottom-2.5 right-2.5">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-black/80 text-white backdrop-blur-sm">
                                        <i class="fa-solid fa-file-arrow-down text-[9px] mr-1 text-emerald-400"></i>{{ $r->download_count ?? 0 }} dl
                                    </span>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $r->title }}</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 mt-1">{{ $r->description ?? 'Production-ready technical documentation and implementation blueprint.' }}</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-200 dark:border-white/10 flex items-center justify-between gap-2">
                            <a href="{{ $r->file_url }}" target="_blank" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-download text-[10px]"></i> View File &rarr;
                            </a>
                            <div class="flex items-center gap-1.5">
                                <button @click="openEditResource({{ json_encode($r) }})" class="px-2.5 py-1 rounded-lg bg-emerald-500/10 hover:bg-emerald-600 hover:text-white text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 text-[11px] font-bold transition-all cursor-pointer inline-flex items-center gap-1" title="Edit Resource Blueprint">
                                    <i class="fa-solid fa-pencil text-[10px]"></i> Edit
                                </button>
                                <form action="{{ url('/admin/resources/' . $r->id) }}" method="POST" onsubmit="return confirm('Delete resource blueprint {{ $r->title }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/10 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-500/20 text-[11px] font-bold transition-all cursor-pointer" title="Delete Resource">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-slate-400 text-xs">No resource toolkits added yet.</div>
                @endforelse
            </div>
        </div>

        {{-- ══════════════════ TAB 5: FEEDBACK INBOX MANAGEMENT ══════════════════ --}}
        <div x-show="currentTab === 'feedback'" class="rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">User Feedback &amp; Suggestions Inbox</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Review bug reports, platform inquiries, feature requests, and dispatch admin responses</p>
                </div>
                <div class="text-xs font-mono text-slate-400">
                    Total: <strong class="text-slate-900 dark:text-white">{{ count($allFeedbacks ?? []) }}</strong> entries
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-white/10 text-[10px] font-mono uppercase tracking-wider text-slate-400">
                            <th class="pb-3 font-semibold">Category</th>
                            <th class="pb-3 font-semibold">Sender</th>
                            <th class="pb-3 font-semibold">Feedback Message</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold">Admin Resolution</th>
                            <th class="pb-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($allFeedbacks ?? [] as $fb)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                <td class="py-4 pr-3 align-top">
                                    @php
                                        $catColor = match($fb->category) {
                                            'bug' => 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border-rose-500/25',
                                            'suggestion' => 'bg-cyan-500/15 text-cyan-700 dark:text-cyan-400 border-cyan-500/25',
                                            'query' => 'bg-indigo-500/15 text-indigo-700 dark:text-indigo-400 border-indigo-500/25',
                                            default => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border-emerald-500/25'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider font-mono border {{ $catColor }}">
                                        {{ $fb->category }}
                                    </span>
                                </td>
                                <td class="py-4 pr-3 align-top">
                                    <div class="font-bold text-slate-900 dark:text-white">
                                        {{ $fb->name ?? ($fb->user ? $fb->user->name : 'Community Member') }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-mono">
                                        {{ $fb->email ?? ($fb->user ? $fb->user->email : 'No email') }}
                                    </div>
                                    <div class="text-[9px] text-slate-500 font-mono mt-0.5">
                                        {{ $fb->created_at ? $fb->created_at->format('M d, Y H:i') : '' }}
                                    </div>
                                </td>
                                <td class="py-4 pr-3 align-top max-w-xs sm:max-w-md">
                                    <p class="text-xs text-slate-800 dark:text-slate-200 leading-relaxed break-words">
                                        {{ $fb->message }}
                                    </p>
                                </td>
                                <td class="py-4 pr-3 align-top">
                                    @php
                                        $statusClass = match($fb->status) {
                                            'resolved' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border-emerald-500/25',
                                            'in_review' => 'bg-amber-500/15 text-amber-700 dark:text-amber-400 border-amber-500/25',
                                            'closed' => 'bg-slate-500/15 text-slate-700 dark:text-slate-400 border-slate-500/25',
                                            default => 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border-rose-500/25'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider font-mono border {{ $statusClass }}">
                                        {{ $fb->status }}
                                    </span>
                                </td>
                                <td class="py-4 pr-3 align-top">
                                    @if($fb->admin_response)
                                        <div class="text-[11px] text-slate-700 dark:text-slate-300 italic bg-slate-100 dark:bg-white/5 p-2 rounded-xl border border-slate-200/80 dark:border-white/10">
                                            &ldquo;{{ $fb->admin_response }}&rdquo;
                                        </div>
                                    @else
                                        <form action="{{ route('admin.feedback.respond', $fb->id) }}" method="POST" class="space-y-2">
                                            @csrf
                                            <input type="text" name="admin_response" required placeholder="Type admin resolution..." class="w-full px-2.5 py-1 text-[11px] rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white">
                                            <div class="flex items-center gap-2">
                                                <select name="status" class="px-2 py-1 text-[10px] rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white">
                                                    <option value="resolved">Resolved</option>
                                                    <option value="in_review">In Review</option>
                                                    <option value="closed">Closed</option>
                                                </select>
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-[10px] transition-all">
                                                    Reply
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                                <td class="py-4 text-right align-top">
                                    <form action="{{ route('admin.feedback.destroy', $fb->id) }}" method="POST" onsubmit="return confirm('Delete this feedback message?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/10 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-500/20 text-[11px] font-bold transition-all cursor-pointer" title="Delete Feedback">
                                            <i class="fa-solid fa-trash-can mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400">No feedback submissions in database yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ══════════════════ TAB 6: SUCCESS STORIES MODERATION ══════════════════ --}}
        <div x-show="currentTab === 'stories'" class="rounded-3xl p-6 sm:p-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">Success Stories Moderation &amp; Approval</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Review user-submitted breakthrough stories, inspect educational milestones, and approve or reject submissions</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25">
                        Pending: {{ count($pendingStories ?? []) }}
                    </span>
                    <a href="{{ route('stories.index') }}" target="_blank" class="btn-sweep inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 text-xs font-black shadow-md transition-all">
                        <span>View Public Hub</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-950"></i>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($allStories ?? [] as $st)
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-white/10 space-y-4 hover:border-cyan-500/30 transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-400 to-blue-600 text-slate-950 flex items-center justify-center font-black text-xs shrink-0 shadow-sm">
                                    {{ substr($st->author?->name ?? 'P', 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm font-display">{{ $st->title }}</h4>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 font-mono flex items-center gap-2">
                                        <span>By {{ $st->author?->name ?? 'Scholar' }} ({{ $st->author?->email ?? 'N/A' }})</span>
                                        <span>&bull;</span>
                                        <span>{{ $st->created_at ? $st->created_at->format('M d, Y') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25">
                                    {{ $st->domain }}
                                </span>
                                @php
                                    $stBadge = match($st->status) {
                                        'approved' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border-emerald-500/25',
                                        'rejected' => 'bg-rose-500/15 text-rose-700 dark:text-rose-300 border-rose-500/25',
                                        default => 'bg-amber-500/15 text-amber-700 dark:text-amber-300 border-amber-500/25'
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase border {{ $stBadge }}">
                                    {{ $st->status }}
                                </span>
                            </div>
                        </div>

                        {{-- Timeline Milestone Summary --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 p-3 rounded-xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/5 text-xs">
                            <div class="space-y-0.5">
                                <span class="text-[9px] font-mono font-bold text-indigo-600 dark:text-indigo-400 uppercase">1. Educational Path</span>
                                <p class="text-[11px] text-slate-700 dark:text-slate-300 line-clamp-2">{{ $st->educational_path ?? 'N/A' }}</p>
                            </div>
                            <div class="space-y-0.5">
                                <span class="text-[9px] font-mono font-bold text-amber-600 dark:text-amber-400 uppercase">2. Challenges</span>
                                <p class="text-[11px] text-slate-700 dark:text-slate-300 line-clamp-2">{{ $st->challenges ?? 'N/A' }}</p>
                            </div>
                            <div class="space-y-0.5">
                                <span class="text-[9px] font-mono font-bold text-emerald-600 dark:text-emerald-400 uppercase">3. Outcome</span>
                                <p class="text-[11px] text-slate-700 dark:text-slate-300 line-clamp-2">{{ $st->outcome ?? 'N/A' }}</p>
                            </div>
                        </div>

                        {{-- Story Excerpt --}}
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed italic line-clamp-2">
                            &ldquo;{{ $st->story_text }}&rdquo;
                        </p>

                        {{-- Actions Row --}}
                        <div class="pt-3 border-t border-slate-200 dark:border-white/10 flex flex-wrap items-center justify-between gap-3">
                            <a href="{{ route('stories.show', $st->id) }}" target="_blank" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline inline-flex items-center gap-1">
                                <span>Preview Full Story</span>
                                <i class="fa-solid fa-arrow-right text-[9px]"></i>
                            </a>

                            <div class="flex items-center gap-2">
                                @if($st->status !== 'approved')
                                    <form action="{{ route('admin.stories.moderate', $st->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i class="fa-solid fa-circle-check text-xs"></i>
                                            <span>Approve</span>
                                        </button>
                                    </form>
                                @endif

                                @if($st->status !== 'rejected')
                                    <form action="{{ route('admin.stories.moderate', $st->id) }}" method="POST" class="inline-flex items-center gap-1.5">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <input type="text" name="reason" placeholder="Rejection reason..." required class="px-2.5 py-1 rounded-lg bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-xs text-slate-900 dark:text-white">
                                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold shadow-sm transition-all flex items-center gap-1 cursor-pointer">
                                            <i class="fa-solid fa-circle-xmark text-xs"></i>
                                            <span>Reject</span>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('stories.destroy', $st->id) }}" method="POST" onsubmit="return confirm('Delete this success story permanently?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-500/20 text-xs font-bold transition-all cursor-pointer" title="Delete Story">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-slate-400 text-xs">No success stories in database yet.</div>
                @endforelse
            </div>
        </div>

        {{-- ══════════════════ MODAL: ADD NEW USER ══════════════════ --}}
        <div x-show="showAddUser" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="showAddUser = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-user-plus text-indigo-500"></i> Create New Platform User
                    </h3>
                    <button @click="showAddUser = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form action="{{ url('/admin/users') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Full Name</label>
                        <input type="text" name="name" required placeholder="e.g., Alexandra Vance" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Email Address</label>
                        <input type="email" name="email" required placeholder="alex@pathseeker.com" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                        <input type="password" name="password" required minlength="6" placeholder="••••••••" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">User Role</label>
                        <select name="role" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                            <option value="student">Student</option>
                            <option value="graduate">Graduate</option>
                            <option value="professional">Professional</option>
                            <option value="admin">System Administrator</option>
                        </select>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="showAddUser = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs shadow-md">Create Account</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════ MODAL: ADD CAREER TRACK ══════════════════ --}}
        <div x-show="showAddCareer" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="showAddCareer = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-compass text-cyan-500"></i> Create Career Track
                    </h3>
                    <button @click="showAddCareer = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form action="{{ url('/admin/careers') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Track Title</label>
                        <input type="text" name="title" required placeholder="e.g., AI Research Scientist" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Industry Domain</label>
                        <input type="text" name="domain" required placeholder="e.g., Artificial Intelligence" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Expected Salary Range</label>
                        <input type="text" name="expected_salary" required placeholder="e.g., $140,000 - $195,000" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Required Skills (Comma separated)</label>
                        <input type="text" name="required_skills" required placeholder="PyTorch, Transformers, Python, CUDA" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Description & Roadmap Summary</label>
                        <textarea name="description" required rows="3" placeholder="Lead deep learning model architectures..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500"></textarea>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="showAddCareer = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="btn-sweep px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs shadow-md">Publish Track</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════ MODAL: EDIT CAREER TRACK ══════════════════ --}}
        <div x-show="editCareerModal" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="editCareerModal = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-pencil text-cyan-500"></i> Edit Career Track
                    </h3>
                    <button @click="editCareerModal = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form :action="'/admin/careers/' + editCareer.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Track Title</label>
                        <input type="text" name="title" x-model="editCareer.title" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Industry Domain</label>
                        <input type="text" name="domain" x-model="editCareer.domain" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Expected Salary Range</label>
                        <input type="text" name="expected_salary" x-model="editCareer.expected_salary" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Required Skills</label>
                        <input type="text" name="required_skills" x-model="editCareer.required_skills" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Description</label>
                        <textarea name="description" x-model="editCareer.description" required rows="3" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500"></textarea>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="editCareerModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="btn-sweep px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs shadow-md">Update Track</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════ MODAL: ADD MULTIMEDIA ASSET ══════════════════ --}}
        <div x-show="showAddMedia" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="showAddMedia = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-film text-cyan-500"></i> Publish Multimedia Asset
                    </h3>
                    <button @click="showAddMedia = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form action="{{ url('/admin/multimedia') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Asset Title</label>
                        <input type="text" name="title" required placeholder="e.g., Advanced Microservices Masterclass" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Type</label>
                            <select name="type" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                                <option value="video">Video</option>
                                <option value="audio">Audio / Podcast</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Duration</label>
                            <input type="text" name="duration" placeholder="e.g., 2h 15m" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Stream / Video URL (YouTube, Vimeo, MP4)</label>
                        <input type="url" name="url" required placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Thumbnail Image URL</label>
                        <input type="text" name="thumbnail_url" placeholder="https://images.unsplash.com/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Or Upload Thumbnail Image (Optional)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-gradient-to-r file:from-[#00f2fe] file:to-blue-600 file:text-slate-950 hover:file:from-cyan-300 hover:file:to-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tags (Comma-separated)</label>
                        <input type="text" name="tags" placeholder="AI, Python, Full-Stack" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Description (Optional)</label>
                        <textarea name="description" rows="2" placeholder="Deep dive into scalable cloud systems..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500"></textarea>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="showAddMedia = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="btn-sweep px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs shadow-md">Publish Asset</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════ MODAL: EDIT MULTIMEDIA ASSET ══════════════════ --}}
        <div x-show="editMediaModal" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="editMediaModal = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-pencil text-cyan-500"></i> Edit Multimedia Asset
                    </h3>
                    <button @click="editMediaModal = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form :action="'/admin/multimedia/' + editMedia.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Asset Title</label>
                        <input type="text" name="title" x-model="editMedia.title" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Type</label>
                            <select name="type" x-model="editMedia.type" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                                <option value="video">Video</option>
                                <option value="audio">Audio / Podcast</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Duration</label>
                            <input type="text" name="duration" x-model="editMedia.duration" placeholder="e.g., 2h 15m" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Stream / Video URL (YouTube, Vimeo, MP4)</label>
                        <input type="url" name="url" x-model="editMedia.url" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Thumbnail Image URL</label>
                        <input type="text" name="thumbnail_url" x-model="editMedia.thumbnail_url" placeholder="https://images.unsplash.com/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Or Upload New Thumbnail Image (Optional)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-gradient-to-r file:from-[#00f2fe] file:to-blue-600 file:text-slate-950 hover:file:from-cyan-300 hover:file:to-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tags (Comma-separated)</label>
                        <input type="text" name="tags" x-model="editMedia.tags" placeholder="AI, Figma, Web Development" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Description</label>
                        <textarea name="description" x-model="editMedia.description" rows="3" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-cyan-500"></textarea>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="editMediaModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="btn-sweep px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs shadow-md">Update Multimedia</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════ MODAL: ADD RESOURCE TOOLKIT ══════════════════ --}}
        <div x-show="showAddResource" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="showAddResource = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-file-arrow-up text-emerald-500"></i> Upload Resource Toolkit
                    </h3>
                    <button @click="showAddResource = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form action="{{ url('/admin/resources') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Toolkit Title</label>
                        <input type="text" name="title" required placeholder="e.g., Senior Software Engineer Resume Blueprint" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Category</label>
                        <input type="text" name="category" required placeholder="e.g., Resume Template, System Design, Cheat Sheet" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Upload Topic PDF Document (.pdf)</label>
                        <input type="file" name="pdf_file" accept="application/pdf,.pdf" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Or Direct File URL (Optional if PDF uploaded)</label>
                        <input type="text" name="file_url" placeholder="/storage/resources/pdfs/... or https://..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Thumbnail / Preview Image URL</label>
                        <input type="text" name="thumbnail_url" placeholder="https://images.unsplash.com/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Or Upload Thumbnail Image (Optional)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Description (Optional)</label>
                        <textarea name="description" rows="3" placeholder="Description of this technical blueprint..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="showAddResource = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md">Upload Blueprint</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ══════════════════ MODAL: EDIT RESOURCE TOOLKIT ══════════════════ --}}
        <div x-show="editResourceModal" x-cloak style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 ">
            <div @click.outside="editResourceModal = false" class="w-full max-w-lg rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-6 sm:p-8 space-y-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-pencil text-emerald-500"></i> Edit Resource Toolkit
                    </h3>
                    <button @click="editResourceModal = false" class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
                <form :action="'/admin/resources/' + editResource.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Toolkit Title</label>
                        <input type="text" name="title" x-model="editResource.title" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Category</label>
                        <input type="text" name="category" x-model="editResource.category" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Upload New Topic PDF (.pdf)</label>
                        <input type="file" name="pdf_file" accept="application/pdf,.pdf" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Direct File URL</label>
                        <input type="text" name="file_url" x-model="editResource.file_url" placeholder="/storage/resources/pdfs/... or https://..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Thumbnail / Preview Image URL</label>
                        <input type="text" name="thumbnail_url" x-model="editResource.thumbnail_url" placeholder="https://images.unsplash.com/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Or Upload New Thumbnail Image (Optional)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Description (Optional)</label>
                        <textarea name="description" x-model="editResource.description" rows="3" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="editResourceModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold text-xs hover:bg-slate-200">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md">Update Resource</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endif

</div>

@if(auth()->user()->role !== 'admin' && auth()->user()->email !== 'admin@pathseeker.com')
{{-- Dashboard AI Advisor Scripts --}}
<script>
(function() {
    const DB_CIRC = 176; // 2π × 28

    const dbTracks = {
        fullstack: { title:"Full-Stack Web Architect",        score:"98% Match", salary:"$115k – $155k / yr", demand:"High (96%)",       major:"CS / Software Eng.",      toolchain:"Laravel, Vue/React, Tailwind",     fit:94, align:91, demandPct:96, skills:["Laravel","Vue.js","React","Tailwind CSS","Docker","MySQL","REST APIs","CI/CD"] },
        cloud:     { title:"Cloud Solutions & DevOps Eng.",   score:"95% Match", salary:"$130k – $175k / yr", demand:"Very High (98%)",  major:"Cloud Architecture / IT", toolchain:"AWS, GCP, Kubernetes, Terraform",  fit:90, align:87, demandPct:98, skills:["AWS","GCP","Kubernetes","Terraform","Docker","CI/CD","Linux","Monitoring"] },
        ai:        { title:"AI & Machine Learning Engineer",  score:"94% Match", salary:"$140k – $190k / yr", demand:"Explosive (99%)",  major:"Data Science / Maths",    toolchain:"PyTorch, TensorFlow, Python",      fit:88, align:93, demandPct:99, skills:["Python","PyTorch","TensorFlow","Pandas","SQL","BigQuery","MLOps","Statistics"] },
        security:  { title:"Cybersecurity Defense Architect", score:"92% Match", salary:"$125k – $165k / yr", demand:"Critical (97%)",   major:"Information Security",    toolchain:"SOC, Pen Testing, Zero Trust",     fit:86, align:82, demandPct:97, skills:["Pen Testing","SIEM","Zero Trust","Firewall","SOC","OWASP","IAM","Cryptography"] },
        design:    { title:"Senior Product & UI/UX Designer", score:"91% Match", salary:"$100k – $145k / yr", demand:"High (92%)",       major:"HCI / Interaction Design",toolchain:"Figma, Design Systems, Framer",     fit:85, align:90, demandPct:92, skills:["Figma","Framer","Design Systems","Prototyping","User Research","Accessibility","Motion","Wireframing"] }
    };

    function dbAnimateArc(id, pct) {
        const el = document.getElementById(id);
        if (el) el.style.strokeDashoffset = DB_CIRC - (pct / 100) * DB_CIRC;
    }

    function dbRenderSkills(skills) {
        const c = document.getElementById('db-skills');
        if (!c) return;
        c.innerHTML = '';
        skills.forEach((s, i) => {
            const p = document.createElement('span');
            p.className = 'px-2.5 py-1 text-[10px] font-medium rounded-lg border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/[0.04] text-slate-700 dark:text-slate-300 opacity-0';
            p.style.transition = `opacity 0.3s ease ${i*0.06}s, transform 0.3s ease ${i*0.06}s`;
            p.style.transform = 'translateY(4px)';
            p.textContent = s;
            c.appendChild(p);
            requestAnimationFrame(() => requestAnimationFrame(() => {
                p.style.opacity = '1';
                p.style.transform = 'translateY(0)';
            }));
        });
    }

    function dbApply(data) {
        document.getElementById('db-roleTitle').innerText = data.title;
        document.getElementById('db-matchScore').innerText = data.score;
        document.getElementById('db-salary').innerText = data.salary;
        document.getElementById('db-demand').innerText = data.demand;
        document.getElementById('db-major').innerText = data.major;
        document.getElementById('db-toolchain').innerText = data.toolchain;

        ['db-arc-fit','db-arc-align','db-arc-demand'].forEach(id => {
            const el = document.getElementById(id); if (el) el.style.strokeDashoffset = DB_CIRC;
        });
        const bar = document.getElementById('db-bar-demand'); if (bar) bar.style.width = '0%';

        const fl = document.getElementById('db-arc-fit-label');
        const al = document.getElementById('db-arc-align-label');
        const dl = document.getElementById('db-arc-demand-label');
        if (fl) fl.textContent = data.fit + '%';
        if (al) al.textContent = data.align + '%';
        if (dl) dl.textContent = data.demandPct + '%';

        requestAnimationFrame(() => requestAnimationFrame(() => {
            dbAnimateArc('db-arc-fit',    data.fit);
            dbAnimateArc('db-arc-align',  data.align);
            dbAnimateArc('db-arc-demand', data.demandPct);
            if (bar) bar.style.width = data.demandPct + '%';
        }));
        dbRenderSkills(data.skills);
    }

    window.selectDbTrack = function(key, btn) {
        const data = dbTracks[key]; if (!data) return;
        document.querySelectorAll('.db-pill').forEach(p => {
            p.classList.remove('active','border-cyan-500/50','text-cyan-700','dark:text-cyan-300','bg-cyan-500/15','dark:bg-cyan-500/20');
            p.classList.add('border-slate-200','dark:border-white/10','text-slate-600','dark:text-slate-400');
        });
        btn.classList.add('active','border-cyan-500/50','text-cyan-700','dark:text-cyan-300','bg-cyan-500/15','dark:bg-cyan-500/20');
        btn.classList.remove('border-slate-200','dark:border-white/10','text-slate-600','dark:text-slate-400');
        const out = document.getElementById('dbAdvisorOutput');
        out.style.opacity = '0.3';
        setTimeout(() => { dbApply(data); out.style.opacity = '1'; }, 180);
    };

    // ══════════════════ CAREER PATH BUILDER ENGINE ══════════════════
    const builderTracks = {
        fullstack: {
            title: "Full-Stack Web Architect",
            progress: 75,
            nodes: [
                { stage:"01", name:"Foundation", status:"Completed", desc:"Computer science basics, Git workflows & data structures.", checks:[{l:"Data Structures & Algorithms",c:true},{l:"Git & Version Control",c:true},{l:"Linux CLI & Shell Scripting",c:true}] },
                { stage:"02", name:"Core Skills", status:"Completed", desc:"Target domain frameworks, REST APIs & database design.", checks:[{l:"Framework Mastery (Laravel/React)",c:true},{l:"RESTful APIs & Auth Tokens",c:true},{l:"MySQL & Index Optimization",c:true}] },
                { stage:"03", name:"Production Projects", status:"In Progress", active:true, desc:"Full-stack deployments, containerization & microservices.", checks:[{l:"Deploy Containerized Web App",c:true},{l:"CI/CD Automated Deployment",c:false},{l:"Multi-Tier Architecture Demo",c:false}] },
                { stage:"04", name:"Target Career", status:"Upcoming", desc:"System design review, portfolio defense & senior landing.", checks:[{l:"System Design Mock Interview",c:false},{l:"Verified Portfolio Audit",c:false},{l:"Senior Role Offer Placement",c:false}] }
            ]
        },
        cloud: {
            title: "Cloud & DevOps Lead",
            progress: 66,
            nodes: [
                { stage:"01", name:"Foundation", status:"Completed", desc:"Linux kernel, networking fundamentals & bash automation.", checks:[{l:"Linux Sysadmin Fundamentals",c:true},{l:"TCP/IP, DNS & Networking",c:true},{l:"GitOps & Branching Strategy",c:true}] },
                { stage:"02", name:"Core Skills", status:"Completed", desc:"Cloud services, infrastructure-as-code & containers.", checks:[{l:"AWS / GCP Solutions Associate",c:true},{l:"Docker Engine & Compose",c:true},{l:"Terraform Infrastructure",c:true}] },
                { stage:"03", name:"Production Projects", status:"In Progress", active:true, desc:"Kubernetes clusters, telemetry & CI/CD release pipelines.", checks:[{l:"Production Kubernetes Cluster",c:false},{l:"Prometheus & Grafana Alerting",c:false},{l:"Zero-Downtime Deployment",c:false}] },
                { stage:"04", name:"Target Career", status:"Upcoming", desc:"CKA certification & enterprise cloud architect placement.", checks:[{l:"CKA / CKS Certification",c:false},{l:"Disaster Recovery Simulation",c:false},{l:"Lead DevOps Interview",c:false}] }
            ]
        },
        ai: {
            title: "AI & Machine Learning Engineer",
            progress: 58,
            nodes: [
                { stage:"01", name:"Foundation", status:"Completed", desc:"Linear algebra, multivariable calculus & Python algorithms.", checks:[{l:"Linear Algebra & Probability",c:true},{l:"NumPy & Pandas Dataframes",c:true},{l:"Python OOP & Data Structures",c:true}] },
                { stage:"02", name:"Core Skills", status:"In Progress", active:true, desc:"Neural networks, PyTorch, model optimization & BigQuery.", checks:[{l:"PyTorch / TensorFlow Pipelines",c:true},{l:"Supervised & Unsupervised Models",c:true},{l:"Data Cleaning & ETL Workflows",c:false}] },
                { stage:"03", name:"Production Projects", status:"Upcoming", desc:"LLM fine-tuning, embeddings & MLOps inference servers.", checks:[{l:"Custom LLM Fine-Tuning",c:false},{l:"Vector Database Integration",c:false},{l:"MLflow Deployment Pipeline",c:false}] },
                { stage:"04", name:"Target Career", status:"Upcoming", desc:"AI research publication, portfolio demo & research placement.", checks:[{l:"AI Architecture Case Defense",c:false},{l:"HuggingFace Live Showcase",c:false},{l:"AI Engineer Offer Placement",c:false}] }
            ]
        },
        security: {
            title: "Cybersecurity Architect",
            progress: 50,
            nodes: [
                { stage:"01", name:"Foundation", status:"Completed", desc:"Computer networks, operating systems security & cryptography.", checks:[{l:"CompTIA Security+ Fundamentals",c:true},{l:"Network Packet Analysis (Wireshark)",c:true},{l:"Cryptography & PKI Stacks",c:true}] },
                { stage:"02", name:"Core Skills", status:"In Progress", active:true, desc:"Vulnerability scanning, penetration testing & OWASP Top 10.", checks:[{l:"OWASP Web Application Security",c:true},{l:"SIEM & Splunk Log Analysis",c:false},{l:"Identity & Access Management",c:false}] },
                { stage:"03", name:"Production Projects", status:"Upcoming", desc:"Zero-trust enterprise blueprint & incident response drills.", checks:[{l:"Zero-Trust Architecture Build",c:false},{l:"Automated Penetration Test Suite",c:false},{l:"Red/Blue Team Attack Lab",c:false}] },
                { stage:"04", name:"Target Career", status:"Upcoming", desc:"CISSP / CEH certification & senior security engineer landing.", checks:[{l:"CEH / OSCP Certification",c:false},{l:"Security Audit Portfolio",c:false},{l:"Cyber Architect Role Offer",c:false}] }
            ]
        }
    };

    window.recalcPathwayProgress = function() {
        const checks = document.querySelectorAll('.builder-check');
        if (!checks.length) return;
        let checked = 0;
        checks.forEach(c => { if (c.checked) checked++; });
        const pct = Math.round((checked / checks.length) * 100);
        
        const txt = document.getElementById('pathwayProgressText');
        const bar = document.getElementById('pathwayProgressBar');
        if (txt) txt.textContent = `${pct}% Complete`;
        if (bar) bar.style.width = `${pct}%`;
    };

    window.switchBuilderTrack = function(key, btn) {
        const track = builderTracks[key];
        if (!track) return;

        document.querySelectorAll('.builder-track-pill').forEach(p => {
            p.classList.remove('active', 'border-cyan-500/50', 'text-cyan-700', 'dark:text-cyan-300', 'bg-cyan-500/15', 'dark:bg-cyan-500/20');
            p.classList.add('border-slate-200', 'dark:border-white/10', 'text-slate-600', 'dark:text-slate-400');
        });
        btn.classList.add('active', 'border-cyan-500/50', 'text-cyan-700', 'dark:text-cyan-300', 'bg-cyan-500/15', 'dark:bg-cyan-500/20');
        btn.classList.remove('border-slate-200', 'dark:border-white/10', 'text-slate-600', 'dark:text-slate-400');

        const container = document.getElementById('builderNodesContainer');
        if (!container) return;

        const iconMap = {
            "Foundation": "fa-seedling",
            "Core Skills": "fa-wrench",
            "Production Projects": "fa-diagram-project",
            "Target Career": "fa-rocket"
        };

        container.innerHTML = track.nodes.map(n => {
            const isComp = n.status === "Completed";
            const isInProg = n.status === "In Progress";
            const bdrClass = isComp ? "border-emerald-500/30 hover:border-emerald-500/60" : (isInProg ? "border-cyan-500/40 hover:border-cyan-500/70" : "border-slate-200/80 dark:border-white/[0.08] hover:border-cyan-500/40");
            const badgeClass = isComp ? "bg-emerald-500/15 text-emerald-700 dark:text-emerald-300 border-emerald-500/30" : (isInProg ? "bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border-cyan-500/40" : "bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-white/10");
            const iconBg = isComp ? "bg-emerald-500/15 border-emerald-500/30 text-emerald-600 dark:text-emerald-400" : (isInProg ? "bg-cyan-500/20 border-cyan-500/40 text-cyan-600 dark:text-cyan-400 shadow-lg shadow-cyan-500/20" : "bg-cyan-500/10 dark:bg-white/[0.04] border-cyan-500/20 dark:border-white/[0.08] text-cyan-600 dark:text-cyan-400");
            const accent = isComp ? "accent-emerald-500" : (isInProg ? "accent-cyan-500" : "accent-cyan-500");
            const activeChip = n.active ? `<div class="absolute -top-2.5 right-6 px-2.5 py-0.5 rounded-full text-[9px] font-black bg-gradient-to-r from-cyan-400 to-blue-600 text-slate-950 uppercase tracking-wider shadow-md">Active</div>` : '';
            const stageColor = isComp ? "text-emerald-600 dark:text-emerald-400" : (isInProg ? "text-cyan-600 dark:text-cyan-400" : "text-cyan-600 dark:text-cyan-400");

            return `
                <div class="relative z-10 p-6 rounded-3xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border ${bdrClass} shadow-lg space-y-4 flex flex-col justify-between group transition-all relative w-full min-w-0">
                    ${activeChip}
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl ${iconBg} border flex items-center justify-center text-lg shadow-lg">
                                <i class="fa-solid ${iconMap[n.name] || 'fa-code'}"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border ${badgeClass} flex items-center gap-1">
                                ${isComp ? '<i class="fa-solid fa-check text-[8px]"></i>' : (isInProg ? '<span class="w-1.5 h-1.5 rounded-full bg-indigo-500 dark:bg-indigo-400 animate-pulse"></span>' : '<i class="fa-solid fa-hourglass-half text-[8px]"></i>')}
                                <span>${n.status}</span>
                            </span>
                        </div>
                        <div>
                            <div class="text-[10px] font-mono ${stageColor} font-bold">STAGE ${n.stage}</div>
                            <h4 class="text-base font-black text-slate-900 dark:text-white font-display">${n.name}</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">${n.desc}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 pt-3 border-t border-slate-200/80 dark:border-white/[0.06]">
                        ${n.checks.map(c => `
                            <label class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 cursor-pointer">
                                <input type="checkbox" ${c.c ? 'checked' : ''} onchange="recalcPathwayProgress()" class="builder-check rounded ${accent}">
                                <span>${c.l}</span>
                            </label>
                        `).join('')}
                    </div>
                </div>
            `;
        }).join('');

        recalcPathwayProgress();
    };

    document.addEventListener('DOMContentLoaded', () => {
        const section = document.getElementById('dbAdvisorOutput');
        if (!section) return;
        if ('IntersectionObserver' in window) {
            const obs = new IntersectionObserver(entries => {
                entries.forEach(e => { if (e.isIntersecting) { dbApply(dbTracks['fullstack']); obs.disconnect(); } });
            }, { threshold: 0.3 });
            obs.observe(section);
        } else {
            dbApply(dbTracks['fullstack']);
        }
    });
})();
</script>
@endif
@endsection