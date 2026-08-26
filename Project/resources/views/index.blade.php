@extends('layouts.app')
@section('title', 'PathSeeker — Living Career Operating System')
@section('content')

{{-- SECTION 1: HERO (GAPSY-INSPIRED CAREER UNIVERSE) --}}
<section class="relative min-h-[85vh] flex items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 md:py-12 overflow-hidden">
    {{-- Background Ambient Atmospheric Glows --}}
    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-[120px] pointer-events-none"></div>
    <div class="absolute top-1/2 -right-32 w-96 h-96 rounded-full bg-purple-500/10 dark:bg-purple-600/15 blur-[140px] pointer-events-none"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center relative z-10 w-full">
        {{-- Left Column: Editorial Typography & Actions --}}
        <div class="lg:col-span-6 space-y-4 sm:space-y-5 text-center lg:text-left">
            {{-- Category / Sub-label Tag --}}
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/80 dark:bg-[#0c101d] border border-cyan-500/30 text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 shadow-sm backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping shrink-0"></span>
                <span class="tracking-widest">01 / CAREER INTELLIGENCE UNIVERSE</span>
            </div>

            {{-- Giant Heading (Scaled & Proportionally Balanced) --}}
            <div class="space-y-0.5">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-[4.25rem] font-black tracking-tight leading-[1.0] text-slate-900 dark:text-white font-display uppercase">
                    YOUR CAREER<br>
                    <span class="bg-gradient-to-r from-[#00f2fe] via-sky-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-[0_0_30px_rgba(0,242,254,0.3)]">STARTS HERE</span>
                </h1>
            </div>

            {{-- Editorial Descriptive Narrative --}}
            <p class="max-w-lg mx-auto lg:mx-0 text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed font-normal">
                PathSeeker maps the global technology landscape into executable trajectories. Explore 15+ verified tracks, algorithmic fit ratings, and high-yield toolkits engineered for the 2026 tech economy.
            </p>

            {{-- Action CTAs (Monochrome & Electric Cyan) --}}
            <div class="flex flex-wrap justify-center lg:justify-start items-center gap-3.5 pt-1">
                <a href="{{ route('careers.index') }}" class="group relative inline-flex items-center gap-2.5 px-7 py-3.5 text-xs sm:text-sm font-black rounded-full bg-gradient-to-r from-[#00f2fe] via-sky-400 to-indigo-500 text-slate-950 shadow-[0_0_20px_rgba(0,242,254,0.3)] hover:shadow-[0_0_30px_rgba(0,242,254,0.45)] hover:scale-105 transition-all duration-300">
                    <i class="fa-solid fa-compass text-slate-950"></i>
                    <span class="text-slate-950">Explore Career Bank</span>
                    <i class="fa-solid fa-arrow-right text-[10px] text-slate-950 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ route('quiz.index') }}" class="group inline-flex items-center gap-2.5 px-7 py-3.5 text-xs sm:text-sm font-bold rounded-full bg-slate-100/90 dark:bg-white/[0.04] text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 hover:bg-slate-200 dark:hover:bg-white/[0.08] hover:scale-105 transition-all duration-300 backdrop-blur-md">
                    <i class="fa-solid fa-brain text-purple-500 dark:text-purple-400"></i>
                    <span>Take Interest Quiz</span>
                </a>
            </div>

            {{-- Editorial Metric Counter Matrix (With Fallback Server Values to prevent 0+ flash) --}}
            <div class="flex items-center justify-center lg:justify-start gap-6 sm:gap-7 pt-4 border-t border-slate-200/80 dark:border-white/10 font-mono">
                <div class="text-center lg:text-left">
                    <div class="text-[10px] text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-wider mb-0.5">[01] DOMAINS</div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display leading-none"><span class="counter-number" data-target="15">15</span><span class="text-cyan-400">+</span></div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 font-sans font-medium">Tech Disciplines</div>
                </div>
                <div class="w-px h-8 bg-slate-200 dark:bg-white/10"></div>
                <div class="text-center lg:text-left">
                    <div class="text-[10px] text-purple-600 dark:text-purple-400 font-bold uppercase tracking-wider mb-0.5">[02] SKILLS</div>
                    <div class="text-2xl sm:text-3xl font-black text-purple-600 dark:text-purple-400 font-display leading-none"><span class="counter-number" data-target="100">100</span><span>+</span></div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 font-sans font-medium">Verified Roadmaps</div>
                </div>
                <div class="w-px h-8 bg-slate-200 dark:bg-white/10"></div>
                <div class="text-center lg:text-left">
                    <div class="text-[10px] text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-wider mb-0.5">[03] ACCURACY</div>
                    <div class="text-2xl sm:text-3xl font-black text-pink-600 dark:text-pink-400 font-display leading-none"><span class="counter-number" data-target="98">98</span><span class="text-cyan-400">%</span></div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 font-sans font-medium">Match Precision</div>
                </div>
            </div>
        </div>

        @php
            $dp = $digitalPassport ?? [
                'is_auth' => Auth::check(),
                'id_code' => Auth::check() ? 'PS-2026-' . str_pad(Auth::id(), 4, '0', STR_PAD_LEFT) : 'PS-2026-DEMO',
                'name' => Auth::check() ? Auth::user()->name : 'Guest Visitor',
                'role' => Auth::check() ? Auth::user()->role : null,
                'education' => Auth::check() ? (Auth::user()->profile?->education_level ?? Auth::user()->education_level) : null,
                'active_track' => Auth::check() ? (Auth::user()->role ? ucfirst(Auth::user()->role) . ' Track' : 'Technology Scholar') : 'Explore 15+ Technology Tracks',
                'strength' => Auth::check() ? 80 : 85,
                'core_proficiency' => Auth::check() ? 78 : 88,
                'cloud_readiness' => Auth::check() ? 74 : 82,
                'has_quiz' => false,
            ];
        @endphp

        {{-- Right Column: Interactive 3D Career Passport Physical Digital Object --}}
        <div class="lg:col-span-6 perspective-stage flex justify-center lg:justify-end items-center my-auto"
             x-data="{
                 rotateX: 0,
                 rotateY: 0,
                 glareX: 50,
                 glareY: 50,
                 glareOpacity: 0,
                 isHovered: false,
                 expanded: false,
                 rafId: null,
                 isTouch: false,
                 init() {
                     this.isTouch = window.matchMedia('(hover: none), (pointer: coarse), (prefers-reduced-motion: reduce)').matches;
                 },
                 handleMouseMove(e) {
                     if (this.isTouch) return;
                     const card = this.$refs.passportCard;
                     if (!card) return;
                     const rect = card.getBoundingClientRect();
                     const x = e.clientX - rect.left;
                     const y = e.clientY - rect.top;
                     const centerX = rect.width / 2;
                     const centerY = rect.height / 2;
                     
                     if (this.rafId) cancelAnimationFrame(this.rafId);
                     this.rafId = requestAnimationFrame(() => {
                         this.rotateX = ((y - centerY) / centerY) * -9.5;
                         this.rotateY = ((x - centerX) / centerX) * 11.5;
                         this.glareX = (x / rect.width) * 100;
                         this.glareY = (y / rect.height) * 100;
                         this.glareOpacity = 0.4;
                         this.isHovered = true;
                     });
                 },
                 handleMouseLeave() {
                     if (this.rafId) cancelAnimationFrame(this.rafId);
                     this.rotateX = 0;
                     this.rotateY = 0;
                     this.glareOpacity = 0;
                     this.isHovered = false;
                 },
                 toggleExpanded() {
                     this.expanded = !this.expanded;
                 }
             }">
            
            {{-- Physical Digital 3D Card Container (Proportionally Balanced) --}}
            <div id="passportCard"
                 x-ref="passportCard"
                 @mousemove="handleMouseMove($event)"
                 @mouseleave="handleMouseLeave()"
                 @click="toggleExpanded()"
                 :style="`transform: perspective(1000px) translate3d(0, 0, 0) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(${isHovered ? 1.015 : 1}, ${isHovered ? 1.015 : 1}, ${isHovered ? 1.015 : 1});`"
                 class="passport-card-3d relative w-full max-w-md lg:max-w-[480px] bg-white/95 dark:bg-gradient-to-b dark:from-[#0d121f] dark:via-[#080c16] dark:to-[#05070e] border border-slate-200/90 dark:border-white/15 hover:border-cyan-500/50 shadow-2xl dark:shadow-[0_16px_40px_rgba(0,0,0,0.6)] backdrop-blur-2xl rounded-3xl p-5 sm:p-6 overflow-hidden cursor-pointer select-none transition-transform duration-150 ease-out will-change-transform">
                
                {{-- Dynamic Specular Glare Sheen Overlay --}}
                <div class="absolute inset-0 pointer-events-none transition-opacity duration-300 z-30"
                     :style="`background: radial-gradient(circle at ${glareX}% ${glareY}%, rgba(0, 242, 254, 0.22) 0%, rgba(168, 85, 247, 0.12) 35%, transparent 70%); opacity: ${glareOpacity};`"></div>

                {{-- Physical Metallic Circuit & Security Pattern --}}
                <div class="absolute inset-0 opacity-[0.04] pointer-events-none bg-[radial-gradient(#00f2fe_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="absolute -top-20 -right-20 w-52 h-52 rounded-full bg-cyan-500/15 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-52 h-52 rounded-full bg-purple-500/15 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 space-y-4">
                    
                    {{-- Top Header Row: Emblem Left | Title Center | Readiness Score Right --}}
                    <div class="flex items-center justify-between gap-3 pb-3.5 border-b border-slate-200/80 dark:border-white/10">
                        {{-- Logo / Emblem Left --}}
                        <div class="flex items-center gap-2.5 shrink-0">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-gradient-to-tr from-cyan-500/20 via-sky-500/25 to-indigo-500/20 dark:from-cyan-400/20 dark:via-sky-500/30 dark:to-indigo-600/30 border border-cyan-500/30 dark:border-cyan-400/40 flex items-center justify-center shadow-md shadow-cyan-500/10">
                                <i class="fa-solid fa-compass text-base text-cyan-600 dark:text-cyan-300"></i>
                            </div>
                        </div>

                        {{-- Title Center --}}
                        <div class="text-center flex-1 min-w-0">
                            <div class="text-[8px] sm:text-[9px] font-mono font-black text-cyan-600 dark:text-cyan-400 uppercase tracking-widest">PATHSEEKER CAREER PASSPORT</div>
                            <h3 class="text-sm sm:text-base font-black text-slate-900 dark:text-white font-display tracking-tight truncate">PathSeeker Digital ID</h3>
                            <div class="text-[9px] sm:text-[10px] font-mono text-slate-500 dark:text-slate-400 font-semibold">ID: {{ $dp['id_code'] }}</div>
                        </div>

                        {{-- Readiness Score Right --}}
                        <div class="text-right shrink-0">
                            <div class="inline-flex flex-col items-end px-2.5 py-1 rounded-2xl bg-slate-100/90 dark:bg-[#0c111e] border border-slate-200/90 dark:border-cyan-500/30 shadow-inner">
                                <span class="text-sm sm:text-base font-black text-cyan-600 dark:text-cyan-400 font-mono leading-none">{{ $dp['strength'] }}%</span>
                                <span class="text-[7px] sm:text-[8px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-0.5">Readiness</span>
                            </div>
                        </div>
                    </div>

                    {{-- Candidate Holographic Credential Block --}}
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50/90 dark:bg-[#090d18] border border-slate-200/80 dark:border-white/10 flex items-center gap-3.5 sm:gap-4 shadow-sm">
                        {{-- Photo / Holographic Smart Seal --}}
                        <div class="relative shrink-0">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-tr from-cyan-500 via-sky-600 to-indigo-600 flex items-center justify-center text-white text-xl shadow-md shadow-cyan-500/20 border border-white/20">
                                <i class="fa-solid {{ $dp['is_auth'] ? 'fa-user-graduate' : 'fa-user' }} text-lg sm:text-xl text-white"></i>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/20 flex items-center justify-center shadow-sm">
                                <span class="w-2 h-2 rounded-full {{ $dp['is_auth'] ? 'bg-cyan-400 animate-pulse' : 'bg-purple-500' }}"></span>
                            </div>
                        </div>

                        {{-- Core Holder Metadata --}}
                        <div class="space-y-0.5 min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[8px] sm:text-[9px] font-mono font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider">
                                    {{ $dp['is_auth'] ? 'Certified Candidate' : 'Guest Document' }}
                                </span>
                                @if($dp['is_auth'])
                                    <span class="px-2 py-0.2 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-[8px] sm:text-[9px] font-bold text-emerald-700 dark:text-emerald-400 font-mono">
                                        Verified ID
                                    </span>
                                @else
                                    <span class="px-2 py-0.2 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-[8px] sm:text-[9px] font-bold text-cyan-700 dark:text-cyan-300 font-mono">
                                        Guest Mode
                                    </span>
                                @endif
                            </div>
                            <div class="text-sm sm:text-base font-black text-slate-900 dark:text-white font-display truncate">
                                {{ $dp['name'] }}
                            </div>
                            <div class="text-[11px] sm:text-xs text-slate-600 dark:text-slate-300 font-medium truncate">
                                {{ $dp['active_track'] }}
                                @if($dp['education'])
                                    &bull; {{ ucfirst(str_replace('_', ' ', $dp['education'])) }}
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Interactive Expansion Matrix Drawer (When clicked / inspected) --}}
                    <div x-show="expanded"
                         x-collapse
                         class="p-3 sm:p-3.5 rounded-2xl bg-slate-100/90 dark:bg-[#070a13] border border-slate-200/80 dark:border-cyan-500/20 space-y-2.5">
                        <div class="text-[9px] font-mono font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider flex items-center justify-between">
                            <span><i class="fa-solid fa-microchip mr-1"></i> Core Matrix Telemetry</span>
                            <span class="text-emerald-500">Live Synchronized</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 text-center font-mono">
                            <div class="p-1.5 rounded-xl bg-white/80 dark:bg-white/[0.03] border border-slate-200/60 dark:border-white/5">
                                <div class="text-[8px] text-slate-500">Core Fit</div>
                                <div class="text-xs font-black text-cyan-600 dark:text-cyan-400">{{ $dp['core_proficiency'] }}%</div>
                            </div>
                            <div class="p-1.5 rounded-xl bg-white/80 dark:bg-white/[0.03] border border-slate-200/60 dark:border-white/5">
                                <div class="text-[8px] text-slate-500">Cloud Sync</div>
                                <div class="text-xs font-black text-sky-600 dark:text-sky-400">{{ $dp['cloud_readiness'] }}%</div>
                            </div>
                            <div class="p-1.5 rounded-xl bg-white/80 dark:bg-white/[0.03] border border-slate-200/60 dark:border-white/5">
                                <div class="text-[8px] text-slate-500">Security</div>
                                <div class="text-xs font-black text-emerald-600 dark:text-emerald-400">256-BIT</div>
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Security MRZ Strip & Clean Action --}}
                    <div class="pt-0.5 space-y-2">
                        <div class="p-2 rounded-xl bg-slate-100/90 dark:bg-black/50 border border-slate-200/80 dark:border-white/5 font-mono text-[8px] sm:text-[9px] tracking-widest text-slate-500 dark:text-slate-400 uppercase truncate select-none">
                            P&lt;PSK{{ substr(md5($dp['id_code']), 0, 6) }}&lt;&lt;{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $dp['name'])) }}&lt;&lt;&lt;&lt;&lt;&lt;2026&lt;&lt;
                        </div>

                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 pt-0.5">
                            <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px]">
                                <i class="fa-solid fa-cube text-cyan-600 dark:text-cyan-400"></i>
                                <span x-text="expanded ? 'Click to collapse' : 'Click to inspect 3D layers'"></span>
                            </div>
                            <a href="{{ $dp['is_auth'] ? route('dashboard') : route('register') }}" 
                               @click.stop
                               class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-500 dark:hover:text-cyan-300 transition-colors">
                                <span>{{ $dp['is_auth'] ? 'View My Passport' : 'Create Your Passport' }}</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: HOW YOUR PATH COMES TOGETHER (HORIZONTAL / STAGGERED SCROLL STORYTELLING) --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-12 md:my-16 reveal-element">
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-12">
            {{-- Header Title & Subtitle --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-slate-200/80 dark:border-white/10">
                <div class="space-y-3 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/25 text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span>02 / FOUR-STAGE SYSTEM STORYTELLING</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white font-display tracking-tight uppercase">
                        HOW YOUR PATH <span class="bg-gradient-to-r from-cyan-400 via-sky-400 to-indigo-400 bg-clip-text text-transparent">COMES TOGETHER</span>
                    </h2>
                </div>
                <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm font-mono max-w-xs text-left md:text-right">
                    4 CONNECTED MILESTONES // FROM INITIAL CURIOSITY TO VERIFIED INDUSTRY READINESS.
                </p>
            </div>

            {{-- Horizontal / Staggered Connected Journey Track --}}
            <div class="relative overflow-x-auto pb-4 [&::-webkit-scrollbar]:h-1.5 [&::-webkit-scrollbar-thumb]:bg-cyan-500/30 [&::-webkit-scrollbar-track]:bg-slate-900/20">
                {{-- Continuous Electric Connecting Rail --}}
                <div class="hidden lg:block absolute top-9 left-12 right-12 h-0.5 bg-slate-200 dark:bg-white/10 z-0">
                    <div class="h-full w-full bg-gradient-to-r from-cyan-400 via-purple-500 to-emerald-400 opacity-60"></div>
                </div>

                {{-- Editorial Storytelling Steps Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 min-w-[760px] lg:min-w-0 relative z-10">
                    
                    {{-- Step 01: DISCOVER --}}
                    <div class="group relative flex flex-col justify-between p-7 rounded-3xl bg-slate-50/90 dark:bg-[#0b0f19] border border-cyan-500/40 dark:border-cyan-500/30 hover:border-cyan-400 hover:-translate-y-1.5 transition-all duration-300 shadow-lg space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="w-12 h-12 rounded-2xl bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 flex items-center justify-center text-lg font-mono font-black shadow-md shadow-cyan-500/10">
                                    01
                                </div>
                                <span class="px-3 py-1 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-cyan-600 dark:text-cyan-400 text-[10px] font-mono font-black flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span> STAGE 01
                                </span>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display tracking-tight uppercase group-hover:text-cyan-400 transition-colors">
                                    DISCOVER
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-sans">
                                    Map 15+ verified technology domains. Explore industry landscape macro-trends and align individual curiosity with market trajectory.
                                </p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-200 dark:border-white/5">
                            <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-300 transition-colors">
                                <span>Browse Domains</span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Step 02: EXPLORE WHAT'S POSSIBLE --}}
                    <div class="group relative flex flex-col justify-between p-7 rounded-3xl bg-slate-50/90 dark:bg-[#0b0f19] border border-purple-500/40 dark:border-purple-500/30 hover:border-purple-400 hover:-translate-y-1.5 transition-all duration-300 shadow-lg space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="w-12 h-12 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-400 flex items-center justify-center text-lg font-mono font-black shadow-md shadow-purple-500/10">
                                    02
                                </div>
                                <span class="px-3 py-1 rounded-full bg-purple-500/15 border border-purple-500/30 text-purple-600 dark:text-purple-400 text-[10px] font-mono font-black flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-400 animate-pulse"></span> STAGE 02
                                </span>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display tracking-tight uppercase group-hover:text-purple-400 transition-colors">
                                    EXPLORE WHAT'S POSSIBLE
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-sans">
                                    Deconstruct verified toolchains, required competencies, 5-year growth rates, and compensation benchmarks across candidate tiers.
                                </p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-200 dark:border-white/5">
                            <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 text-xs font-mono font-bold text-purple-600 dark:text-purple-400 hover:text-purple-300 transition-colors">
                                <span>Inspect Career Tracks</span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Step 03: UNDERSTAND YOUR FIT --}}
                    <div class="group relative flex flex-col justify-between p-7 rounded-3xl bg-slate-50/90 dark:bg-[#0b0f19] border border-pink-500/40 dark:border-pink-500/30 hover:border-pink-400 hover:-translate-y-1.5 transition-all duration-300 shadow-lg space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="w-12 h-12 rounded-2xl bg-pink-500/15 border border-pink-500/30 text-pink-400 flex items-center justify-center text-lg font-mono font-black shadow-md shadow-pink-500/10">
                                    03
                                </div>
                                <span class="px-3 py-1 rounded-full bg-pink-500/15 border border-pink-500/30 text-pink-600 dark:text-pink-400 text-[10px] font-mono font-black flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-400"></span> STAGE 03
                                </span>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display tracking-tight uppercase group-hover:text-pink-400 transition-colors">
                                    UNDERSTAND YOUR FIT
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-sans">
                                    Execute cognitive RIASEC evaluations. Compute probabilistic match percentages and generate explainable trajectory rankings.
                                </p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-200 dark:border-white/5">
                            <a href="{{ route('quiz.index') }}" class="inline-flex items-center gap-2 text-xs font-mono font-bold text-pink-600 dark:text-pink-400 hover:text-pink-300 transition-colors">
                                <span>Take Assessment</span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Step 04: BUILD YOUR PATH --}}
                    <div class="group relative flex flex-col justify-between p-7 rounded-3xl bg-slate-50/90 dark:bg-[#0b0f19] border border-emerald-500/40 dark:border-emerald-500/30 hover:border-emerald-400 hover:-translate-y-1.5 transition-all duration-300 shadow-lg space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-lg font-mono font-black shadow-md shadow-emerald-500/10">
                                    04
                                </div>
                                <span class="px-3 py-1 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-mono font-black flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> STAGE 04
                                </span>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white font-display tracking-tight uppercase group-hover:text-emerald-400 transition-colors">
                                    BUILD YOUR PATH
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-sans">
                                    Download verified domain blueprints, video toolkits, and link private notes to your permanent digital career passport.
                                </p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-200 dark:border-white/5">
                            <a href="{{ route('resources.index') }}" class="inline-flex items-center gap-2 text-xs font-mono font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-300 transition-colors">
                                <span>Access Toolkits</span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3: AI CAREER MATCH CONSTELLATION --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-10 md:my-16 reveal-element">
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white dark:bg-[#070b14] border border-slate-200 dark:border-cyan-500/20 shadow-2xl dark:shadow-[0_20px_60px_rgba(0,0,0,0.8)] overflow-hidden">
        {{-- Ambient Corner & Orbit Glows --}}
        <div class="absolute -top-32 -right-32 w-80 h-80 rounded-full bg-cyan-500/15 dark:bg-cyan-500/20 blur-[130px] pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-purple-500/15 dark:bg-purple-600/20 blur-[130px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[radial-gradient(#00f2fe_1px,transparent_1px)] [background-size:20px_20px]"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center relative z-10">
            
            {{-- Left Column: System Selector Tabs & Intelligence Readout --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 dark:bg-[#0b1220] border border-cyan-500/30 text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 shadow-sm backdrop-blur-md">
                    <i class="fa-solid fa-satellite-dish text-cyan-500 animate-pulse"></i>
                    <span class="tracking-wider">03 / AI CAREER MATCH CONSTELLATION</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display tracking-tight leading-tight">
                    Algorithmically mapped<br>
                    <span class="bg-gradient-to-r from-[#00f2fe] via-sky-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-[0_0_25px_rgba(0,242,254,0.3)]">Skill Constellations.</span>
                </h2>
                
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                    Explore dynamic skill orbits and probabilistic role alignment. Select a discipline to watch required competencies reorganize in real-time.
                </p>

                {{-- Interactive Constellation Track Selectors --}}
                <div class="flex flex-wrap gap-2 pt-1" id="aiAdvisorPills">
                    <button type="button" onclick="selectAiTrack('fullstack', this)" class="ai-pill active px-3.5 py-2 text-xs font-mono font-bold rounded-xl border border-cyan-500/50 text-cyan-600 dark:text-cyan-300 bg-cyan-500/15 transition-all shadow-sm flex items-center gap-1.5"><i class="fa-solid fa-code text-cyan-500"></i><span>Full-Stack</span></button>
                    <button type="button" onclick="selectAiTrack('cloud', this)" class="ai-pill px-3.5 py-2 text-xs font-mono font-bold rounded-xl border border-slate-200/80 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-cyan-500/30 transition-all flex items-center gap-1.5"><i class="fa-solid fa-cloud text-sky-500"></i><span>Cloud &amp; DevOps</span></button>
                    <button type="button" onclick="selectAiTrack('ai', this)" class="ai-pill px-3.5 py-2 text-xs font-mono font-bold rounded-xl border border-slate-200/80 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-purple-500/30 transition-all flex items-center gap-1.5"><i class="fa-solid fa-brain text-purple-500"></i><span>AI &amp; Data</span></button>
                    <button type="button" onclick="selectAiTrack('security', this)" class="ai-pill px-3.5 py-2 text-xs font-mono font-bold rounded-xl border border-slate-200/80 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-emerald-500/30 transition-all flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-emerald-500"></i><span>Cybersecurity</span></button>
                    <button type="button" onclick="selectAiTrack('design', this)" class="ai-pill px-3.5 py-2 text-xs font-mono font-bold rounded-xl border border-slate-200/80 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-pink-500/30 transition-all flex items-center gap-1.5"><i class="fa-solid fa-palette text-pink-500"></i><span>UI/UX Design</span></button>
                </div>

                {{-- Track Summary Specs --}}
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-black/40 border border-slate-200/80 dark:border-white/10 space-y-3 font-mono">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Target Role:</span>
                        <span id="advisorRoleTitle" class="font-bold text-slate-900 dark:text-white text-right">Full-Stack Web Architect</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Median Bracket:</span>
                        <span id="advisorSalary" class="font-bold text-emerald-600 dark:text-emerald-400">$115k – $155k / yr</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Academic Trajectory:</span>
                        <span id="advisorMajor" class="font-bold text-pink-600 dark:text-pink-400">CS / Software Eng.</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Market Telemetry:</span>
                        <span id="advisorDemand" class="font-bold text-cyan-600 dark:text-cyan-400">High (96%)</span>
                    </div>
                </div>

                <div class="pt-1">
                    <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-300 transition-colors group">
                        <span>[EXPLORE ALL VERIFIED TRACKS]</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            {{-- Right Column: Interactive Constellation Visualizer --}}
            <div class="lg:col-span-7">
                <div class="relative rounded-3xl p-6 sm:p-8 bg-slate-50/90 dark:bg-gradient-to-b dark:from-[#090d18] dark:to-[#04060c] border border-slate-200/90 dark:border-cyan-500/30 shadow-xl dark:shadow-2xl overflow-hidden min-h-[420px] flex flex-col justify-between" id="aiAdvisorOutput">
                    
                    {{-- Top Status Bar --}}
                    <div class="flex items-center justify-between gap-3 pb-3 border-b border-slate-200 dark:border-white/10 relative z-20">
                        <div class="flex items-center gap-2 text-xs font-mono text-cyan-600 dark:text-cyan-400">
                            <span class="w-2 h-2 rounded-full bg-cyan-500 animate-ping"></span>
                            <span class="font-bold">CONSTELLATION ENGINE v2.6</span>
                        </div>
                        <span id="advisorMatchScore" class="px-3 py-1 text-xs font-black font-mono rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.2)]">98% Match</span>
                    </div>

                    {{-- Central System Constellation Stage --}}
                    <div class="relative my-6 py-10 flex items-center justify-center min-h-[260px] z-10" id="constellationStage">
                        
                        {{-- Concentric Orbital Rings --}}
                        <div class="absolute w-64 h-64 sm:w-80 sm:h-80 rounded-full border border-cyan-500/30 dark:border-cyan-400/20 animate-pulse pointer-events-none"></div>
                        <div class="absolute w-44 h-44 sm:w-56 sm:h-56 rounded-full border border-dashed border-indigo-400/30 dark:border-purple-500/30 pointer-events-none animate-[spin_40s_linear_infinite]"></div>
                        <div class="absolute w-28 h-28 rounded-full border border-slate-300 dark:border-white/15 pointer-events-none"></div>

                        {{-- Central Core Holographic Node --}}
                        <div class="relative z-20 flex flex-col items-center justify-center w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-gradient-to-tr from-cyan-600 via-indigo-600 to-purple-600 border-2 border-white/60 dark:border-white/40 shadow-[0_0_35px_rgba(0,242,254,0.4)] cursor-pointer group">
                            <div class="text-[9px] font-mono font-bold text-cyan-100 tracking-wider uppercase">MATCH CORE</div>
                            <div id="arc-fit-label" class="text-xl sm:text-2xl font-black text-white font-display tracking-tight leading-none">94%</div>
                            <div class="text-[8px] font-mono text-cyan-200/90 mt-0.5">FIT INDEX</div>
                        </div>

                        {{-- Interactive Orbit Constellation Satellite Nodes (Injected by JS) --}}
                        <div id="constellationOrbitNodes" class="absolute inset-0 pointer-events-none flex items-center justify-center">
                            {{-- Dynamic nodes with CSS transforms --}}
                        </div>

                    </div>

                    {{-- Hidden compatibility elements for existing telemetry bindings --}}
                    <div class="hidden">
                        <span id="arc-align-label">91%</span>
                        <span id="arc-demand-label">96%</span>
                        <svg><circle id="arc-fit"></circle><circle id="arc-align"></circle><circle id="arc-demand"></circle></svg>
                        <div id="bar-demand"></div>
                    </div>

                    {{-- Core Required Skills Pills --}}
                    <div class="space-y-2 pt-2 border-t border-slate-200 dark:border-white/10 relative z-20">
                        <div class="flex items-center justify-between text-[10px] font-mono text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            <span>Orbiting Node Competencies</span>
                            <span class="text-cyan-600 dark:text-cyan-400 font-bold">8 Synchronized</span>
                        </div>
                        <div id="advisorSkills" class="flex flex-wrap gap-1.5">
                            {{-- Populated dynamically by JS --}}
                        </div>
                    </div>

                    {{-- Bottom Toolchain Strip --}}
                    <div class="pt-2.5 flex items-center justify-between gap-3 text-xs font-mono text-slate-500 dark:text-slate-400 border-t border-slate-200/80 dark:border-white/5 relative z-20">
                        <p id="advisorToolchain" class="truncate text-[11px] text-slate-700 dark:text-slate-300 font-medium">Laravel, Vue/React, Tailwind, Docker, MySQL</p>
                        <i class="fa-solid fa-code-branch text-cyan-500 dark:text-cyan-400 shrink-0"></i>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- SECTION 4: FEATURED INTELLIGENCE TRACKS --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-10 md:my-14 reveal-element">
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden space-y-10">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-purple-600 dark:text-purple-400 flex items-center gap-1.5"><i class="fa-solid fa-database text-xs"></i> Real-Time Career Bank</p>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display">Featured <span class="grad-text">Intelligence Tracks</span></h2>
            </div>
            <a href="{{ route('careers.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors shrink-0">
                <span>View Full Career Bank</span><i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1.5 transition-transform"></i>
            </a>
        </div>

        {{-- Featured Careers Editorial Rows --}}
        <div class="space-y-4 relative z-10">
            @forelse($featuredCareers as $career)
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
                    $cId = $career->id;
                    $tEsc = addslashes($career->title);
                    $dEsc = addslashes($career->domain);
                    $sEsc = addslashes($career->expected_salary);
                    $skEsc = addslashes($career->required_skills);
                    $urlEsc = route('careers.show', $career->id);
                    $diffLevel = ($cId % 3 === 0) ? 'Advanced' : (($cId % 3 === 2) ? 'Intermediate' : 'Beginner / Intermediate');
                    $demandVal = $career->market_metrics['demand_score'] ?? 94;
                    $rowIndex = sprintf('%02d', $loop->iteration);
                @endphp

                <div class="career-card relative p-6 sm:p-7 rounded-3xl bg-slate-50/80 dark:bg-[#0b0f19] border border-slate-200/90 dark:border-white/10 hover:border-cyan-500/50 hover:bg-slate-100/90 dark:hover:bg-[#0e1424] shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
                    {{-- Ambient Hover Glow --}}
                    <div class="absolute -right-20 -top-20 w-48 h-48 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-2xl opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>

                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
                        {{-- Left Column: Index · Domain — Title & Description --}}
                        <div class="space-y-2 flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="text-xs font-mono font-black text-cyan-600 dark:text-cyan-400 tracking-wider">
                                    {{ $rowIndex }} &middot; {{ strtoupper($career->domain) }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-[10px] font-mono font-black text-emerald-700 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse inline-block mr-1"></span>{{ $demandVal }}% Match
                                </span>
                            </div>

                            <div class="space-y-1">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display tracking-tight group-hover:text-cyan-500 dark:group-hover:text-cyan-400 transition-colors truncate">
                                    {{ $career->title }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 line-clamp-1 leading-relaxed">
                                    {{ $career->description }}
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-1.5 pt-0.5">
                                @foreach(array_slice($skills, 0, 4) as $sk)
                                    <span class="px-2 py-0.5 rounded-lg bg-white dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/5 text-[10px] font-mono font-medium text-slate-600 dark:text-slate-300">
                                        {{ $sk }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Right Column: Benchmark Salary & Direct View Path --}}
                        <div class="flex items-center justify-between lg:justify-end gap-6 pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-200/80 dark:border-white/5 shrink-0">
                            <div class="text-left lg:text-right">
                                <span class="block text-[9px] uppercase font-mono font-bold text-slate-500 dark:text-slate-400">Target Benchmark</span>
                                <span class="text-base sm:text-lg font-black text-emerald-600 dark:text-emerald-400 font-mono">{{ $career->expected_salary }}</span>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button"
                                        onclick="toggleCompare({{ $cId }}, '{{ $tEsc }}', '{{ $dEsc }}', '{{ $sEsc }}', '{{ $demandVal }}%', '{{ $diffLevel }}', '{{ $skEsc }}', '{{ $urlEsc }}', '{{ $badgeClass }}', '{{ $domIcon }}')"
                                        id="btn-compare-{{ $cId }}"
                                        class="compare-toggle-btn px-3 py-2 text-xs font-bold rounded-xl border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-300 hover:border-cyan-500/30 transition-all flex items-center gap-1.5 bg-white dark:bg-white/[0.04] shadow-sm"
                                        title="Add to career comparison matrix">
                                    <i class="fa-solid fa-plus text-[10px] icon-state"></i>
                                    <span class="label-state hidden sm:inline">Compare</span>
                                </button>

                                <a href="{{ route('careers.show', $career->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-mono font-bold text-white bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-400 hover:to-indigo-500 shadow-md shadow-cyan-500/20 hover:shadow-cyan-500/35 hover:scale-105 transition-all group/link">
                                    <span>View Path</span>
                                    <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 rounded-3xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/5 text-slate-500 font-mono text-sm">No careers registered yet.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- SECTION 5: MULTIMEDIA & RESOURCES --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-10 md:my-14 reveal-element">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Multimedia Card --}}
        <div class="relative flex flex-col rounded-3xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-white dark:bg-[#080B12] shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
            <div class="px-7 py-5 border-b border-slate-200/80 dark:border-white/10 flex items-center justify-between bg-slate-50/50 dark:bg-white/[0.02]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-cyan-500/15 border border-cyan-500/25 flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-play text-cyan-600 dark:text-cyan-400 text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900 dark:text-white font-display">Multimedia Center</h3>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">HD masterclasses &amp; podcast walkthroughs</p>
                    </div>
                </div>
                <a href="{{ route('multimedia.index') }}" class="text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-300 transition-colors flex items-center gap-1.5 group">
                    <span>View All</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
                </a>
            </div>
            <div class="divide-y divide-slate-200/80 dark:divide-white/[0.05] flex-1 p-2 sm:p-3">
                @forelse($featuredMultimedia as $media)
                    <div class="p-4 rounded-2xl flex items-center justify-between gap-4 hover:bg-slate-100/80 dark:hover:bg-white/[0.04] transition-all group">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="relative w-16 h-12 rounded-xl overflow-hidden shrink-0 bg-slate-900 border border-slate-200/80 dark:border-white/5 shadow-sm">
                                <img src="{{ $media->thumbnail_url ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200&auto=format&fit=crop&q=80' }}" alt="{{ $media->title }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center"><i class="fa-solid fa-play text-[8px] text-white"></i></div>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <span class="inline-block text-[9px] font-bold px-2 py-0.5 rounded-full {{ $media->type === 'video' ? 'bg-cyan-500/15 text-cyan-600 dark:text-cyan-400 border border-cyan-500/20' : 'bg-purple-500/15 text-purple-600 dark:text-purple-400 border border-purple-500/20' }}">{{ strtoupper($media->type) }}</span>
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors line-clamp-1 font-display">{{ $media->title }}</h4>
                                <p class="text-[10px] text-slate-500 dark:text-slate-400 line-clamp-1">{{ $media->tags }}</p>
                            </div>
                        </div>
                        <a href="{{ route('multimedia.show', $media->id) }}" class="shrink-0 px-3 py-1.5 text-xs font-bold rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-cyan-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-cyan-500/40 transition-all flex items-center gap-1.5 shadow-sm">
                            <i class="fa-solid fa-play text-[9px]"></i> Stream
                        </a>
                    </div>
                @empty
                    <p class="px-7 py-8 text-xs text-slate-500 text-center">No multimedia records available.</p>
                @endforelse
            </div>
        </div>

        {{-- Resource Library Card --}}
        <div class="relative flex flex-col rounded-3xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-white dark:bg-[#080B12] shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
            <div class="px-7 py-5 border-b border-slate-200/80 dark:border-white/10 flex items-center justify-between bg-slate-50/50 dark:bg-white/[0.02]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-sky-500/15 border border-sky-500/25 flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-terminal text-sky-600 dark:text-sky-400 text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900 dark:text-white font-display">Resource Library</h3>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Downloadable blueprints &amp; toolkits</p>
                    </div>
                </div>
                <a href="{{ route('resources.index') }}" class="text-xs font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-300 transition-colors flex items-center gap-1.5 group">
                    <span>View All</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
                </a>
            </div>
            <div class="divide-y divide-slate-200/80 dark:divide-white/[0.05] flex-1 p-2 sm:p-3">
                @forelse($featuredResources as $res)
                    <div class="p-4 rounded-2xl flex items-center justify-between gap-4 hover:bg-slate-100/80 dark:hover:bg-white/[0.04] transition-all group">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-slate-900 border border-slate-200/80 dark:border-white/5 shadow-sm">
                                <img src="{{ $res->thumbnail_url ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=200&auto=format&fit=crop&q=80' }}" alt="{{ $res->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <span class="inline-block text-[9px] font-bold px-2 py-0.5 rounded-full bg-sky-500/15 text-sky-600 dark:text-sky-400 border border-sky-500/20">
                                    <i class="fa-solid fa-folder text-[8px] mr-0.5"></i>{{ $res->category }}
                                </span>
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors line-clamp-1 font-display">{{ $res->title }}</h4>
                                <p class="text-[10px] text-slate-500 dark:text-slate-400 line-clamp-1">{{ $res->description ?? 'Verified technical blueprint and engineering handbook' }}</p>
                            </div>
                        </div>
                        <a href="{{ $res->file_url }}" target="_blank" class="shrink-0 px-3 py-1.5 text-xs font-bold text-sky-600 dark:text-sky-400 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 hover:border-sky-500/40 hover:text-sky-700 dark:hover:text-sky-300 transition-all flex items-center gap-1.5 shadow-sm">
                            <i class="fa-solid fa-file-arrow-down text-xs"></i> Get
                        </a>
                    </div>
                @empty
                    <p class="px-7 py-8 text-xs text-slate-500 text-center">No resources uploaded yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════ SECTION 6: HOMEPAGE COMMUNITY FEEDBACK & SUGGESTIONS (DIRECT INLINE FORM) ══════════════════ --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-12 md:my-16 reveal-element">
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            {{-- Left Column: Description & Community Callout --}}
            <div class="lg:col-span-5 space-y-5">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 border border-cyan-500/25 text-xs font-black uppercase tracking-wider text-cyan-700 dark:text-cyan-300">
                    <i class="fa-solid fa-comments text-cyan-500"></i>
                    <span>Community &amp; Engineering Hub</span>
                </div>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-tight font-display">
                    Help Shape the Future of <span class="grad-text">PathSeeker</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Have a technical suggestion, identified a roadmap gap, or encountered a platform bug? Submit your feedback directly to our core engineering team.
                </p>
                
                <div class="space-y-3 pt-2 text-xs text-slate-600 dark:text-slate-400 font-medium">
                    <div class="flex items-center gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span>Reviewed directly by platform architects</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-indigo-500/15 text-indigo-500 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-bell text-[10px]"></i>
                        </div>
                        <span>Live status updates on roadmap progression</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-pink-500/15 text-pink-500 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-shield-halved text-[10px]"></i>
                        </div>
                        <span>Guaranteed privacy and end-to-end security</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-black/30 border border-slate-200/80 dark:border-white/5 space-y-2 font-mono text-xs">
                    <div class="text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Live Telemetry Channel</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed font-sans">
                        All submissions are routed straight to our triage dashboard and logged with telemetry context.
                    </p>
                </div>
            </div>

            {{-- Right Column: Fully Visible Direct Inline Form --}}
            <div class="lg:col-span-7">
                <div class="rounded-3xl bg-slate-50/80 dark:bg-[#0b0f19] border border-slate-200/90 dark:border-white/10 p-6 sm:p-8 shadow-xl relative">
                    <form action="{{ route('feedback.store') }}" method="POST" class="space-y-5" x-data="{ selectedCategory: 'suggestion' }">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-2">
                                Feedback Category
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="category" value="suggestion" class="sr-only" x-model="selectedCategory">
                                    <div :class="selectedCategory === 'suggestion' ? 'bg-cyan-500/20 border-cyan-500/50 text-cyan-700 dark:text-cyan-300 font-bold shadow-sm' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400'" class="p-2.5 rounded-xl border text-center text-xs transition-all flex items-center justify-center gap-1.5 hover:border-cyan-500/30">
                                        <i class="fa-solid fa-lightbulb text-xs text-amber-500"></i>
                                        <span>Suggestion</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="category" value="bug" class="sr-only" x-model="selectedCategory">
                                    <div :class="selectedCategory === 'bug' ? 'bg-rose-500/20 border-rose-500/50 text-rose-700 dark:text-rose-300 font-bold shadow-sm' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400'" class="p-2.5 rounded-xl border text-center text-xs transition-all flex items-center justify-center gap-1.5 hover:border-rose-500/30">
                                        <i class="fa-solid fa-bug text-xs text-rose-500"></i>
                                        <span>Bug Report</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="category" value="query" class="sr-only" x-model="selectedCategory">
                                    <div :class="selectedCategory === 'query' ? 'bg-cyan-500/20 border-cyan-500/50 text-cyan-700 dark:text-cyan-300 font-bold shadow-sm' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400'" class="p-2.5 rounded-xl border text-center text-xs transition-all flex items-center justify-center gap-1.5 hover:border-cyan-500/30">
                                        <i class="fa-solid fa-circle-question text-xs text-cyan-500"></i>
                                        <span>Inquiry</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="category" value="general" class="sr-only" x-model="selectedCategory">
                                    <div :class="selectedCategory === 'general' ? 'bg-emerald-500/20 border-emerald-500/50 text-emerald-700 dark:text-emerald-300 font-bold shadow-sm' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-400'" class="p-2.5 rounded-xl border text-center text-xs transition-all flex items-center justify-center gap-1.5 hover:border-emerald-500/30">
                                        <i class="fa-solid fa-comment-dots text-xs text-emerald-500"></i>
                                        <span>General</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        @guest
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-1.5">
                                    Your Name (Optional)
                                </label>
                                <input type="text" name="name" placeholder="e.g., Alex Vance" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-1.5">
                                    Email Address (Optional)
                                </label>
                                <input type="email" name="email" placeholder="alex@example.com" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition-all">
                            </div>
                        </div>
                        @endguest

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-2">
                                Your Message &amp; Feedback
                            </label>
                            <textarea name="message" rows="4" required minlength="5" maxlength="2000" placeholder="Share your recommendations, feature requests, or issue details with us..." class="w-full px-4 py-3 text-xs sm:text-sm rounded-2xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none shadow-inner transition-all"></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-1">
                            <p class="text-[10px] text-slate-500 font-mono">
                                @auth Signed in as {{ Auth::user()->name }} @else Submitting as Guest Visitor @endauth
                            </p>
                            <button type="submit" class="btn-sweep w-full sm:w-auto px-8 py-3.5 rounded-full text-xs font-black text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-lg shadow-cyan-500/25 hover:shadow-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <span class="text-slate-950 font-black">Submit Feedback</span>
                                <i class="fa-solid fa-paper-plane text-[10px] text-slate-950"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ══════════════════ SECTION 7: FINAL CTA (BUILD YOUR PATH) ══════════════════ --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-10 md:my-14 reveal-element">
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden text-center">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl mx-auto space-y-6 sm:space-y-8">
            {{-- Category Eyebrow Tag --}}
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/25 text-xs font-mono font-bold text-cyan-600 dark:text-cyan-400 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                <span class="tracking-widest uppercase">04 / GLOBAL TRAJECTORY CONVERGENCE</span>
            </div>

            {{-- Signature Emblem --}}
            <div class="flex items-center justify-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-3xl bg-gradient-to-tr from-cyan-500 via-sky-500 to-indigo-600 border border-cyan-400/40 flex items-center justify-center text-white text-2xl sm:text-3xl shadow-lg shadow-cyan-500/20">
                    <i class="fa-solid fa-compass text-white"></i>
                </div>
            </div>

            {{-- Standardized Heading with Electric Cyan Gradient --}}
            <div class="space-y-3">
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black font-display tracking-tight uppercase text-slate-900 dark:text-white leading-tight">
                    BUILD YOUR <span class="bg-gradient-to-r from-[#00f2fe] via-sky-400 to-indigo-400 bg-clip-text text-transparent">PATH</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed max-w-xl mx-auto font-normal">
                    Connect your ambition to verified 2026 tech economy trajectories. Claim your cryptographic Career Passport, master verified toolchains, and accelerate your professional destiny.
                </p>
            </div>

            {{-- Action CTAs (Restrained Cyan Glow) --}}
            <div class="flex flex-wrap items-center justify-center gap-3.5 pt-2">
                <a href="{{ route('careers.index') }}" class="group relative inline-flex items-center gap-2.5 px-8 py-3.5 text-xs sm:text-sm font-black rounded-full bg-gradient-to-r from-[#00f2fe] via-sky-400 to-indigo-500 text-slate-950 shadow-[0_0_20px_rgba(0,242,254,0.3)] hover:shadow-[0_0_30px_rgba(0,242,254,0.45)] hover:scale-105 transition-all duration-300">
                    <i class="fa-solid fa-compass text-slate-950"></i>
                    <span class="text-slate-950">Explore All Pathways</span>
                    <i class="fa-solid fa-arrow-right text-[10px] text-slate-950 group-hover:translate-x-1 transition-transform"></i>
                </a>

                <a href="{{ route('quiz.index') }}" class="group inline-flex items-center gap-2.5 px-8 py-3.5 text-xs sm:text-sm font-bold rounded-full bg-slate-100 dark:bg-white/[0.04] text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 hover:bg-slate-200 dark:hover:bg-white/[0.08] hover:scale-105 transition-all duration-300 backdrop-blur-md">
                    <i class="fa-solid fa-brain text-purple-500 dark:text-purple-400"></i>
                    <span>Launch Assessment</span>
                </a>
            </div>

            {{-- Verification Micro-Telemetry Footer --}}
            <div class="flex flex-wrap items-center justify-center gap-6 pt-6 text-[11px] font-mono text-slate-500 dark:text-slate-400 border-t border-slate-200/80 dark:border-white/5">
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-check text-cyan-600 dark:text-cyan-400"></i>
                    <span>256-BIT CRYPTOGRAPHIC PASSPORT</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-satellite text-sky-600 dark:text-sky-400"></i>
                    <span>15+ VERIFIED 2026 BLUEPRINTS</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt text-emerald-600 dark:text-emerald-400"></i>
                    <span>ALGORITHMIC RIASEC MATCH</span>
                </div>
            </div>
        </div>
    </div>
</section>

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
                    class="px-5 py-2.5 rounded-xl font-black text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 shadow-lg shadow-cyan-500/25 hover:scale-105 transition-all flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-table-columns text-[10px] text-slate-950"></i>
                <span id="btnCompareLabel" class="font-black">Compare</span>
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
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/80 opacity-0 pointer-events-none transition-opacity duration-300"
     onclick="handleModalBackdropClick(event)">
    
    <div class="relative w-full max-w-5xl max-h-[90vh] flex flex-col rounded-2xl bg-slate-900 border border-white/10 p-6 sm:p-8 shadow-2xl overflow-hidden scale-95 transition-transform duration-300"
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

        {{-- Modal Scrollable Body / Comparison Matrix Table & Empty State --}}
        <div class="py-6 overflow-y-auto flex-1 space-y-6 scrollbar-thin" id="matrixContainer">
            
            <div class="overflow-x-auto rounded-xl border border-white/10 bg-white/[0.02]" id="matrixTableWrapper">
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

            {{-- Empty State when 0 items selected --}}
            <div id="matrixEmptyState" class="hidden py-12 px-6 text-center space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-400 flex items-center justify-center text-2xl mx-auto shadow-sm">
                    <i class="fa-solid fa-code-compare"></i>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-black text-white font-display">Choose up to three roles to compare</h4>
                    <p class="text-xs text-slate-400 max-w-md mx-auto">Select 2 or 3 career tracks from the Career Bank to see live side-by-side salary benchmarks, market demand scores, and skill requirements.</p>
                </div>
                <div class="pt-2">
                    <a href="{{ route('careers.index') }}" onclick="closeCompareModal()" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md hover:scale-105 transition-all">
                        <span>Browse Career Bank</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
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

<script>
// ── Shared arc circumference: r=32, so 2πr ≈ 201
const ARC_CIRC = 201;

// ── Full AI track data including fit, alignment, demand % and skills
const aiTracks = {
    fullstack: {
        title: "Full-Stack Web Architect", score: "98% Match",
        salary: "$115k – $155k / yr",  demand: "High (96%)",
        major: "CS / Software Eng.",   stack: "Laravel, Vue/React, Tailwind, Docker, MySQL",
        fit: 94, align: 91, demandPct: 96,
        skills: ["Laravel","Vue.js","React","Tailwind CSS","Docker","MySQL","REST APIs","CI/CD"]
    },
    cloud: {
        title: "Cloud Solutions & DevOps Eng.", score: "95% Match",
        salary: "$130k – $175k / yr",  demand: "Very High (98%)",
        major: "Cloud Architecture / IT", stack: "AWS, GCP, Kubernetes, Terraform, CI/CD",
        fit: 90, align: 87, demandPct: 98,
        skills: ["AWS","GCP","Kubernetes","Terraform","Docker","CI/CD","Linux","Monitoring"]
    },
    ai: {
        title: "AI & Machine Learning Engineer", score: "94% Match",
        salary: "$140k – $190k / yr", demand: "Explosive (99%)",
        major: "Data Science / Maths",  stack: "PyTorch, TensorFlow, Python, BigQuery, CUDA",
        fit: 88, align: 93, demandPct: 99,
        skills: ["Python","PyTorch","TensorFlow","Pandas","SQL","BigQuery","MLOps","Statistics"]
    },
    security: {
        title: "Cybersecurity Defense Architect", score: "92% Match",
        salary: "$125k – $165k / yr", demand: "Critical (97%)",
        major: "Information Security", stack: "SOC, Pen Testing, Zero Trust, SIEM",
        fit: 86, align: 82, demandPct: 97,
        skills: ["Pen Testing","SIEM","Zero Trust","Firewall","SOC","OWASP","IAM","Cryptography"]
    },
    design: {
        title: "Senior Product & UI/UX Designer", score: "91% Match",
        salary: "$100k – $145k / yr", demand: "High (92%)",
        major: "HCI / Interaction Design", stack: "Figma, Design Systems, Framer, Prototyping",
        fit: 85, align: 90, demandPct: 92,
        skills: ["Figma","Framer","Design Systems","Prototyping","User Research","Accessibility","Motion","Wireframing"]
    }
};

// ── Animate an SVG arc circle to a given percentage
function animateArc(id, pct) {
    const el = document.getElementById(id);
    if (!el) return;
    const offset = ARC_CIRC - (pct / 100) * ARC_CIRC;
    el.style.strokeDashoffset = offset;
}

// ── Render constellation orbit nodes around central core
function renderConstellation(skills) {
    const orbitContainer = document.getElementById('constellationOrbitNodes');
    if (!orbitContainer) return;
    orbitContainer.innerHTML = '';
    
    const total = Math.min(skills.length, 8);
    const radius = window.innerWidth < 640 ? 95 : 125;
    
    for (let i = 0; i < total; i++) {
        const angle = (i / total) * 2 * Math.PI - Math.PI / 2;
        const x = Math.round(Math.cos(angle) * radius);
        const y = Math.round(Math.sin(angle) * radius);
        
        const node = document.createElement('div');
        node.className = 'absolute pointer-events-auto transition-all duration-500 ease-out transform -translate-x-1/2 -translate-y-1/2 cursor-default group';
        node.style.left = `calc(50% + ${x}px)`;
        node.style.top = `calc(50% + ${y}px)`;
        node.style.opacity = '0';
        node.style.transform = `translate(-50%, -50%) scale(0.6)`;
        
        node.innerHTML = `
            <div class="px-2.5 py-1 rounded-xl bg-white/95 dark:bg-[#0c1222] border border-cyan-500/40 text-[10px] font-mono font-bold text-slate-800 dark:text-cyan-300 shadow-md dark:shadow-[0_0_15px_rgba(0,242,254,0.25)] flex items-center gap-1.5 backdrop-blur-md group-hover:scale-110 group-hover:border-cyan-500 dark:group-hover:border-cyan-400 group-hover:shadow-lg dark:group-hover:shadow-[0_0_20px_rgba(0,242,254,0.5)] transition-all">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 dark:bg-cyan-400 animate-pulse"></span>
                <span>${skills[i]}</span>
            </div>
        `;
        orbitContainer.appendChild(node);
        
        const delay = i * 40;
        setTimeout(() => {
            node.style.opacity = '1';
            node.style.transform = `translate(-50%, -50%) scale(1)`;
        }, delay);
    }
}

// ── Render skill pills with staggered fade-in
function renderSkills(skills) {
    const container = document.getElementById('advisorSkills');
    if (!container) return;
    container.innerHTML = '';
    skills.forEach((skill, i) => {
        const pill = document.createElement('span');
        pill.className = 'px-2.5 py-1 text-[10px] font-mono font-bold rounded-lg border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/[0.06] text-slate-800 dark:text-slate-200 opacity-0 shadow-2xs';
        pill.style.transition = `opacity 0.3s ease ${i * 0.06}s, transform 0.3s ease ${i * 0.06}s`;
        pill.style.transform = 'translateY(4px)';
        pill.textContent = skill;
        container.appendChild(pill);
        // Trigger animation after a microtask so the initial state registers
        requestAnimationFrame(() => requestAnimationFrame(() => {
            pill.style.opacity = '1';
            pill.style.transform = 'translateY(0)';
        }));
    });
}

// ── Master update function
function applyTrackData(data) {
    const roleEl = document.getElementById('advisorRoleTitle');
    const scoreEl = document.getElementById('advisorMatchScore');
    const salaryEl = document.getElementById('advisorSalary');
    const demandEl = document.getElementById('advisorDemand');
    const majorEl = document.getElementById('advisorMajor');
    const stackEl = document.getElementById('advisorToolchain');

    if (roleEl) roleEl.innerText = data.title;
    if (scoreEl) scoreEl.innerText = data.score;
    if (salaryEl) salaryEl.innerText = data.salary;
    if (demandEl) demandEl.innerText = data.demand;
    if (majorEl) majorEl.innerText = data.major;
    if (stackEl) stackEl.innerText = data.stack;

    // Reset arcs to 0 first (so transition plays)
    ['arc-fit','arc-align','arc-demand'].forEach(id => {
        const el = document.getElementById(id);
        if (el && typeof ARC_CIRC !== 'undefined') el.style.strokeDashoffset = ARC_CIRC;
    });
    const bar = document.getElementById('bar-demand');
    if (bar) bar.style.width = '0%';

    // Labels
    const fitLabel    = document.getElementById('arc-fit-label');
    const alignLabel  = document.getElementById('arc-align-label');
    const demandLabel = document.getElementById('arc-demand-label');
    if (fitLabel)    fitLabel.textContent    = data.fit + '%';
    if (alignLabel)  alignLabel.textContent  = data.align + '%';
    if (demandLabel) demandLabel.textContent = data.demandPct + '%';

    // Animate after reset frame
    requestAnimationFrame(() => requestAnimationFrame(() => {
        if (typeof animateArc === 'function') {
            animateArc('arc-fit',    data.fit);
            animateArc('arc-align',  data.align);
            animateArc('arc-demand', data.demandPct);
        }
        if (bar) bar.style.width = data.demandPct + '%';
    }));

    renderSkills(data.skills);
    renderConstellation(data.skills);
}

// ── Public pill-click handler
function selectAiTrack(key, btn) {
    const data = aiTracks[key];
    if (!data) return;

    document.querySelectorAll('.ai-pill').forEach(p => {
        p.classList.remove('active', 'border-cyan-500/50', 'text-cyan-600', 'dark:text-cyan-300', 'bg-cyan-500/15', 'bg-purple-500/15');
        p.classList.add('border-slate-200/80', 'dark:border-white/10', 'text-slate-600', 'dark:text-slate-400');
    });
    btn.classList.add('active', 'border-cyan-500/50', 'text-cyan-600', 'dark:text-cyan-300', 'bg-cyan-500/15');
    btn.classList.remove('border-slate-200/80', 'dark:border-white/10', 'text-slate-600', 'dark:text-slate-400');

    const out = document.getElementById('aiAdvisorOutput');
    if (out) out.style.opacity = '0.3';
    setTimeout(() => {
        applyTrackData(data);
        if (out) out.style.opacity = '1';
    }, 180);
}

// ── Career Comparison State & Handlers
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
        btn.classList.add('border-slate-200', 'dark:border-white/10', 'text-slate-600', 'dark:text-slate-400');
        if (icon) { icon.className = 'fa-solid fa-plus text-[9px] icon-state'; }
        if (label) { label.textContent = 'Compare'; }
    });

    compareState.items.forEach(item => {
        const btn = document.getElementById(`btn-compare-${item.id}`);
        if (btn) {
            btn.classList.remove('border-slate-200', 'dark:border-white/10', 'text-slate-600', 'dark:text-slate-400');
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
                    <button type="button" onclick="toggleCompare(${item.id}); renderComparisonMatrix();" class="w-6 h-6 rounded-full bg-white/5 hover:bg-rose-500/20 text-slate-400 hover:text-rose-400 flex items-center justify-center transition-colors text-[10px]" title="Remove from comparison">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <h4 class="text-base sm:text-lg font-black text-white font-display leading-tight">${item.title}</h4>
            </div>
        `;
        headerRow.appendChild(th);
    });

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
            ${items.map(item => `
                <td class="p-5 align-middle">
                    <span class="px-3 py-1 text-xs font-bold rounded-lg border ${
                        item.difficulty.includes('Advanced') 
                            ? 'bg-purple-500/15 border-purple-500/30 text-purple-300' 
                            : (item.difficulty.includes('Intermediate') ? 'bg-amber-500/15 border-amber-500/30 text-amber-300' : 'bg-emerald-500/15 border-emerald-500/30 text-emerald-300')
                    }">
                        ${item.difficulty}
                    </span>
                </td>
            `).join('')}
        </tr>

        {{-- Row: Primary Skills --}}
        <tr class="hover:bg-white/[0.01] transition-colors">
            <td class="p-5 font-bold text-slate-300 text-xs border-r border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-sky-500/15 text-sky-400 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <span>Primary Skills</span>
                </div>
            </td>
            ${items.map(item => {
                const skArray = item.skills.split(',').map(s => s.trim()).filter(Boolean);
                return `
                    <td class="p-5 align-middle">
                        <div class="flex flex-wrap gap-1.5">
                            ${skArray.map(s => `
                                <span class="px-2.5 py-1 text-[11px] font-medium rounded-lg bg-white/5 border border-white/10 text-slate-300">
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
                    <a href="${item.url}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 hover:scale-105 transition-all shadow-md shadow-cyan-500/20">
                        <span class="font-black">View Full Roadmap</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </td>
            `).join('')}
        </tr>
    `;
}

// ── On DOM ready: passport tilt + counters + initial arc animation via IntersectionObserver + career-bar reveal
document.addEventListener('DOMContentLoaded', () => {

    // 3D Passport tilt
    const card = document.getElementById('passportCard');
    if (card) {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const rX = ((e.clientY - r.top  - r.height/2) / (r.height/2)) * -12;
            const rY = ((e.clientX - r.left - r.width /2) / (r.width /2)) *  12;
            card.style.transform = `rotateX(${rX.toFixed(2)}deg) rotateY(${rY.toFixed(2)}deg) scale3d(1.03,1.03,1.03)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'rotateX(0deg) rotateY(0deg) scale3d(1,1,1)';
        });
    }

    // Hero stat counters
    document.querySelectorAll('.counter-number').forEach(counter => {
        const target = +counter.getAttribute('data-target');
        let cur = 0; const inc = target / 60;
        const timer = setInterval(() => {
            cur += inc;
            if (cur >= target) { counter.innerText = target; clearInterval(timer); }
            else { counter.innerText = Math.floor(cur); }
        }, 20);
    });

    // Animate AI arcs when the section scrolls into view
    const advisorSection = document.getElementById('aiAdvisorOutput');
    if (advisorSection && 'IntersectionObserver' in window) {
        const obs = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    applyTrackData(aiTracks['fullstack']);
                    obs.disconnect();
                }
            });
        }, { threshold: 0.3 });
        obs.observe(advisorSection);
    } else if (advisorSection) {
        // Fallback: animate immediately
        applyTrackData(aiTracks['fullstack']);
    }

    // Interactive Career Bar Reveal on Scroll
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
