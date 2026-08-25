<!-- ══════════════════ STRUCTURED SLATE FOOTER COMPONENT ══════════════════ -->
<footer class="relative z-10 mt-16 border-t border-white/[0.08] dark:border-white/[0.06] bg-[#050507] text-slate-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        {{-- Newsletter Subscription Banner --}}
        <div class="mb-12 pb-10 border-b border-white/[0.08] flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-1.5 max-w-lg">
                <div class="inline-flex items-center gap-2 text-xs font-bold text-purple-400 uppercase tracking-wider font-mono">
                    <i class="fa-solid fa-envelope-open-text text-purple-400"></i>
                    <span>Career Intelligence Feed</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-white font-display">Subscribe to Career Insights</h3>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                    Get curated tech salary benchmarks, emerging domain competencies, and blueprint updates delivered to your inbox.
                </p>
            </div>

            {{-- Sleek Subscription Input Form --}}
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex items-center gap-2 w-full lg:w-auto">
                @csrf
                <div class="relative w-full sm:w-80">
                    <input type="email"
                           name="email"
                           required
                           placeholder="Enter your email..."
                           class="bg-slate-900/80 border border-white/15 rounded-full pl-10 pr-4 py-3 text-xs sm:text-sm text-white placeholder-slate-500 w-full focus:outline-none focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/20 backdrop-blur-xl shadow-inner">
                    <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
                <button type="submit"
                        class="px-5 sm:px-6 py-3 rounded-full bg-gradient-to-r from-purple-600 via-indigo-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-bold text-xs sm:text-sm transition-all shadow-md hover:shadow-purple-500/25 shrink-0 flex items-center gap-1.5 cursor-pointer">
                    <span>Join Feed</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </button>
            </form>
        </div>

        {{-- 4 Column Footer Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            
            <!-- Brand Description -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-sm shadow-md">
                        <i class="fa-solid fa-compass text-white"></i>
                    </div>
                    <span class="text-xl font-black text-white tracking-tight font-display">PathSeeker</span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                    The role-based career exploration passport. Empowering students, graduates, and working professionals with data-driven career maps, skills analysis, and learning toolkits.
                </p>
                <div class="flex items-center gap-3 pt-2 text-slate-400">
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:text-white hover:border-purple-500/40 transition-colors" title="GitHub"><i class="fa-brands fa-github text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:text-white hover:border-purple-500/40 transition-colors" title="LinkedIn"><i class="fa-brands fa-linkedin text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:text-white hover:border-purple-500/40 transition-colors" title="Twitter"><i class="fa-brands fa-x-twitter text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:text-white hover:border-purple-500/40 transition-colors" title="Discord"><i class="fa-brands fa-discord text-sm"></i></a>
                </div>
            </div>

            <!-- Column: Platform Navigation -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-200">Platform</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition-colors">Home Portal</a></li>
                    <li><a href="{{ route('careers.index') }}" class="hover:text-indigo-400 transition-colors">Career Bank</a></li>
                    <li><a href="{{ route('quiz.index') }}" class="hover:text-indigo-400 transition-colors">Interest Quiz</a></li>
                    <li><a href="{{ route('stories.index') }}" class="hover:text-indigo-400 transition-colors">Success Stories</a></li>
                    <li><a href="{{ route('multimedia.index') }}" class="hover:text-indigo-400 transition-colors">Multimedia Hub</a></li>
                    <li><a href="{{ route('resources.index') }}" class="hover:text-indigo-400 transition-colors">Resource Library</a></li>
                    <li><a href="{{ route('feedback.index') }}" class="hover:text-indigo-400 transition-colors">User Feedback</a></li>
                </ul>
            </div>

            <!-- Column: Toolkits -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-200">Toolkits</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('resources.index') }}" class="hover:text-indigo-400 transition-colors">Resume Blueprints</a></li>
                    <li><a href="{{ route('resources.index') }}" class="hover:text-indigo-400 transition-colors">System Design Sheets</a></li>
                    <li><a href="{{ route('resources.index') }}" class="hover:text-indigo-400 transition-colors">Skill Roadmaps</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-indigo-400 transition-colors">Career Passport</a></li>
                </ul>
            </div>

            <!-- Column: Standards -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-200">Standards</h4>
                <ul class="space-y-2 text-sm">
                    <li><span class="text-xs text-slate-400">Tech: Laravel 12 + Tailwind</span></li>
                    <li><span class="text-xs text-slate-400">Database: MySQL InnoDB</span></li>
                    <li><span class="text-xs text-slate-400">Theme: 2026 Living OS</span></li>
                    <li><span class="text-xs text-slate-400">Global Competition Ready</span></li>
                </ul>
            </div>

        </div>

        <!-- Bottom Copyright Bar -->
        <div class="mt-12 pt-8 border-t border-white/[0.06] flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} PathSeeker Career Passport. Built for global full-stack excellence.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('sitemap') }}" target="_blank" class="hover:text-indigo-400 font-mono transition-colors">XML Sitemap</a>
                <span>&bull;</span>
                <span>Privacy Policy</span>
                <span>&bull;</span>
                <span>Terms of Service</span>
                <span>&bull;</span>
                <span class="text-emerald-500 font-mono flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> System Status: Online</span>
            </div>
        </div>
    </div>
</footer>