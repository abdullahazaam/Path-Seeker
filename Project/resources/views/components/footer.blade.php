<!-- ══════════════════ STRUCTURED SLATE FOOTER COMPONENT ══════════════════ -->
<footer id="globalFooter" class="relative z-10 w-full shrink-0 mt-16 border-t border-slate-200/80 dark:border-white/[0.06] bg-white/90 dark:bg-[#050507] text-slate-600 dark:text-slate-400 backdrop-blur-2xl transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        {{-- Newsletter Subscription Banner --}}
        <div class="mb-12 pb-10 border-b border-slate-200 dark:border-white/[0.08] flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-1.5 max-w-lg">
                <div class="inline-flex items-center gap-2 text-xs font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider font-mono">
                    <i class="fa-solid fa-envelope-open-text text-cyan-600 dark:text-cyan-400"></i>
                    <span>Career Intelligence Feed</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display">Subscribe to Career Insights</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
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
                           class="bg-slate-50 dark:bg-slate-900/80 border border-slate-300 dark:border-white/15 rounded-full pl-10 pr-4 py-3 text-xs sm:text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 w-full focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 backdrop-blur-xl shadow-inner">
                    <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
                <button type="submit"
                        class="px-5 sm:px-6 py-3 rounded-full bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 font-black text-xs sm:text-sm transition-all shadow-md shadow-cyan-500/25 hover:shadow-cyan-500/40 shrink-0 flex items-center gap-1.5 cursor-pointer">
                    <span>Join Feed</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </button>
            </form>
        </div>

        {{-- 4 Column Consumer Product Footer Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            
            <!-- Brand Description -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#00f2fe] via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 font-black text-sm shadow-md">
                        <i class="fa-solid fa-compass text-slate-950"></i>
                    </div>
                    <span class="text-xl font-black text-slate-900 dark:text-white tracking-tight font-display">PathSeeker</span>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed max-w-sm">
                    The role-based career exploration passport. Empowering students, graduates, and working professionals with data-driven career maps, skills analysis, and learning toolkits.
                </p>
                <div class="flex items-center gap-3 pt-2 text-slate-500 dark:text-slate-400">
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:border-cyan-500/40 transition-colors" title="GitHub"><i class="fa-brands fa-github text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:border-cyan-500/40 transition-colors" title="LinkedIn"><i class="fa-brands fa-linkedin text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:border-cyan-500/40 transition-colors" title="Twitter"><i class="fa-brands fa-x-twitter text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:border-cyan-500/40 transition-colors" title="Discord"><i class="fa-brands fa-discord text-sm"></i></a>
                </div>
            </div>

            <!-- Column: Explore Platform -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-slate-200 font-mono">Explore</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home Portal</a></li>
                    <li><a href="{{ route('careers.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Career Bank</a></li>
                    <li><a href="{{ route('quiz.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Interest Quiz</a></li>
                    <li><a href="{{ route('stories.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Success Stories</a></li>
                    <li><a href="{{ route('multimedia.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Multimedia Hub</a></li>
                </ul>
            </div>

            <!-- Column: Toolkits & Growth -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-slate-200 font-mono">Toolkits</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('resources.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Resume Blueprints</a></li>
                    <li><a href="{{ route('resources.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">System Design Sheets</a></li>
                    <li><a href="{{ route('resources.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Skill Roadmaps</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Career Passport</a></li>
                </ul>
            </div>

            <!-- Column: Community & Support -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-slate-200 font-mono">Community</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('feedback.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">User Feedback</a></li>
                    <li><a href="{{ route('stories.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Share Your Story</a></li>
                    <li><a href="{{ route('resources.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Resource Library</a></li>
                    <li><a href="{{ route('sitemap.visual') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Visual Sitemap</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom Copyright Bar -->
        <div class="mt-12 pt-8 border-t border-slate-200 dark:border-white/[0.06] flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-slate-500">
            <p>&copy; {{ date('Y') }} PathSeeker. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('sitemap') }}" target="_blank" class="hover:text-cyan-600 dark:hover:text-cyan-400 font-mono transition-colors">XML Sitemap</a>
                <span>&bull;</span>
                <span>Privacy Policy</span>
                <span>&bull;</span>
                <span>Terms of Service</span>
                <span>&bull;</span>
                <span class="text-emerald-600 dark:text-emerald-500 font-mono flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Systems Operational</span>
            </div>
        </div>
    </div>
</footer>