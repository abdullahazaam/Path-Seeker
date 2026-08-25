@extends('layouts.app')
@section('title', 'Sign In — PathSeeker')
@section('content')

<section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        {{-- ══════════════════ LEFT COLUMN: BRANDING & HIGHLIGHTS ══════════════════ --}}
        <div class="lg:col-span-7 space-y-5 sm:space-y-6 text-center lg:text-left">
            
            {{-- Pill Badge --}}
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full glass-panel border border-purple-500/25 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping shrink-0"></span>
                <span>AI-Powered Career Intelligence System</span>
            </div>

            {{-- Main Hero Headline --}}
            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-[1.1] text-slate-900 dark:text-white font-display">
                    Discover &amp;<br><span class="grad-text">Navigate Your</span><br>Future Career
                </h1>
                <p class="max-w-xl mx-auto lg:mx-0 text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed font-normal">
                    Sign in to your centralized career operating system. Track your competency roadmap, stream verified masterclasses, and explore 15+ high-growth tech engineering pathways.
                </p>
            </div>

            {{-- Feature Highlight Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1 text-left">
                <div class="p-3.5 rounded-2xl bg-white/80 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-sm hover:border-purple-500/30 transition-all backdrop-blur-xl group">
                    <div class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs mb-2.5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-compass"></i>
                    </div>
                    <h2 class="font-bold text-slate-900 dark:text-white text-xs font-display">15+ Tech Tracks</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">Complete role blueprints with salary &amp; skills telemetry.</p>
                </div>

                <div class="p-3.5 rounded-2xl bg-white/80 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-sm hover:border-purple-500/30 transition-all backdrop-blur-xl group">
                    <div class="w-8 h-8 rounded-xl bg-pink-500/15 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs mb-2.5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h2 class="font-bold text-slate-900 dark:text-white text-xs font-display">Cognitive Quiz</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">Multi-dimensional strength assessment and role matching.</p>
                </div>

                <div class="p-3.5 rounded-2xl bg-white/80 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-sm hover:border-purple-500/30 transition-all backdrop-blur-xl group">
                    <div class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs mb-2.5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <h2 class="font-bold text-slate-900 dark:text-white text-xs font-display">Resource Library</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">Curated architecture blueprints &amp; interview checklists.</p>
                </div>
            </div>

            {{-- Metric Counters --}}
            <div class="flex items-center justify-center lg:justify-start gap-6 sm:gap-8 pt-3 border-t border-slate-200/80 dark:border-white/10">
                <div class="text-center lg:text-left">
                    <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display leading-none">15<span class="text-purple-500">+</span></div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Tech Domains</div>
                </div>
                <div class="w-px h-6 bg-slate-200 dark:bg-white/10"></div>
                <div class="text-center lg:text-left">
                    <div class="text-xl sm:text-2xl font-black text-purple-600 dark:text-purple-400 font-display leading-none">100<span class="text-purple-500">+</span></div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Verified Skills</div>
                </div>
                <div class="w-px h-6 bg-slate-200 dark:bg-white/10"></div>
                <div class="text-center lg:text-left">
                    <div class="text-xl sm:text-2xl font-black text-pink-600 dark:text-pink-400 font-display leading-none">98<span class="text-pink-500">%</span></div>
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">Match Precision</div>
                </div>
            </div>

        </div>

        {{-- ══════════════════ RIGHT COLUMN: AUTHENTICATION FORM CARD ══════════════════ --}}
        <div class="lg:col-span-5 flex justify-center">
            <div class="relative w-full max-w-md bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] rounded-3xl p-6 sm:p-8 overflow-hidden">
                
                {{-- Ambient Corner Glows --}}
                <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-purple-500/15 dark:bg-purple-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 space-y-5">
                    
                    {{-- Header Section with Brand Emblem --}}
                    <div class="flex items-center justify-between pb-1">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white text-sm shadow-md shrink-0">
                                <i class="fa-solid fa-right-to-bracket text-white"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-purple-600 dark:text-purple-400 uppercase font-mono tracking-wider">Access Passport</div>
                                <h2 class="text-base sm:text-lg font-black text-slate-900 dark:text-white font-display leading-tight">Welcome Back</h2>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/30 flex items-center gap-1.5 shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Secure SSL</span>
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

                    {{-- Login Form --}}
                    <form action="{{ url('/login') }}" method="POST" class="space-y-3.5">
                        @csrf
                        
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-envelope text-indigo-500 text-xs"></i>
                                <span>Email Address</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                   placeholder="you@example.com"
                                   class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center gap-1.5">
                                    <i class="fa-solid fa-lock text-purple-500 text-xs"></i>
                                    <span>Password</span>
                                </label>
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition-colors">
                                    Forgot Password?
                                </a>
                            </div>
                            <input type="password" name="password" id="password" required
                                   placeholder="••••••••"
                                   class="app-input w-full px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-500/30">
                        </div>

                        <div class="flex items-center justify-between text-xs pt-0.5">
                            <label class="flex items-center gap-2 text-slate-600 dark:text-slate-400 cursor-pointer select-none">
                                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-purple-600 focus:ring-purple-500">
                                <span>Remember this session</span>
                            </label>
                        </div>

                        <button type="submit" class="btn-sweep group w-full py-3 rounded-full font-black text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-md hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2 hover:scale-[1.02] cursor-pointer">
                            <i class="fa-solid fa-right-to-bracket text-xs text-white"></i>
                            <span class="text-white font-black">Sign In to Passport</span>
                            <i class="fa-solid fa-arrow-right text-xs text-white group-hover:translate-x-1.5 transition-transform"></i>
                        </button>
                    </form>

                    {{-- Footer Link --}}
                    <div class="pt-3 border-t border-slate-200/80 dark:border-white/10 text-center text-xs text-slate-600 dark:text-slate-400">
                        Don't have an account yet?
                        <a href="{{ route('register') }}" class="font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition-colors ml-1 inline-flex items-center gap-1">
                            <span>Create Passport</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection