<!-- ══════════════════ FLOATING GLASS PILL NAVBAR COMPONENT ══════════════════ -->
<header x-data="{ mobileMenuOpen: false }" class="fixed top-5 left-1/2 -translate-x-1/2 w-[96%] max-w-[85rem] z-50">
    <nav class="max-w-[85rem] mx-auto py-3.5 md:py-4 px-4 sm:px-6 md:px-8 bg-white/30 dark:bg-slate-950/80 backdrop-blur-2xl border border-slate-200/50 dark:border-white/10 rounded-full flex items-center justify-between gap-3 md:gap-4 shadow-lg dark:shadow-2xl relative transition-all duration-300">
        
        <!-- Ambient Internal Glows -->
        <div class="absolute -top-12 -left-12 w-36 h-36 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -right-12 w-36 h-36 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-2xl pointer-events-none"></div>

        <!-- Logo & Brand Emblem -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-2.5 group shrink-0 flex-shrink-0 relative z-10">
            <div class="relative flex-shrink-0">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-sm sm:text-base shadow-neon-purple group-hover:scale-110 group-hover:shadow-neon-pink transition-all duration-300">
                    <i class="fa-solid fa-compass text-white text-sm sm:text-base"></i>
                </div>
                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-md opacity-40 group-hover:opacity-80 transition-opacity -z-10"></div>
            </div>
            <div class="hidden sm:flex items-center gap-1.5 sm:gap-2 flex-shrink-0">
                <span class="text-lg sm:text-xl font-black tracking-tight text-slate-900 dark:text-white font-display">PathSeeker</span>
                <span class="px-2 py-0.5 text-[9px] sm:text-[10px] font-black uppercase tracking-widest bg-purple-500/15 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 rounded-full border border-purple-500/25 dark:border-purple-500/30">Passport</span>
            </div>
        </a>

        <!-- Desktop Pill Nav Links with Glowing Active Dot -->
        <div class="hidden md:flex items-center gap-0.5 lg:gap-1 px-3 lg:px-3.5 py-1.5 bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl rounded-full border border-slate-200 dark:border-white/10 shrink-0 flex-shrink-0 relative z-10 shadow-sm">
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

        <!-- Right Actions: Theme Toggle, Notifications, User Auth & Sign Out, Mobile Toggle -->
        <div class="flex items-center gap-2 sm:gap-2.5 shrink-0 flex-shrink-0 relative z-10">

            <!-- Theme Toggle -->
            <button id="themeToggle" onclick="toggleTheme()" title="Toggle Light/Dark Mode" aria-label="Toggle light or dark theme"
                class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white hover:border-purple-500/40 transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                <i id="themeIcon" class="fa-solid fa-moon text-xs sm:text-sm"></i>
            </button>

            @auth
                @php
                    $firstName = explode(' ', trim(Auth::user()->name))[0];
                    $isAdmin = Auth::user()->role === 'admin' || Auth::user()->email === 'admin@pathseeker.com';
                @endphp

                <!-- Live Notification Center Dropdown (Real-Time Reactive) -->
                <div x-data="{
                        notifOpen: false,
                        unreadCount: 0,
                        notifications: [],
                        init() {
                            this.fetchNotifs();
                            setInterval(() => { this.fetchNotifs(); }, 45000);
                        },
                        toggle() {
                            this.notifOpen = !this.notifOpen;
                            if (this.notifOpen) {
                                this.fetchNotifs();
                            }
                        },
                        fetchNotifs() {
                            fetch('/api/notifications', {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']')?.getAttribute('content') || ''
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.unreadCount = data.unread_count || 0;
                                this.notifications = data.notifications || [];
                            })
                            .catch(() => {});
                        },
                        markAsRead(id) {
                            fetch(`/api/notifications/${id}/read`, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']')?.getAttribute('content') || ''
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.unreadCount = data.unread_count || 0;
                                const target = this.notifications.find(n => n.id === id);
                                if (target) target.read = true;
                            })
                            .catch(() => {});
                        },
                        markAllAsRead() {
                            fetch('/api/notifications/read-all', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']')?.getAttribute('content') || ''
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.unreadCount = 0;
                                this.notifications.forEach(n => n.read = true);
                            })
                            .catch(() => {});
                        }
                    }" 
                    class="relative shrink-0 flex-shrink-0">
                    
                    <button type="button" 
                            @click="toggle()"
                            title="Notifications" 
                            aria-label="View notifications"
                            class="relative w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white hover:border-purple-500/40 transition-all shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <i class="fa-solid fa-bell text-xs sm:text-sm"></i>
                        <span x-show="unreadCount > 0"
                              x-text="unreadCount"
                              style="display: none;"
                              class="absolute -top-1 -right-1 px-1.5 py-0.5 min-w-[18px] text-[9px] font-black font-mono text-white bg-gradient-to-r from-rose-500 to-pink-600 rounded-full border border-white dark:border-slate-900 shadow-md animate-pulse text-center">
                        </span>
                    </button>

                    <!-- Notifications Dropdown Panel -->
                    <div x-show="notifOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         @click.outside="notifOpen = false"
                         style="display: none;"
                         class="absolute right-0 mt-3 w-80 sm:w-96 rounded-3xl bg-white/95 dark:bg-slate-950/95 backdrop-blur-2xl border border-slate-200 dark:border-white/10 shadow-2xl overflow-hidden z-50">
                        
                        <div class="px-5 py-4 border-b border-slate-200/80 dark:border-white/10 flex items-center justify-between bg-slate-50/80 dark:bg-white/[0.02]">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-bell text-purple-500 text-xs"></i>
                                <span class="text-xs font-black text-slate-900 dark:text-white font-display">Live Notifications</span>
                                <span x-show="unreadCount > 0" class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-purple-500/15 text-purple-600 dark:text-purple-300" x-text="unreadCount + ' new'"></span>
                            </div>
                            <button type="button" @click="markAllAsRead()" x-show="unreadCount > 0" class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 hover:underline cursor-pointer">
                                Mark all read
                            </button>
                        </div>

                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100 dark:divide-white/5 scrollbar-thin">
                            <template x-if="notifications.length === 0">
                                <div class="p-8 text-center text-xs text-slate-400 space-y-1">
                                    <i class="fa-regular fa-bell-slash text-base text-slate-300 dark:text-slate-600"></i>
                                    <p>No notifications yet</p>
                                </div>
                            </template>

                            <template x-for="item in notifications" :key="item.id">
                                <div class="p-3.5 hover:bg-slate-50 dark:hover:bg-white/[0.03] transition-colors flex items-start gap-3 relative" :class="{'bg-purple-50/50 dark:bg-purple-950/20': !item.read}">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-purple-500/20 to-indigo-500/20 border border-purple-500/30 flex items-center justify-center text-purple-600 dark:text-purple-400 text-xs shrink-0 mt-0.5">
                                        <i :class="item.icon || 'fa-solid fa-bell'"></i>
                                    </div>
                                    <div class="flex-1 min-w-0 space-y-1">
                                        <div class="flex items-center justify-between gap-1">
                                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate" x-text="item.title"></h4>
                                            <span class="text-[9px] text-slate-400 font-mono shrink-0" x-text="item.time_ago"></span>
                                        </div>
                                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-snug line-clamp-2" x-text="item.message"></p>
                                        <div class="pt-1 flex items-center justify-between">
                                            <a :href="item.action_url" @click="markAsRead(item.id)" class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1">
                                                <span>Open</span>
                                                <i class="fa-solid fa-arrow-up-right-from-square text-[8px]"></i>
                                            </a>
                                            <button type="button" x-show="!item.read" @click="markAsRead(item.id)" class="text-[9px] text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer">
                                                Mark read
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                
                <!-- User Profile Badge -->
                <div class="hidden sm:flex items-center gap-2 px-3 py-2 bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl rounded-full border border-slate-200 dark:border-white/10 shrink-0 flex-shrink-0 shadow-sm">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-[11px] shrink-0 shadow-sm">
                        {{ substr($firstName, 0, 1) }}
                    </div>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200 truncate max-w-[90px]">{{ $firstName }}</span>
                    <span class="hidden lg:inline-block text-[9px] font-black uppercase px-2 py-0.5 {{ $isAdmin ? 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25' : 'bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25' }} rounded-full shrink-0">
                        {{ Auth::user()->role }}
                    </span>
                </div>

                <!-- Conditional Passport vs Admin Panel Button -->
                <a href="{{ route('dashboard') }}" class="btn-sweep inline-flex items-center gap-2 px-4 sm:px-6 py-2.5 text-xs sm:text-sm font-bold rounded-full text-white bg-gradient-to-r {{ $isAdmin ? 'from-purple-600 via-indigo-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 shadow-neon-purple' : 'from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple' }} hover:shadow-neon-pink transition-all duration-300 hover:-translate-y-0.5 shrink-0 flex-shrink-0 whitespace-nowrap">
                    <i class="fa-solid {{ $isAdmin ? 'fa-screwdriver-wrench' : 'fa-gauge-high' }} text-xs text-white"></i>
                    <span class="text-white">{{ $isAdmin ? 'Admin Panel' : 'Passport' }}</span>
                </a>

                <!-- Dedicated Sleek Logout Button -->
                <form action="{{ url('/logout') }}" method="POST" class="inline shrink-0 flex-shrink-0 m-0 p-0">
                    @csrf
                    <button type="submit"
                        title="Sign Out of Account"
                        aria-label="Sign out"
                        class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-rose-500/10 dark:hover:bg-rose-500/15 hover:text-rose-600 dark:hover:text-rose-400 hover:border-rose-500/40 transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer group focus:outline-none focus:ring-2 focus:ring-rose-500">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs sm:text-sm text-slate-700 dark:text-slate-300 group-hover:text-rose-500 transition-colors"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white transition-colors hidden sm:inline-flex items-center gap-1.5 shrink-0 flex-shrink-0">
                    <span>Sign In</span>
                </a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-medium px-5 sm:px-6 py-2.5 rounded-full shadow-lg shadow-purple-500/25 transition-all duration-300 inline-flex items-center gap-2 text-xs sm:text-sm shrink-0 flex-shrink-0 whitespace-nowrap">
                    <span>Get Started</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            @endauth

            <!-- Mobile Hamburger Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button"
                    title="Toggle Navigation Menu"
                    class="md:hidden w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer">
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

        @auth
            <div class="pt-3 mt-1 border-t border-slate-200 dark:border-white/10 flex items-center justify-between gap-3">
                <a href="{{ route('dashboard') }}" class="flex-1 py-2.5 px-4 rounded-xl text-center font-bold text-xs text-white bg-gradient-to-r {{ $isAdmin ? 'from-purple-600 to-indigo-600' : 'from-indigo-600 to-pink-600' }} shadow-md">
                    <i class="fa-solid {{ $isAdmin ? 'fa-screwdriver-wrench' : 'fa-gauge-high' }} mr-1"></i>
                    <span>{{ $isAdmin ? 'Admin Control Panel' : 'My Passport Dashboard' }}</span>
                </a>
                <form action="{{ url('/logout') }}" method="POST" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 font-bold text-xs border border-rose-500/20">
                        Sign Out
                    </button>
                </form>
            </div>
        @else
            <div class="pt-3 mt-1 border-t border-slate-200 dark:border-white/10 flex items-center gap-2">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-800 dark:text-slate-200 font-bold text-xs">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold text-xs shadow-md">
                    Get Started
                </a>
            </div>
        @endauth
    </div>
</header>