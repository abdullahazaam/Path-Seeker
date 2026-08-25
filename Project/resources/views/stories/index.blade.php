@extends('layouts.app')
@section('title', 'Success Stories — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">
    
    {{-- Header Banner --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 text-pink-700 dark:text-pink-300 border border-pink-500/20 text-xs font-mono font-bold">
                <i class="fa-solid fa-award text-pink-500"></i>
                <span>Verified Career Transitions</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display">PathSeeker <span class="grad-text">Success Stories</span></h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-2xl leading-relaxed">
                Discover inspiring real-world breakthroughs from developers, cloud engineers, AI researchers, and students who accelerated their tech journeys.
            </p>
        </div>

        @auth
            <button onclick="document.getElementById('submitStoryModal')?.showModal()" class="btn-sweep px-6 py-3.5 rounded-full font-black text-xs text-white bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 shadow-neon-pink hover:scale-105 transition-all flex items-center gap-2 shrink-0">
                <i class="fa-solid fa-feather-pointed text-xs"></i>
                <span>Share Your Story</span>
            </button>
        @endauth
    </div>

    {{-- Stories Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($stories as $story)
            <div class="p-6 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl flex flex-col justify-between space-y-4 hover:-translate-y-1 hover:border-purple-500/30 transition-all duration-300">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25">
                            {{ $story->domain }}
                        </span>
                        <span class="text-[10px] text-slate-400 font-mono">{{ $story->created_at->format('M Y') }}</span>
                    </div>
                    <h3 class="text-base font-black text-slate-900 dark:text-white font-display leading-snug">{{ $story->title }}</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed line-clamp-4">{{ $story->story_text }}</p>
                </div>

                <div class="pt-3 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400">
                        By {{ $story->author?->name ?? 'PathSeeker Member' }}
                    </span>
                    <a href="{{ route('stories.show', $story->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                        <span>Read Full Story</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full p-12 text-center rounded-3xl bg-slate-100/60 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/5 text-slate-500 text-sm">
                No approved success stories available at this time.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($stories->hasPages())
        <div class="pt-6">
            {{ $stories->links() }}
        </div>
    @endif

</div>

@auth
    {{-- Share Story Modal --}}
    <dialog id="submitStoryModal" class="p-0 rounded-3xl backdrop:bg-slate-950/80 bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl max-w-xl w-full">
        <div class="p-6 sm:p-8 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-900 dark:text-white font-display">Submit Your Success Story</h3>
                <button onclick="document.getElementById('submitStoryModal')?.close()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white flex items-center justify-center text-sm">✕</button>
            </div>

            <form action="{{ route('stories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">Story Headline / Title</label>
                    <input type="text" name="title" required placeholder="e.g. From Self-Taught to Full-Stack Architect" class="w-full px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">Target Tech Domain</label>
                    <select name="domain" required class="w-full px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs text-slate-900 dark:text-white">
                        <option value="Software Engineering">Software Engineering</option>
                        <option value="Cloud & Infrastructure">Cloud & Infrastructure</option>
                        <option value="Artificial Intelligence & Data">Artificial Intelligence & Data</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">Your Transition Story & Key Milestones</label>
                    <textarea name="story_text" rows="5" required minlength="20" placeholder="Share your trajectory, certifications earned, portfolio projects, and how PathSeeker guided your path..." class="w-full px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs text-slate-900 dark:text-white"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase font-mono text-slate-700 dark:text-slate-300 mb-1">Optional Photo URL</label>
                    <input type="url" name="image_url" placeholder="https://..." class="w-full px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs text-slate-900 dark:text-white">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('submitStoryModal')?.close()" class="px-5 py-2.5 rounded-full text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-white/5 hover:bg-slate-200">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-full text-xs font-black text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md">Submit for Review</button>
                </div>
            </form>
        </div>
    </dialog>
@endauth

@endsection
