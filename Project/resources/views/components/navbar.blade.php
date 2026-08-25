<!-- ══════════════════ FLOATING GLASS PILL NAVBAR COMPONENT ══════════════════ -->
<header x-data="{ mobileMenuOpen: false }" class="fixed top-3 sm:top-5 left-1/2 -translate-x-1/2 w-[96%] max-w-[85rem] z-50">
    <nav class="max-w-[85rem] mx-auto py-2.5 sm:py-3.5 px-3 sm:px-5 lg:px-7 bg-white/40 dark:bg-slate-950/85 backdrop-blur-2xl border border-slate-200/60 dark:border-white/10 rounded-full flex items-center justify-between gap-2 sm:gap-3 lg:gap-4 shadow-lg dark:shadow-2xl relative transition-all duration-300">
        
        <!-- Ambient Internal Glows -->
        <div class="absolute -top-12 -left-12 w-36 h-36 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -right-12 w-36 h-36 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-2xl pointer-events-none"></div>

        <!-- Logo & Brand Emblem -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 group shrink-0 flex-shrink-0 relative z-10">
            <div class="relative flex-shrink-0">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-xs sm:text-base shadow-neon-purple group-hover:scale-110 transition-all duration-300">
                    <i class="fa-solid fa-compass text-white text-xs sm:text-base"></i>
                </div>
                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-md opacity-40 group-hover:opacity-80 transition-opacity -z-10"></div>
            </div>
            <div class="hidden sm:flex items-center gap-1.5 flex-shrink-0">
                <span class="text-base sm:text-lg lg:text-xl font-black tracking-tight text-slate-900 dark:text-white font-display">PathSeeker</span>
                <span class="hidden xl:inline-block px-2 py-0.5 text-[9px] sm:text-[10px] font-black uppercase tracking-wider bg-purple-500/15 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 rounded-full border border-purple-500/25 dark:border-purple-500/30">Passport</span>
            </div>
        </a>

        <!-- Desktop Pill Nav Links with Responsive Breakpoints -->
        <div class="hidden lg:flex items-center gap-0.5 xl:gap-1 px-2.5 xl:px-3.5 py-1 xl:py-1.5 bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl rounded-full border border-slate-200 dark:border-white/10 shrink-0 flex-shrink-0 relative z-10 shadow-sm">
            <a href="{{ route('home') }}" class="relative px-2.5 xl:px-3.5 py-1 xl:py-1.5 rounded-full text-xs xl:text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Home</span>
            </a>
            <a href="{{ route('careers.index') }}" class="relative px-2.5 xl:px-3.5 py-1 xl:py-1.5 rounded-full text-xs xl:text-sm font-semibold transition-all {{ request()->routeIs('careers.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Career Bank</span>
            </a>
            <a href="{{ route('quiz.index') }}" class="relative px-2.5 xl:px-3.5 py-1 xl:py-1.5 rounded-full text-xs xl:text-sm font-semibold transition-all {{ request()->routeIs('quiz.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                <span>Interest Quiz</span>
            </a>

            <!-- Explore Dropdown (Multimedia, Resources, Success Stories) -->
            <div x-data="{ exploreOpen: false }" @click.outside="exploreOpen = false" class="relative">
                <button type="button"
                        @click="exploreOpen = !exploreOpen"
                        class="relative px-2.5 xl:px-3.5 py-1 xl:py-1.5 rounded-full text-xs xl:text-sm font-semibold transition-all flex items-center gap-1.5 cursor-pointer focus:outline-none {{ request()->routeIs('multimedia.*', 'resources.*', 'stories.*') ? 'text-indigo-600 dark:text-indigo-300 font-bold bg-indigo-500/15 border border-indigo-500/30 shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white hover:bg-white/80 dark:hover:bg-slate-800/80' }}">
                    <span>Explore</span>
                    <i :class="exploreOpen ? 'rotate-180 text-purple-600 dark:text-purple-400' : 'text-slate-400 dark:text-slate-500'" class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200"></i>
                </button>

                <!-- Dropdown Menu Glass Panel -->
                <div x-show="exploreOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     style="display: none;"
                     class="absolute left-0 mt-3 w-64 rounded-3xl bg-white/95 dark:bg-slate-950/95 backdrop-blur-2xl border border-slate-200 dark:border-white/10 shadow-2xl overflow-hidden z-50 p-2 space-y-1">
                    
                    <!-- Multimedia Hub -->
                    <a href="{{ route('multimedia.index') }}"
                       @click="exploreOpen = false"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-colors {{ request()->routeIs('multimedia.*') ? 'bg-purple-50 dark:bg-purple-950/30 text-purple-600 dark:text-purple-300' : 'text-slate-700 dark:text-slate-300 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-slate-50 dark:hover:bg-white/[0.03]' }}">
                        <div class="w-8 h-8 rounded-xl bg-purple-500/10 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-photo-film"></i>
                        </div>
                        <div class="space-y-0.5">
                            <div class="font-bold">Multimedia Hub</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 font-normal">Videos, podcasts & media</div>
                        </div>
                    </a>

                    <!-- Resource Library -->
                    <a href="{{ route('resources.index') }}"
                       @click="exploreOpen = false"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-colors {{ request()->routeIs('resources.*') ? 'bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-300' : 'text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-300 hover:bg-slate-50 dark:hover:bg-white/[0.03]' }}">
                        <div class="w-8 h-8 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                        <div class="space-y-0.5">
                            <div class="font-bold">Resource Library</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 font-normal">Blueprints & cheat sheets</div>
                        </div>
                    </a>

                    <!-- Success Stories -->
                    <a href="{{ route('stories.index') }}"
                       @click="exploreOpen = false"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-colors {{ request()->routeIs('stories.*') ? 'bg-pink-50 dark:bg-pink-950/30 text-pink-600 dark:text-pink-300' : 'text-slate-700 dark:text-slate-300 hover:text-pink-600 dark:hover:text-pink-300 hover:bg-slate-50 dark:hover:bg-white/[0.03]' }}">
                        <div class="w-8 h-8 rounded-xl bg-pink-500/10 dark:bg-pink-500/20 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <div class="space-y-0.5">
                            <div class="font-bold">Success Stories</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 font-normal">Real candidate journeys</div>
                        </div>
                    </a>

                </div>
            </div>
        </div>

        <!-- Right Actions: Theme Toggle, Notifications, User Auth & Dropdown, Mobile Toggle -->
        <div class="flex items-center gap-1.5 sm:gap-2 lg:gap-2.5 shrink-0 flex-shrink-0 relative z-10">

            <!-- Theme Toggle -->
            <button id="themeToggle" onclick="toggleTheme()" title="Toggle Light/Dark Mode" aria-label="Toggle light or dark theme"
                class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white hover:border-purple-500/40 transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
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
                            class="relative w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white hover:border-purple-500/40 transition-all shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <i class="fa-solid fa-bell text-xs sm:text-sm"></i>
                        <span x-show="unreadCount > 0"
                              x-text="unreadCount"
                              style="display: none;"
                              class="absolute -top-1 -right-1 px-1.5 py-0.5 min-w-[17px] text-[8px] sm:text-[9px] font-black font-mono text-white bg-gradient-to-r from-rose-500 to-pink-600 rounded-full border border-white dark:border-slate-900 shadow-md animate-pulse text-center">
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
                
                <!-- Conditional Passport vs Admin Panel Button -->
                <a href="{{ route('dashboard') }}" class="btn-sweep inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 xl:px-5 py-2 sm:py-2.5 text-xs xl:text-sm font-bold rounded-full text-white bg-gradient-to-r {{ $isAdmin ? 'from-purple-600 via-indigo-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 shadow-neon-purple' : 'from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple' }} hover:shadow-neon-pink transition-all duration-300 hover:-translate-y-0.5 shrink-0 flex-shrink-0 whitespace-nowrap">
                    <i class="fa-solid {{ $isAdmin ? 'fa-screwdriver-wrench' : 'fa-gauge-high' }} text-xs text-white"></i>
                    <span class="text-white hidden sm:inline">{{ $isAdmin ? 'Admin Panel' : 'Passport' }}</span>
                </a>

                <!-- User Profile Interactive Dropdown Component (Far Right) -->
                <div x-data="{ profileOpen: false }" class="relative shrink-0 flex-shrink-0">
                    <button type="button"
                            @click="profileOpen = !profileOpen"
                            title="Account Settings & Profile"
                            aria-label="User account menu"
                            class="flex items-center gap-1.5 sm:gap-2 pl-1.5 pr-2.5 sm:pl-2 sm:pr-3 py-1 sm:py-1.5 bg-white/60 dark:bg-slate-900/60 hover:bg-white/90 dark:hover:bg-slate-800/80 backdrop-blur-xl rounded-full border border-slate-200 dark:border-white/10 hover:border-purple-500/40 transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500 group">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-[10px] sm:text-xs shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                            {{ substr($firstName, 0, 1) }}
                        </div>
                        <span class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200 truncate max-w-[70px] sm:max-w-[90px] xl:max-w-[110px]">{{ $firstName }}</span>
                        <span class="hidden xl:inline-block text-[9px] font-black uppercase px-2 py-0.5 {{ $isAdmin ? 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25' : 'bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25' }} rounded-full shrink-0">
                            {{ Auth::user()->role }}
                        </span>
                        <i :class="profileOpen ? 'rotate-180 text-purple-600 dark:text-purple-400' : 'text-slate-400 dark:text-slate-500'" class="fa-solid fa-chevron-down text-[9px] sm:text-[10px] transition-transform duration-200"></i>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="profileOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         @click.outside="profileOpen = false"
                         style="display: none;"
                         class="absolute right-0 mt-3 w-64 rounded-3xl bg-white/95 dark:bg-slate-950/95 backdrop-blur-2xl border border-slate-200 dark:border-white/10 shadow-2xl overflow-hidden z-50 p-2 space-y-1">
                        
                        <!-- User Card Header -->
                        <div class="px-3.5 py-3 rounded-2xl bg-slate-50 dark:bg-white/[0.03] border border-slate-100 dark:border-white/5 space-y-1 mb-1">
                            <p class="text-xs font-black text-slate-900 dark:text-white truncate font-display">{{ Auth::user()->name }}</p>
                            <div class="flex items-center gap-1.5 pt-0.5">
                                <span class="inline-block text-[9px] font-black uppercase px-2 py-0.5 {{ $isAdmin ? 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25' : 'bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25' }} rounded-full">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">Verified Member</span>
                            </div>
                        </div>

                        <!-- Edit Profile / Settings -->
                        <a href="{{ route('profile.edit') }}"
                           @click="profileOpen = false"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-950/30 transition-colors">
                            <div class="w-7 h-7 rounded-xl bg-purple-500/10 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-user-gear"></i>
                            </div>
                            <div class="flex-1">
                                <span>Edit Profile / Settings</span>
                            </div>
                        </a>

                        <!-- Dashboard / Passport -->
                        <a href="{{ route('dashboard') }}"
                           @click="profileOpen = false"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 transition-colors">
                            <div class="w-7 h-7 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs">
                                <i class="fa-solid {{ $isAdmin ? 'fa-screwdriver-wrench' : 'fa-gauge-high' }}"></i>
                            </div>
                            <div class="flex-1">
                                <span>{{ $isAdmin ? 'Admin Control Center' : 'Career Passport' }}</span>
                            </div>
                        </a>

                        <!-- Divider -->
                        <div class="my-1 border-t border-slate-100 dark:border-white/5"></div>

                        <!-- Logout Form -->
                        <form action="{{ url('/logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors text-left cursor-pointer">
                                <div class="w-7 h-7 rounded-xl bg-rose-500/10 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>
                                <span>Sign Out / Logout</span>
                            </button>
                        </form>

                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-2.5 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white transition-colors hidden sm:inline-flex items-center gap-1.5 shrink-0 flex-shrink-0">
                    <span>Sign In</span>
                </a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-medium px-4 sm:px-6 py-2 sm:py-2.5 rounded-full shadow-lg shadow-purple-500/25 transition-all duration-300 inline-flex items-center gap-1.5 sm:gap-2 text-xs sm:text-sm shrink-0 flex-shrink-0 whitespace-nowrap">
                    <span>Get Started</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            @endauth

            <!-- Mobile Hamburger Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button"
                    title="Toggle Navigation Menu"
                    class="lg:hidden w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 rounded-full bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm shrink-0 flex-shrink-0 cursor-pointer">
                <i :class="mobileMenuOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'" class="text-xs sm:text-sm"></i>
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
         class="mt-3 p-4 bg-white/95 dark:bg-slate-950/95 backdrop-blur-2xl border border-slate-200 dark:border-white/10 rounded-3xl shadow-2xl flex flex-col gap-1.5 lg:hidden z-50 overflow-hidden">
        
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
                <i class="fa-solid fa-photo-film text-xs text-purple-500"></i>
                <span>Multimedia Hub</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        <a href="{{ route('resources.index') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('resources.*') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-folder-open text-xs text-emerald-500"></i>
                <span>Resource Library</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        <a href="{{ route('stories.index') }}"
           class="px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between transition-colors {{ request()->routeIs('stories.*') ? 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border border-indigo-500/30' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-quote-left text-xs text-pink-500"></i>
                <span>Success Stories</span>
            </span>
            <i class="fa-solid fa-chevron-right text-xs opacity-50"></i>
        </a>

        @auth
            <div class="pt-3 mt-1 border-t border-slate-200 dark:border-white/10 flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile.edit') }}" class="flex-1 py-2.5 px-3 rounded-xl text-center font-bold text-xs bg-slate-100 dark:bg-white/5 text-slate-800 dark:text-slate-200 hover:bg-purple-500/15 hover:text-purple-600 transition-colors flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-user-gear text-purple-500"></i>
                        <span>Settings</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex-1 py-2.5 px-3 rounded-xl text-center font-bold text-xs text-white bg-gradient-to-r {{ $isAdmin ? 'from-purple-600 to-indigo-600' : 'from-indigo-600 to-pink-600' }} shadow-md flex items-center justify-center gap-1.5">
                        <i class="fa-solid {{ $isAdmin ? 'fa-screwdriver-wrench' : 'fa-gauge-high' }}"></i>
                        <span>{{ $isAdmin ? 'Admin' : 'Passport' }}</span>
                    </a>
                </div>
                <form action="{{ url('/logout') }}" method="POST" class="w-full m-0 p-0">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 font-bold text-xs border border-rose-500/20 text-center cursor-pointer">
                        Sign Out / Logout
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