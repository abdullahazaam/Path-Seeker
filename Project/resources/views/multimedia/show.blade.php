@extends('layouts.app')
@section('title', $item->title . ' — Multimedia Center')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 space-y-6" x-data="{
    showTranscript: false,
    transcriptSearch: '',
    copiedTranscript: false,
    userRating: {{ $userRating?->rating ?? 0 }},
    hoverRating: 0,
    avgRating: {{ $item->average_rating }},
    totalRatings: {{ $item->ratings->count() }},
    ratingMessage: '',
    ratingLoading: false,
    
    submitRating(val) {
        @if(!auth()->check())
            window.location.href = '{{ route('login') }}';
            return;
        @endif
        
        this.ratingLoading = true;
        fetch('{{ route('multimedia.rate', $item->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ rating: val })
        })
        .then(r => r.json())
        .then(data => {
            this.ratingLoading = false;
            if (data.success) {
                this.userRating = val;
                this.avgRating = data.average_rating;
                this.totalRatings = data.total_ratings;
                this.ratingMessage = data.message;
                setTimeout(() => { this.ratingMessage = ''; }, 4000);
            }
        })
        .catch(err => {
            this.ratingLoading = false;
            console.error(err);
        });
    },

    copyTranscriptText() {
        const text = document.getElementById('transcriptTextArea')?.innerText || '';
        navigator.clipboard.writeText(text).then(() => {
            this.copiedTranscript = true;
            setTimeout(() => { this.copiedTranscript = false; }, 2500);
        });
    }
}">

    {{-- Back Link --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('multimedia.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-700 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-purple-300 transition-colors group">
            <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
            <span>Back to Multimedia Hub</span>
        </a>

        <div class="flex items-center gap-3">
            {{-- Average Rating Pill --}}
            <div class="px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-xs font-mono font-bold text-amber-700 dark:text-amber-400 flex items-center gap-1.5 shadow-sm">
                <i class="fa-solid fa-star text-amber-500 text-[11px]"></i>
                <span x-text="avgRating"></span>
                <span class="text-slate-400 font-normal">(<span x-text="totalRatings"></span> reviews)</span>
            </div>
        </div>
    </div>

    {{-- Main Multimedia Card Container --}}
    <div class="relative rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 overflow-hidden shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-rose-500/10 dark:bg-rose-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>

        <!-- Header -->
        <div class="relative z-10 bg-slate-50 dark:bg-slate-950/60 p-6 sm:p-8 border-b border-slate-200/80 dark:border-white/10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $item->type === 'video' ? 'bg-rose-500/15 text-rose-700 dark:text-rose-300 border border-rose-500/25' : 'bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25' }} font-mono shadow-sm">
                            <i class="fa-solid {{ $item->type === 'video' ? 'fa-video' : 'fa-headphones' }} text-[10px]"></i>
                            <span>{{ $item->type === 'video' ? 'Video Masterclass' : 'Audio Podcast' }}</span>
                        </span>
                        @if($item->domain)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/15 text-indigo-700 dark:text-indigo-300 border border-indigo-500/25">
                                {{ $item->domain }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-snug font-display">{{ $item->title }}</h1>
                </div>
                <div class="text-xs text-slate-600 dark:text-slate-400 font-mono shrink-0 flex sm:flex-col items-end gap-1">
                    <span><i class="fa-regular fa-clock mr-1 text-indigo-500"></i>{{ $item->duration ?? '25:00' }}</span>
                    <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold">HD Masterclass</span>
                </div>
            </div>
        </div>

        <!-- In-App Streaming Video/Audio Player -->
        <div class="relative z-10 p-6 sm:p-8 space-y-6">
            <div class="rounded-2xl overflow-hidden border border-slate-200/80 dark:border-white/10 bg-slate-950 shadow-2xl relative">
                @if($item->type === 'video' || str_contains($item->url, 'youtube') || str_contains($item->url, 'youtu.be'))
                    <div class="aspect-video w-full bg-slate-950 relative">
                        <iframe class="w-full h-full rounded-2xl"
                                src="{{ $item->getEmbedUrl() }}?rel=0&modestbranding=1&enablejsapi=1"
                                title="{{ $item->title }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen></iframe>
                    </div>
                    
                    {{-- Player Action Bar with Transcript Toggle --}}
                    <div class="p-3.5 bg-slate-100/90 dark:bg-slate-900/90 border-t border-slate-200/80 dark:border-white/10 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-600 dark:text-slate-400">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1.5 font-medium">
                                <i class="fa-brands fa-youtube text-rose-500"></i> Interactive Stream
                            </span>

                            {{-- 1. VIDEO PLAYER TRANSCRIPT TOGGLE BUTTON --}}
                            <button type="button" @click="showTranscript = !showTranscript" :class="showTranscript ? 'bg-indigo-600 text-white shadow-md' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700'" class="px-3 py-1.5 rounded-xl border border-slate-300 dark:border-white/10 font-bold text-xs transition-all flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-file-lines text-xs"></i>
                                <span x-text="showTranscript ? 'Hide Transcript' : 'Show Transcript'"></span>
                            </button>
                        </div>

                        <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 font-bold flex items-center gap-1 transition-colors">
                            <span>Watch on YouTube</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                @else
                    <div class="py-14 px-8 text-center space-y-6 bg-slate-100/80 dark:bg-slate-950/50">
                        <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center text-3xl shadow-md text-white">
                            <i class="fa-solid fa-podcast text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white font-display">Audio Stream / Podcast</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">High-definition career podcast</p>
                        </div>
                        <audio controls class="w-full max-w-md mx-auto">
                            <source src="{{ $item->url }}" type="audio/mpeg">
                            Your browser does not support audio playback.
                        </audio>
                        
                        <div class="pt-4 flex justify-center">
                            <button type="button" @click="showTranscript = !showTranscript" :class="showTranscript ? 'bg-indigo-600 text-white' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300'" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-white/10 font-bold text-xs transition-all flex items-center gap-2 cursor-pointer shadow-sm">
                                <i class="fa-solid fa-file-lines text-xs"></i>
                                <span x-text="showTranscript ? 'Hide Audio Transcript' : 'Show Audio Transcript'"></span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ═══════════════ 1. INTERACTIVE SCROLLABLE TRANSCRIPT SECTION ═══════════════ --}}
            <div x-show="showTranscript" x-cloak style="display: none;" class="p-5 sm:p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/70 border border-slate-200/80 dark:border-white/10 space-y-4 shadow-inner transition-all">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-200 dark:border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-closed-captioning"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-white font-mono">Masterclass Audio &amp; Video Transcript</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400">Searchable, timestamped dialogue &amp; key concepts</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="copyTranscriptText()" class="px-3 py-1.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors flex items-center gap-1.5 shadow-xs">
                            <i class="fa-solid fa-copy text-[10px]"></i>
                            <span x-text="copiedTranscript ? 'Transcript Copied!' : 'Copy Transcript'"></span>
                        </button>
                    </div>
                </div>

                {{-- Scrollable Transcript Body --}}
                <div id="transcriptTextArea" class="max-h-72 overflow-y-auto pr-2 space-y-2.5 font-mono text-xs text-slate-700 dark:text-slate-300 leading-relaxed bg-white/80 dark:bg-slate-900/60 p-4 rounded-xl border border-slate-200/80 dark:border-white/5 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-thumb]:bg-indigo-500/50 [&::-webkit-scrollbar-thumb]:rounded-full">
                    @php
                        $transcriptText = $item->formatted_transcript;
                        $lines = explode("\n", $transcriptText);
                    @endphp
                    @foreach($lines as $line)
                        @if(trim($line))
                            <div class="flex items-start gap-2.5 hover:bg-indigo-500/5 p-1 rounded transition-colors">
                                @if(preg_match('/^\[([0-9:]+)\]\s*(.*)$/', $line, $matches))
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 shrink-0">
                                        {{ $matches[1] }}
                                    </span>
                                    <span class="text-slate-800 dark:text-slate-200">{{ $matches[2] }}</span>
                                @else
                                    <span>{{ $line }}</span>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- ═══════════════ 2 & 3. INTERACTIVE 5-STAR RATING SYSTEM (AJAX) ═══════════════ --}}
            <div class="p-6 rounded-2xl bg-gradient-to-r from-amber-500/5 via-purple-500/5 to-indigo-500/5 border border-slate-200/80 dark:border-white/10 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-1.5 text-xs font-mono font-bold uppercase tracking-wider text-amber-700 dark:text-amber-400">
                            <i class="fa-solid fa-star text-amber-500"></i>
                            <span>Rate this Masterclass</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400">
                            How useful was this session for your technical roadmap? Click a star to submit your rating instantly.
                        </p>
                    </div>

                    {{-- Interactive Star Selector --}}
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1 text-2xl" @mouseleave="hoverRating = 0">
                            <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                <button type="button"
                                        @mouseenter="hoverRating = star"
                                        @click="submitRating(star)"
                                        :disabled="ratingLoading"
                                        class="p-1 text-slate-300 dark:text-slate-700 hover:scale-125 transition-transform duration-200 cursor-pointer focus:outline-none"
                                        :title="'Rate ' + star + ' stars'">
                                    <i class="fa-solid fa-star transition-colors"
                                       :class="{
                                           'text-amber-400 drop-shadow-sm': (hoverRating ? star <= hoverRating : star <= userRating),
                                           'text-slate-300 dark:text-slate-700': (hoverRating ? star > hoverRating : star > userRating)
                                       }"></i>
                                </button>
                            </template>
                        </div>
                        
                        <div class="text-xs font-mono font-bold text-slate-700 dark:text-slate-300 pl-2">
                            <span x-text="userRating ? userRating + '/5 Stars' : 'Not Rated'"></span>
                        </div>
                    </div>
                </div>

                {{-- Feedback Message Toast / Confirmation --}}
                <div x-show="ratingMessage" x-cloak style="display: none;" class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs font-bold text-emerald-700 dark:text-emerald-400 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span x-text="ratingMessage"></span>
                </div>

                @if(!auth()->check())
                    <div class="pt-2 text-[11px] text-slate-500 dark:text-slate-400">
                        <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Log in</a> to record your verified rating and track curriculum progress.
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($item->description)
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/10 space-y-2">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-2 font-display">
                        <i class="fa-solid fa-circle-info text-indigo-600 dark:text-indigo-400"></i>
                        <span>Overview &amp; Core Learning Objectives</span>
                    </h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                        {{ $item->description }}
                    </p>
                </div>
            @endif

            <!-- Tags -->
            @if($item->tags)
                <div class="space-y-2">
                    <div class="text-xs font-black uppercase tracking-wider text-slate-700 dark:text-slate-400 flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-tags text-indigo-600 dark:text-indigo-400 text-xs"></i>
                        <span>Topic Tags</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $item->tags) as $tag)
                            <span class="px-3 py-1.5 text-xs font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/10 text-slate-800 dark:text-slate-300 flex items-center gap-1.5 shadow-sm">
                                <i class="fa-solid fa-tag text-[9px] text-purple-600 dark:text-purple-400"></i>
                                <span>{{ trim($tag) }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Action Navigation Bar -->
            <div class="pt-4 border-t border-slate-200/80 dark:border-white/10 flex flex-wrap gap-3">
                <a href="{{ route('multimedia.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Browse All Media</span>
                </a>
                <a href="{{ route('careers.index') }}" class="btn-sweep px-5 py-2.5 rounded-xl font-black text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-compass text-xs text-white"></i>
                    <span class="text-white">Explore Aligned Careers</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection