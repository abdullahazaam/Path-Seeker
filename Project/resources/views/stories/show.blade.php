@extends('layouts.app')
@section('title', $story->title . ' — PathSeeker')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    
    {{-- Back Link --}}
    <div>
        <a href="{{ route('stories.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Back to Success Stories</span>
        </a>
    </div>

    {{-- Story Article --}}
    <article class="p-8 sm:p-12 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl space-y-8">
        
        <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-2.5">
                <span class="px-3 py-1 rounded-full text-xs font-black uppercase font-mono bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25">
                    {{ $story->domain }}
                </span>
                @if($story->status !== 'approved')
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/15 text-amber-700 dark:text-amber-300 border border-amber-500/25">
                        Status: {{ ucfirst($story->status) }}
                    </span>
                @endif
                <span class="text-xs text-slate-400 font-mono">{{ $story->created_at->format('F d, Y') }}</span>
            </div>

            <h1 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white font-display leading-tight">
                {{ $story->title }}
            </h1>

            @php
                $authorDisplayName = str_contains($story->title, ' — ') ? explode(' — ', $story->title)[0] : ($story->author?->name ?? 'PathSeeker Scholar');
            @endphp
            <div class="flex items-center gap-3 pt-2 text-xs text-slate-600 dark:text-slate-400">
                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white flex items-center justify-center font-bold text-xs">
                    {{ substr($authorDisplayName, 0, 1) }}
                </div>
                <div>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $authorDisplayName }}</span>
                    <span class="block text-[11px] text-slate-400">Verified Alumni</span>
                </div>
            </div>
        </div>

        @if($story->image_url)
            <div class="rounded-2xl overflow-hidden max-h-96 w-full shadow-md">
                <img src="{{ $story->image_url }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        {{-- ═══════════════ VERTICAL STORYTELLING TIMELINE BREAKDOWN ═══════════════ --}}
        <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/10 space-y-4">
            <div class="text-xs font-bold text-purple-600 dark:text-purple-400 font-mono uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-route text-xs"></i>
                <span>Trajectory &amp; Milestone Timeline</span>
            </div>

            <div class="relative pl-6 space-y-4 border-l-2 border-dashed border-slate-200 dark:border-white/10 ml-2 my-2">
                
                {{-- Step 1: Educational Path --}}
                <div class="relative">
                    <span class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-indigo-500 border-2 border-white dark:border-[#080B12] flex items-center justify-center text-[8px] text-white shadow-sm">
                        <i class="fa-solid fa-graduation-cap text-[7px]"></i>
                    </span>
                    <div class="text-[10px] font-mono font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
                        1. Educational Path &amp; Foundational Prep
                    </div>
                    <div class="text-sm text-slate-800 dark:text-slate-200 font-medium mt-0.5">
                        {{ $story->educational_path ?? 'Foundational Computer Science & Specialized Self-Paced Track' }}
                    </div>
                </div>

                {{-- Step 2: Challenges & Obstacles --}}
                <div class="relative">
                    <span class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-amber-500 border-2 border-white dark:border-[#080B12] flex items-center justify-center text-[8px] text-white shadow-sm">
                        <i class="fa-solid fa-bolt text-[7px]"></i>
                    </span>
                    <div class="text-[10px] font-mono font-black text-amber-600 dark:text-amber-400 uppercase tracking-wider">
                        2. Key Obstacles &amp; Challenges Overcome
                    </div>
                    <div class="text-sm text-slate-800 dark:text-slate-200 font-medium mt-0.5">
                        {{ $story->challenges ?? 'Overcoming imposter syndrome, portfolio building, and technical interview screening' }}
                    </div>
                </div>

                {{-- Step 3: Outcome & Achievement --}}
                <div class="relative">
                    <span class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-emerald-500 border-2 border-white dark:border-[#080B12] flex items-center justify-center text-[8px] text-white shadow-sm">
                        <i class="fa-solid fa-trophy text-[7px]"></i>
                    </span>
                    <div class="text-[10px] font-mono font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                        3. Final Outcome &amp; Career Leap
                    </div>
                    <div class="text-sm text-emerald-700 dark:text-emerald-300 font-bold mt-0.5">
                        {{ $story->outcome ?? 'Accelerated career breakthrough into a high-yield technology role' }}
                    </div>
                </div>

            </div>
        </div>

        <div class="prose dark:prose-invert max-w-none text-sm sm:text-base leading-relaxed text-slate-700 dark:text-slate-300 whitespace-pre-line border-t border-slate-200/80 dark:border-white/10 pt-6">
            {{ $story->story_text }}
        </div>

        {{-- Admin Moderation Panel if viewing non-approved or admin mode --}}
        @if(auth()->check() && auth()->user()->role === 'admin' && auth()->id() !== $story->submitted_by)
            <div class="p-6 rounded-2xl bg-slate-100 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 space-y-4">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-300 font-mono flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-indigo-500"></i>
                    <span>Admin Moderation Controls</span>
                </h4>
                <div class="flex flex-wrap items-center gap-3">
                    <form action="{{ route('admin.stories.moderate', $story->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-500 shadow-sm">
                            Approve &amp; Publish
                        </button>
                    </form>

                    <form action="{{ route('admin.stories.moderate', $story->id) }}" method="POST" class="inline-flex items-center gap-2">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <input type="text" name="reason" placeholder="Reason for rejection..." required class="px-3 py-1.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-xs text-slate-900 dark:text-white">
                        <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-500 shadow-sm">
                            Reject
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </article>

</div>

@endsection
