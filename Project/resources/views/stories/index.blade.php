@extends('layouts.app')
@section('title', 'Success Stories Hub — PathSeeker')
@section('content')

<div x-data="{ submitStoryModal: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">
    
    {{-- Header Banner --}}
    <div class="relative overflow-hidden p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl flex flex-col md:flex-row md:items-center justify-between gap-6 reveal-on-scroll">
        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-pink-500/10 dark:bg-pink-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-2 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 text-pink-700 dark:text-pink-300 border border-pink-500/20 text-xs font-mono font-bold">
                <i class="fa-solid fa-award text-pink-500"></i>
                <span>Verified Career Transitions &amp; Journeys</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display tracking-tight">
                PathSeeker <span class="grad-text">Success Stories</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                Explore authentic career breakthrough journeys from self-taught developers, university graduates, and transitioning professionals who accelerated their tech careers.
            </p>
        </div>

        <div class="relative z-10 shrink-0">
            @auth
                <button type="button"
                        @click="submitStoryModal = true"
                        class="btn-sweep px-7 py-4 rounded-full font-black text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 shadow-xl shadow-cyan-500/25 hover:scale-105 transition-all flex items-center gap-2.5 cursor-pointer">
                    <i class="fa-solid fa-feather-pointed text-xs text-slate-950"></i>
                    <span class="text-slate-950 font-black">Share Your Story</span>
                </button>
            @else
                <a href="{{ route('login') }}" class="btn-sweep px-7 py-4 rounded-full font-black text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 shadow-xl shadow-cyan-500/25 hover:scale-105 transition-all flex items-center gap-2.5">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs text-slate-950"></i>
                    <span class="text-slate-950 font-black">Sign In to Share Story</span>
                </a>
            @endauth
        </div>
    </div>

    {{-- Timeline Stories Grid --}}
    <div class="stagger-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch" data-stagger-grid id="storiesGrid">
        @forelse($stories as $story)
            @php
                $authorDisplayName = str_contains($story->title, ' — ') ? explode(' — ', $story->title)[0] : ($story->author?->name ?? 'PathSeeker Scholar');
                $storyHeadline = str_contains($story->title, ' — ') ? explode(' — ', $story->title)[1] : $story->title;
            @endphp
            <div class="reveal-card p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-md dark:shadow-sm hover:shadow-xl hover:border-purple-500/30 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group app-card">
                
                <div class="space-y-4">
                    
                    {{-- Header Meta: Author Avatar, Name, Domain Pill & Date --}}
                    <div class="flex items-center justify-between gap-3 pb-3 border-b border-slate-200/80 dark:border-white/10">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-purple-500/25 via-indigo-500/20 to-cyan-500/20 border border-purple-500/35 dark:border-purple-400/30 flex items-center justify-center text-purple-700 dark:text-purple-300 font-black text-sm shrink-0 shadow-md font-display backdrop-blur-md">
                                <span>{{ strtoupper(substr($authorDisplayName, 0, 1)) }}</span>
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs font-black text-slate-900 dark:text-white truncate font-display">
                                    {{ $authorDisplayName }}
                                </div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 font-mono">
                                    {{ $story->created_at->format('M Y') }}
                                </div>
                            </div>
                        </div>

                        <span class="px-2.5 py-1 rounded-full text-[9px] font-black uppercase font-mono bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25 shrink-0">
                            {{ $story->domain }}
                        </span>
                    </div>

                    {{-- Story Title --}}
                    <h3 class="text-base font-black text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors font-display leading-snug">
                        <a href="{{ route('stories.show', $story->id) }}">
                            {{ $story->title }}
                        </a>
                    </h3>

                    {{-- ═══════════════ VERTICAL STORYTELLING TIMELINE ═══════════════ --}}
                    <div class="relative pl-5 space-y-3.5 border-l-2 border-dashed border-slate-200 dark:border-white/10 ml-1.5 my-2">
                        
                        {{-- Step 1: Educational Path --}}
                        <div class="relative">
                            <span class="absolute -left-[27px] top-0.5 w-3.5 h-3.5 rounded-full bg-indigo-500 border-2 border-white dark:border-[#080B12] flex items-center justify-center text-[7px] text-white shadow-sm">
                                <i class="fa-solid fa-graduation-cap text-[6px]"></i>
                            </span>
                            <div class="text-[9px] font-mono font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
                                1. Educational Path
                            </div>
                            <div class="text-xs text-slate-700 dark:text-slate-300 font-medium line-clamp-2 mt-0.5">
                                {{ $story->educational_path ?? 'Foundational Computer Science & Specialized Self-Paced Track' }}
                            </div>
                        </div>

                        {{-- Step 2: Challenges & Obstacles --}}
                        <div class="relative">
                            <span class="absolute -left-[27px] top-0.5 w-3.5 h-3.5 rounded-full bg-amber-500 border-2 border-white dark:border-[#080B12] flex items-center justify-center text-[7px] text-white shadow-sm">
                                <i class="fa-solid fa-bolt text-[6px]"></i>
                            </span>
                            <div class="text-[9px] font-mono font-black text-amber-600 dark:text-amber-400 uppercase tracking-wider">
                                2. Key Challenges
                            </div>
                            <div class="text-xs text-slate-700 dark:text-slate-300 font-medium line-clamp-2 mt-0.5">
                                {{ $story->challenges ?? 'Overcoming imposter syndrome and technical screening hurdles' }}
                            </div>
                        </div>

                        {{-- Step 3: Outcome & Achievement --}}
                        <div class="relative">
                            <span class="absolute -left-[27px] top-0.5 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white dark:border-[#080B12] flex items-center justify-center text-[7px] text-white shadow-sm">
                                <i class="fa-solid fa-trophy text-[6px]"></i>
                            </span>
                            <div class="text-[9px] font-mono font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                                3. Outcome
                            </div>
                            <div class="text-xs text-slate-900 dark:text-emerald-300 font-bold line-clamp-2 mt-0.5">
                                {{ $story->outcome ?? 'Accelerated career breakthrough in a high-yield technology role' }}
                            </div>
                        </div>

                    </div>

                    {{-- Story Excerpt / Testimonial Quote --}}
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 italic pt-1">
                        &ldquo;{{ $story->story_text }}&rdquo;
                    </p>

                </div>

                {{-- Bottom CTA Footer --}}
                <div class="mt-5 pt-4 border-t border-slate-200/80 dark:border-white/10 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 dark:text-emerald-400">
                        <i class="fa-solid fa-circle-check text-[9px]"></i>
                        <span>Verified Story</span>
                    </span>
                    <a href="{{ route('stories.show', $story->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors group/link">
                        <span>Read Full Journey</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 text-center rounded-3xl bg-slate-100/60 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/5 space-y-3">
                <div class="w-16 h-16 rounded-2xl bg-pink-500/20 text-pink-600 dark:text-pink-400 flex items-center justify-center text-2xl mx-auto shadow-sm">
                    <i class="fa-solid fa-feather-pointed"></i>
                </div>
                <p class="text-base font-bold text-slate-900 dark:text-slate-300">No approved success stories available at this time.</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">Be the first to share your milestone journey with the PathSeeker community!</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($stories->hasPages())
        <div class="pt-6">
            {{ $stories->links() }}
        </div>
    @endif

    {{-- ══════════════════ ALPINE MODAL: USER STORY SUBMISSION ══════════════════ --}}
    @auth
        <div x-show="submitStoryModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/80 backdrop-blur-md"
             style="display: none;"
             @keydown.escape.window="submitStoryModal = false">
            
            <div class="relative w-full max-w-2xl rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 p-6 sm:p-8 shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto"
                 @click.away="submitStoryModal = false">
                
                {{-- Top Accent Bar --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-full"></div>

                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                    <div class="space-y-1">
                        <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-pink-500/10 text-pink-700 dark:text-pink-300 border border-pink-500/20 text-xs font-mono font-bold">
                            <i class="fa-solid fa-feather-pointed text-xs"></i>
                            <span>Community Showcase</span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white font-display">
                            Share Your Success Journey
                        </h3>
                    </div>
                    <button type="button" @click="submitStoryModal = false" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/20 text-slate-600 dark:text-slate-300 flex items-center justify-center transition-all">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form action="{{ route('stories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-1.5">
                            Story Headline / Transition Title *
                        </label>
                        <input type="text" name="title" required placeholder="e.g. From Self-Taught QA to Production AI Engineer" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-1.5">
                                Target Domain *
                            </label>
                            <select name="domain" required class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="Software Engineering">Software Engineering</option>
                                <option value="Cloud & Infrastructure">Cloud & Infrastructure</option>
                                <option value="Artificial Intelligence & Data">Artificial Intelligence & Data</option>
                                <option value="Cybersecurity">Cybersecurity</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Blockchain">Blockchain</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-1.5">
                                Optional Avatar/Photo URL
                            </label>
                            <input type="url" name="image_url" placeholder="https://..." class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                        </div>
                    </div>

                    {{-- Timeline Milestone Fields --}}
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/10 space-y-3">
                        <div class="text-xs font-bold text-purple-600 dark:text-purple-400 font-mono uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-route text-xs"></i>
                            <span>Timeline Milestones</span>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">
                                1. Educational Path / Groundwork
                            </label>
                            <input type="text" name="educational_path" placeholder="e.g. B.S. Information Systems & Self-Paced Machine Learning" class="w-full px-3.5 py-2 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">
                                2. Challenges &amp; Obstacles Overcome
                            </label>
                            <input type="text" name="challenges" placeholder="e.g. Overcoming imposter syndrome and passing system design rounds" class="w-full px-3.5 py-2 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">
                                3. Final Outcome &amp; Role Achieved
                            </label>
                            <input type="text" name="outcome" placeholder="e.g. Landed Senior AI Engineer role at a Google Partner" class="w-full px-3.5 py-2 text-xs rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono mb-1.5">
                            Full Story, Trajectory &amp; Advice * (min 20 characters)
                        </label>
                        <textarea name="story_text" rows="4" required minlength="20" placeholder="Share your step-by-step preparation, how PathSeeker guided your path, certifications earned, and advice for fellow scholars..." class="w-full px-4 py-3 text-xs sm:text-sm rounded-2xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:outline-none shadow-inner"></textarea>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-slate-200 dark:border-white/10">
                        <button type="button" @click="submitStoryModal = false" class="px-5 py-2.5 rounded-full text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="btn-sweep px-7 py-3 rounded-full text-xs font-bold text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-md transition-all flex items-center gap-2 cursor-pointer font-black">
                            <span>Submit for Verification</span>
                            <i class="fa-solid fa-paper-plane text-[10px] text-slate-950"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endauth

</div>

@endsection
