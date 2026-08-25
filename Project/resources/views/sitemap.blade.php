@extends('layouts.app')
@section('title', 'Platform Visual Sitemap & Hierarchical Architecture — PathSeeker')
@section('meta_description', 'Explore the comprehensive hierarchical visual sitemap of PathSeeker. Navigate all career domains, cognitive assessment modules, toolkits, multimedia, and candidate passport features.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    {{-- Top Hero Header --}}
    <div class="relative rounded-3xl p-8 sm:p-12 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl overflow-hidden reveal-element">
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-indigo-500/10 dark:bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-4 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/20 text-xs font-black uppercase tracking-wider text-purple-700 dark:text-purple-300 font-mono shadow-sm">
                <i class="fa-solid fa-sitemap text-purple-500"></i>
                <span>Platform Navigation Blueprint</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white font-display tracking-tight leading-tight">
                Visual Platform <span class="grad-text">Sitemap</span>
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                Complete structured directory of all platform domains, intelligent assessment paths, resource libraries, user passport workflows, and administrative endpoints.
            </p>
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a href="{{ route('sitemap') }}" target="_blank" class="px-4 py-2 rounded-xl text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 hover:bg-indigo-500/20 transition-all inline-flex items-center gap-2">
                    <i class="fa-solid fa-code text-xs"></i>
                    <span>Raw XML Sitemap</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                </a>
                <span class="text-xs text-slate-400 font-mono">
                    Updated Daily &bull; {{ $careers->count() }} Career Profiles Indexed
                </span>
            </div>
        </div>
    </div>

    {{-- ══════════════════ HIERARCHICAL TREE VIEW ══════════════════ --}}
    <div class="space-y-8">
        
        {{-- Root Node Card --}}
        <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 text-xl shadow-md font-black">
                    <i class="fa-solid fa-house text-slate-950"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-lg font-black text-slate-900 dark:text-white font-display">PathSeeker Root Portal</h2>
                        <span class="px-2 py-0.5 rounded text-[9px] font-mono font-bold bg-purple-500/15 text-purple-600 dark:text-purple-300">Root Node</span>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-mono mt-0.5">https://pathseeker.com /</p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-purple-600 dark:text-purple-400 bg-purple-500/10 hover:bg-purple-500/20 transition-all">
                Visit Home
            </a>
        </div>

        {{-- Branch Grid: 4 Core Modules --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Branch 1: Career Intelligence & Domain Pathways --}}
            <div class="p-7 sm:p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-white/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-500/10 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-base">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-900 dark:text-white font-display">Career Bank &amp; Domains</h3>
                                <span class="text-[10px] text-slate-400 font-mono">/careers</span>
                            </div>
                        </div>
                        <a href="{{ route('careers.index') }}" class="text-xs font-bold text-purple-600 dark:text-purple-400 hover:underline">
                            Browse &rarr;
                        </a>
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Role-based tech compensation benchmarks, required competencies, and 10-year market trajectories organized by industry domain:
                    </p>

                    <div class="space-y-4 pt-1">
                        @foreach($domains as $domainName => $domainCareers)
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 space-y-2">
                                <div class="flex items-center justify-between text-xs font-bold">
                                    <span class="text-slate-900 dark:text-white font-display flex items-center gap-1.5">
                                        <i class="fa-solid fa-folder-tree text-purple-500 text-[11px]"></i>
                                        <span>{{ $domainName }}</span>
                                    </span>
                                    <span class="text-[10px] font-mono text-purple-600 dark:text-purple-400">{{ $domainCareers->count() }} roles</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 pt-1">
                                    @foreach($domainCareers as $c)
                                        <a href="{{ route('careers.show', $c->id) }}" class="text-[11px] text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-300 truncate transition-colors flex items-center gap-1.5 p-1 rounded hover:bg-purple-50/50 dark:hover:bg-purple-950/30">
                                            <i class="fa-solid fa-angle-right text-[8px] text-slate-400"></i>
                                            <span class="truncate">{{ $c->title }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-200 dark:border-white/10 flex items-center justify-between text-xs font-mono text-slate-400">
                    <span>{{ $careers->count() }} Profiles</span>
                    <span class="text-emerald-500 font-bold">All Active</span>
                </div>
            </div>

            {{-- Branch 2: Interactive Assessments & Multimedia Learning --}}
            <div class="space-y-8 flex flex-col justify-between">
                
                {{-- Quiz Assessment Engine --}}
                <div class="p-7 sm:p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-white/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-pink-500/10 dark:bg-pink-500/20 text-pink-600 dark:text-pink-400 flex items-center justify-center text-base">
                                <i class="fa-solid fa-brain"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-900 dark:text-white font-display">Assessment Engine &amp; AI</h3>
                                <span class="text-[10px] text-slate-400 font-mono">/quiz &bull; /chat/message</span>
                            </div>
                        </div>
                        <a href="{{ route('quiz.index') }}" class="text-xs font-bold text-pink-600 dark:text-pink-400 hover:underline">
                            Take Quiz &rarr;
                        </a>
                    </div>
                    <ul class="space-y-2.5 text-xs text-slate-600 dark:text-slate-400">
                        <li class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5">
                            <span class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-stopwatch text-pink-500"></i> Interest Assessment Quiz
                            </span>
                            <span class="font-mono text-slate-400">/quiz</span>
                        </li>
                        <li class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5">
                            <span class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-chart-pie text-pink-500"></i> Alignment Results Page
                            </span>
                            <span class="font-mono text-slate-400">/quiz/results/{id}</span>
                        </li>
                        <li class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5">
                            <span class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-wand-magic-sparkles text-purple-500"></i> AI Guide Chatbot
                            </span>
                            <span class="font-mono text-emerald-500">Real-Time</span>
                        </li>
                    </ul>
                </div>

                {{-- Multimedia & Resource Library --}}
                <div class="p-7 sm:p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-white/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-base">
                                <i class="fa-solid fa-photo-film"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-900 dark:text-white font-display">Media &amp; Toolkits Library</h3>
                                <span class="text-[10px] text-slate-400 font-mono">/multimedia &bull; /resources</span>
                            </div>
                        </div>
                        <a href="{{ route('multimedia.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                            Explore &rarr;
                        </a>
                    </div>
                    <ul class="space-y-2.5 text-xs text-slate-600 dark:text-slate-400">
                        <li class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5">
                            <a href="{{ route('multimedia.index') }}" class="font-bold text-slate-900 dark:text-white hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-video text-indigo-500"></i> Multimedia Masterclass Hub
                            </a>
                            <span class="font-mono text-slate-400">{{ $multimediaCount }} Videos</span>
                        </li>
                        <li class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5">
                            <a href="{{ route('resources.index') }}" class="font-bold text-slate-900 dark:text-white hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-folder-open text-emerald-500"></i> Document Resource Library
                            </a>
                            <span class="font-mono text-slate-400">{{ $resourcesCount }} Toolkits</span>
                        </li>
                        <li class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5">
                            <a href="{{ route('stories.index') }}" class="font-bold text-slate-900 dark:text-white hover:text-pink-600 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-quote-left text-pink-500"></i> Success Stories Timeline
                            </a>
                            <span class="font-mono text-slate-400">{{ $storiesCount }} Stories</span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        {{-- Branch 3: Candidate Passport Suite & Account Workflows --}}
        <div class="p-7 sm:p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-base">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900 dark:text-white font-display">Candidate Passport Suite &amp; Account Portal</h3>
                        <span class="text-[10px] text-slate-400 font-mono">/dashboard &bull; /profile &bull; /bookmarks</span>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                    Access Passport &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 space-y-1.5">
                    <div class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                        <i class="fa-solid fa-gauge text-indigo-500"></i>
                        <span>Career Passport</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Personalized dashboard, metrics, and recently viewed careers.</p>
                    <a href="{{ route('dashboard') }}" class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 hover:underline inline-block pt-1">Open &rarr;</a>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 space-y-1.5">
                    <div class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                        <i class="fa-solid fa-bookmark text-purple-500"></i>
                        <span>Saved Bookmarks</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Curated saved roles, private sticky notes, and PDF exports.</p>
                    <a href="{{ route('bookmarks.index') }}" class="text-[10px] font-bold text-purple-600 dark:text-purple-400 hover:underline inline-block pt-1">View &rarr;</a>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 space-y-1.5">
                    <div class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                        <i class="fa-solid fa-file-pdf text-rose-500"></i>
                        <span>Resume &amp; Credentials</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Profile editing, preferences, and secure resume document upload.</p>
                    <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold text-rose-600 dark:text-rose-400 hover:underline inline-block pt-1">Manage &rarr;</a>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/5 space-y-1.5">
                    <div class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                        <i class="fa-solid fa-comments text-amber-500"></i>
                        <span>Feedback &amp; Responses</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Direct feedback submissions and replies from administration.</p>
                    <a href="{{ route('feedback.index') }}" class="text-[10px] font-bold text-amber-600 dark:text-amber-400 hover:underline inline-block pt-1">Explore &rarr;</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
