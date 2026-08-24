<!-- ══════════════════ FLOATING GLASS PILL NAVBAR COMPONENT ══════════════════ -->
<header x-data="{ mobileMenuOpen: false }" class="fixed top-5 left-1/2 -translate-x-1/2 w-[96%] max-w-7xl z-50">
    <nav class="max-w-7xl mx-auto py-3.5 md:py-4 px-4 sm:px-6 md:px-8 bg-white/30 dark:bg-slate-950/80 backdrop-blur-2xl border border-slate-200/50 dark:border-white/10 rounded-full flex items-center justify-between gap-2 md:gap-4 shadow-lg dark:shadow-2xl relative overflow-hidden transition-all duration-300">
        
        <!-- Ambient Internal Glows -->
        <div class="absolute -top-12 -left-12 w-36 h-36 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -right-12 w-36 h-36 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-2xl pointer-events-none"></div>

        <!-- Logo & Brand Emblem -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-2.5 group shrink-0 flex-shrink-0 relative z-10">
            <div class="relative">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-sm sm:text-base shadow-neon-purple group-hover:scale-110 group-hover:shadow-neon-pink transition-all duration-300">
                    <i class="fa-solid fa-compass text-white text-sm sm:text-base"></i>
                </div>
                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-md opacity-40 group-hover:opacity-80 transition-opacity -z-10"></div>
            </div>
            <div class="hidden sm:flex items-center gap-1.5 sm:gap-2">
                <span class="text-lg sm:text-xl font-black tracking-tight text-slate-900 dark:text-white font-display">PathSeeker</span>
                <span class="px-2 py-0.5 text-[9px] sm:text-[10px] font-black uppercase tracking-widest bg-purple-500/15 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 rounded-full border border-purple-500/25 dark:border-purple-500/30">Passport</span>
            </div>
        </a>

        <!-- Desktop Pill Nav Links with Glowing Active Dot -->
        <div class="hidden md:flex items-center gap-0.5 lg:gap-1 px-2.5 lg:px-3 py-1.5 bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl rounded-full border border-slate-200 dark:border-white/10 shrink-0 flex-shrink-0 relative z-10 shadow-sm">
            <a href="{{ route('home') }}" class="relative px-3 lg:px-3.5 py-1.5 rounded-full text-xs lg:text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Home</span>
            </a>
            <a href="{{ route('careers.index') }}" class="relative px-3 lg:px-3.5 py-1.5 rounded-full text-xs lg:text-sm font-semibold transition-all {{ request()->routeIs('careers.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Career Bank</span>
            </a>
            <a href="{{ route('quiz.index') }}" class="relative px-3 lg:px-3.5 py-1.5 rounded-full text-xs lg:text-sm font-semibold transition-all {{ request()->routeIs('quiz.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Interest Quiz</span>
            </a>
            <a href="{{ route('multimedia.index') }}" class="relative px-3 lg:px-3.5 py-1.5 rounded-full text-xs lg:text-sm font-semibold transition-all {{ request()->routeIs('multimedia.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Multimedia</span>
            </a>
            <a href="{{ route('resources.index') }}" class="relative px-3 lg:px-3.5 py-1.5 rounded-full text-xs lg:text-sm font-semibold transition-all {{ request()->routeIs('resources.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Resources</span>
            </a>
        </div>

        <!-- Right Actions: Theme Toggle, User Auth Section & Mobile Hamburger Toggle -->
        <div class="flex items-center gap-2 sm:gap-2.5 shrink-0 flex-shrink-0 relative z-10">
            <!-- Theme Toggle -->
            <button id="themeToggle" onclick="toggleTheme()" title="Toggle Light/Dark Mode"
                class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white hover:border-purple-500/40 transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer">
                <i id="themeIcon" class="fa-solid fa-moon text-xs sm:text-sm"></i>
            </button>

            @auth
                @php
                    $firstName = explode(' ', trim(Auth::user()->name))[0];
                @endphp
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl rounded-full border border-slate-200 dark:border-white/10 shrink-0 flex-shrink-0 shadow-sm">
                    <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-[10px] sm:text-[11px] shrink-0 shadow-sm">
                        {{ substr($firstName, 0, 1) }}
                    </div>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200 truncate max-w-[90px]">{{ $firstName }}</span>
                    <span class="hidden lg:inline-block text-[9px] font-black uppercase px-2 py-0.5 bg-purple-500/15 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 rounded-full border border-purple-500/25 dark:border-purple-500/30 shrink-0">{{ Auth::user()->role }}</span>
                </div>

                <a href="{{ route('dashboard') }}" class="btn-sweep inline-flex items-center gap-1.5 sm:gap-2 px-4 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-bold rounded-full text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple hover:shadow-neon-pink transition-all duration-300 hover:-translate-y-0.5 shrink-0 flex-shrink-0 whitespace-nowrap">
                    <i class="fa-solid fa-gauge-high text-[11px] sm:text-xs text-white"></i>
                    <span class="text-white">Passport</span>
                </a>

                <!-- Round Circular Sign Out Button Matching Theme Toggle -->
                <form action="{{ route('logout') }}" method="POST" class="inline shrink-0 flex-shrink-0 m-0 p-0">
                    @csrf
                    <button type="submit"
                        title="Sign Out"
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-rose-600 dark:hover:text-rose-400 hover:border-rose-500/40 transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer group">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs sm:text-sm text-slate-700 dark:text-slate-300 group-hover:text-rose-500 transition-colors"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white transition-colors hidden sm:inline-flex items-center gap-1.5 shrink-0 flex-shrink-0">
                    <span>Sign In</span>
                </a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-medium px-4 sm:px-5 py-2 sm:py-2.5 rounded-full shadow-lg shadow-purple-500/25 transition-all duration-300 inline-flex items-center gap-1.5 sm:gap-2 text-xs sm:text-sm shrink-0 flex-shrink-0 whitespace-nowrap">
                    <span>Get Started</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            @endauth

            <!-- Mobile Hamburger Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button"
                    title="Toggle Navigation Menu"
                    class="md:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer">
                <i :class="mobileMenuOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'" class="text-sm"></i>
            </button>
        </div>

    </nav>

    <!-- Mobile Navigation Dropdown Drawer -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
         @click.outside="mobileMenuOpen = false"
         style="display: none;"
         class="mt-3 p-4 bg-white/95 dark:bg-slate-950/95 backdrop-blur-2xl border border-slate-200 dark:border-white/10 rounded-3xl shadow-2xl flex flex-col gap-1.5 md:hidden z-50 overflow-hidden">
        
        <a href="{{ route('home') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('home') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-house text-xs text-indigo-500"></i>
                <span>Home</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        <a href="{{ route('careers.index') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('careers.*') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-compass text-xs text-purple-500"></i>
                <span>Career Bank</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        <a href="{{ route('quiz.index') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('quiz.*') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-brain text-xs text-pink-500"></i>
                <span>Interest Quiz</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        <a href="{{ route('multimedia.index') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('multimedia.*') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-video text-xs text-sky-500"></i>
                <span>Multimedia</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        <a href="{{ route('resources.index') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('resources.*') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-folder-open text-xs text-emerald-500"></i>
                <span>Resource Toolkits</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        @guest
            <div class="pt-3 mt-1 border-t border-slate-200 dark:border-white/10 flex items-center gap-2">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-800 dark:text-slate-200 font-bold text-xs">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold text-xs shadow-md">
                    Get Started
                </a>
            </div>
        @endguest
    </div>
</header>