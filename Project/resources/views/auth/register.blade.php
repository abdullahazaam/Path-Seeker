@extends('layouts.app')
@section('title', 'Create Passport — PathSeeker')
@section('content')

<section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        {{-- ══════════════════ LEFT COLUMN: BRANDING & VALUE PROPOSITION ══════════════════ --}}
        <div class="lg:col-span-6 space-y-5 sm:space-y-6 text-center lg:text-left">
            
            {{-- Pill Badge --}}
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full glass-panel border border-purple-500/25 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping shrink-0"></span>
                <span>Fast-Track Your Tech Trajectory</span>
            </div>

            {{-- Main Hero Headline --}}
            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-[1.1] text-slate-900 dark:text-white font-display">
                    Build Your<br><span class="grad-text">Digital Career</span><br>Passport Today
                </h1>
                <p class="max-w-xl mx-auto lg:mx-0 text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed font-normal">
                    Join thousands of developers, architects, and researchers discovering high-growth engineering domains, verified compensation benchmarks, and structured milestone roadmaps.
                </p>
            </div>

            {{-- Feature Highlight Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1 text-left">
                <div class="p-3.5 rounded-2xl bg-white/80 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-sm hover:border-purple-500/30 transition-all backdrop-blur-xl group">
                    <div class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs mb-2.5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-id-badge"></i>
                    </div>
                    <h2 class="font-bold text-slate-900 dark:text-white text-xs font-display">Role Customization</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">Tailored dashboard for Students, Graduates, or Pros.</p>
                </div>

                <div class="p-3.5 rounded-2xl bg-white/80 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-sm hover:border-purple-500/30 transition-all backdrop-blur-xl group">
                    <div class="w-8 h-8 rounded-xl bg-pink-500/15 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs mb-2.5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h2 class="font-bold text-slate-900 dark:text-white text-xs font-display">Living Roadmap</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">Interactive 5-stage career milestones and tracking.</p>
                </div>

                <div class="p-3.5 rounded-2xl bg-white/80 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-sm hover:border-purple-500/30 transition-all backdrop-blur-xl group">
                    <div class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs mb-2.5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h2 class="font-bold text-slate-900 dark:text-white text-xs font-display">Verified Toolkits</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">Instant access to 15+ curated PDF cheatsheets &amp; videos.</p>
                </div>
            </div>

            {{-- Metric Counters --}}
            <div class="flex items-center justify-center lg:justify-start gap-6 sm:gap-8 pt-3 border-t border-slate-200/80 dark:border-white/10">
                <div class="text-center lg:text-left">
                    <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display leading-none">15<span class="text-purple-500">+</span></div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Tech Domains</div>
                </div>
                <div class="w-px h-6 bg-slate-200 dark:bg-white/10"></div>
                <div class="text-xl sm:text-2xl font-black text-purple-600 dark:text-purple-400 font-display leading-none">100<span class="text-purple-500">+</span></div>
                <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Verified Skills</div>
                <div class="w-px h-6 bg-slate-200 dark:bg-white/10"></div>
                <div class="text-center lg:text-left">
                    <div class="text-xl sm:text-2xl font-black text-pink-600 dark:text-pink-400 font-display leading-none">98<span class="text-pink-500">%</span></div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Match Precision</div>
                </div>
            </div>

        </div>

        {{-- ══════════════════ RIGHT COLUMN: REGISTRATION FORM CARD ══════════════════ --}}
        <div class="lg:col-span-6 flex justify-center">
            <div class="relative w-full max-w-xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] rounded-3xl p-5 sm:p-7 overflow-hidden">
                
                {{-- Ambient Corner Glows --}}
                <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-purple-500/15 dark:bg-purple-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 space-y-4">
                    
                    {{-- Header Section with Brand Emblem --}}
                    <div class="flex items-center justify-between pb-1">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white text-sm shadow-md shrink-0">
                                <i class="fa-solid fa-passport text-white"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-purple-600 dark:text-purple-400 uppercase font-mono tracking-wider">Free Instant Registration</div>
                                <h2 class="text-base sm:text-lg font-black text-slate-900 dark:text-white font-display leading-tight">Create Career Passport</h2>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/30 flex items-center gap-1.5 shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Live Passport</span>
                        </span>
                    </div>

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="p-3 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-700 dark:text-rose-300 text-xs space-y-1">
                            @foreach($errors->all() as $error)
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-xs shrink-0"></i>
                                    <span>{{ $error }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Registration Form --}}
                    <form action="{{ url('/register') }}" method="POST" class="space-y-3">
                        @csrf

                        {{-- First & Last Name Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="first_name" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-user text-indigo-500 text-xs"></i>
                                    <span>First Name</span>
                                </label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                       placeholder="e.g. Alex"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>
                            <div>
                                <label for="last_name" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-user text-indigo-500 text-xs"></i>
                                    <span>Last Name</span>
                                </label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                       placeholder="e.g. Rivera"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>
                        </div>

                        {{-- Email & Role Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-envelope text-indigo-500 text-xs"></i>
                                    <span>Email Address</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                       placeholder="alex@example.com"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>

                            <div>
                                <label for="role" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-id-card-clip text-purple-500 text-xs"></i>
                                    <span>Career Stage</span>
                                </label>
                                <select name="role" id="role" required class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Select Stage --</option>
                                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student (College / Uni)</option>
                                    <option value="graduate" {{ old('role') === 'graduate' ? 'selected' : '' }}>Graduate (Job Seeker)</option>
                                    <option value="professional" {{ old('role') === 'professional' ? 'selected' : '' }}>Working Professional</option>
                                </select>
                            </div>
                        </div>

                        {{-- Password & Confirmation Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-lock text-purple-500 text-xs"></i>
                                    <span>Password</span>
                                </label>
                                <input type="password" name="password" id="password" required
                                       placeholder="••••••••"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-shield-check text-purple-500 text-xs"></i>
                                    <span>Confirm Password</span>
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       placeholder="••••••••"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>
                        </div>

                        {{-- Education & Interests Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="education_level" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-graduation-cap text-sky-500 text-xs"></i>
                                    <span>Education Level</span>
                                </label>
                                <input type="text" name="education_level" id="education_level" value="{{ old('education_level') }}"
                                       placeholder="e.g. B.S. Computer Science"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>

                            <div>
                                <label for="interests" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-heart text-pink-500 text-xs"></i>
                                    <span>Career Focus Areas</span>
                                </label>
                                <input type="text" name="interests" id="interests" value="{{ old('interests') }}"
                                       placeholder="e.g. Full-Stack, Cloud, AI"
                                       class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-1.5">
                            <button type="submit" class="btn-sweep group w-full py-3 rounded-full font-black text-sm text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_20px_rgba(0,242,254,0.35)] transition-all duration-300 flex items-center justify-center gap-2 hover:scale-[1.02] cursor-pointer">
                                <i class="fa-solid fa-passport text-xs text-slate-950"></i>
                                <span class="text-slate-950 font-black">Register &amp; Enter Passport</span>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-950 group-hover:translate-x-1.5 transition-transform"></i>
                            </button>
                        </div>
                    </form>

                    {{-- Footer Link --}}
                    <div class="pt-2.5 border-t border-slate-200/80 dark:border-white/10 text-center text-xs text-slate-600 dark:text-slate-400">
                        Already have a registered passport?
                        <a href="{{ route('login') }}" class="font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition-colors ml-1 inline-flex items-center gap-1">
                            <span>Sign In</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection