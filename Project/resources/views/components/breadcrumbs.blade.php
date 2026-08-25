@if(!request()->routeIs('home') && !request()->routeIs('login') && !request()->routeIs('register'))
<nav aria-label="Breadcrumbs" class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4 pb-1">
    <ol class="flex flex-wrap items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400 font-medium">
        <li class="flex items-center gap-1.5">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-purple-300 transition-colors flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i>
                <span>Home</span>
            </a>
        </li>
        
        @if(View::hasSection('breadcrumbs'))
            @yield('breadcrumbs')
        @else
            @if(request()->routeIs('careers.index'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Career Bank</span>
                </li>
            @elseif(request()->routeIs('careers.show'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <a href="{{ route('careers.index') }}" class="hover:text-indigo-600 dark:hover:text-purple-300 transition-colors">Career Bank</a>
                </li>
                @if(isset($career))
                    <li class="flex items-center gap-1.5">
                        <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                        <span class="text-slate-800 dark:text-slate-200 font-bold truncate max-w-[200px] sm:max-w-xs">{{ $career->title }}</span>
                    </li>
                @endif
            @elseif(request()->routeIs('quiz.index'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Interest Quiz</span>
                </li>
            @elseif(request()->routeIs('quiz.results'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <a href="{{ route('quiz.index') }}" class="hover:text-indigo-600 dark:hover:text-purple-300 transition-colors">Interest Quiz</a>
                </li>
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Alignment Results</span>
                </li>
            @elseif(request()->routeIs('multimedia.index'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Multimedia Hub</span>
                </li>
            @elseif(request()->routeIs('multimedia.show'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <a href="{{ route('multimedia.index') }}" class="hover:text-indigo-600 dark:hover:text-purple-300 transition-colors">Multimedia Hub</a>
                </li>
                @if(isset($item))
                    <li class="flex items-center gap-1.5">
                        <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                        <span class="text-slate-800 dark:text-slate-200 font-bold truncate max-w-[200px] sm:max-w-xs">{{ $item->title }}</span>
                    </li>
                @endif
            @elseif(request()->routeIs('resources.index'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Resource Library</span>
                </li>
            @elseif(request()->routeIs('resources.show'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <a href="{{ route('resources.index') }}" class="hover:text-indigo-600 dark:hover:text-purple-300 transition-colors">Resource Library</a>
                </li>
                @if(isset($resource))
                    <li class="flex items-center gap-1.5">
                        <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                        <span class="text-slate-800 dark:text-slate-200 font-bold truncate max-w-[200px] sm:max-w-xs">{{ $resource->title }}</span>
                    </li>
                @endif
            @elseif(request()->routeIs('stories.index'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Success Stories</span>
                </li>
            @elseif(request()->routeIs('dashboard'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Candidate Passport</span>
                </li>
            @elseif(request()->routeIs('profile.edit'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Account Settings</span>
                </li>
            @elseif(request()->routeIs('bookmarks.index'))
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 dark:hover:text-purple-300 transition-colors">Candidate Passport</a>
                </li>
                <li class="flex items-center gap-1.5">
                    <span class="text-slate-400 dark:text-slate-600 text-[10px]">&gt;</span>
                    <span class="text-slate-800 dark:text-slate-200 font-bold">Saved Bookmarks</span>
                </li>
            @endif
        @endif
    </ol>
</nav>
@endif
