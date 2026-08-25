@extends('layouts.app')
@section('title', 'Platform Feedback & Support — PathSeeker')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    {{-- Header Banner --}}
    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl space-y-3">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 border border-indigo-500/20 text-xs font-mono font-bold">
            <i class="fa-solid fa-comment-dots"></i>
            <span>Engineering &amp; Product Support</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">User Feedback &amp; Suggestions</h1>
        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
            Submit bug reports, feature suggestions, technical queries, or feedback directly to the PathSeeker engineering team.
        </p>
    </div>

    {{-- Feedback Submission Form --}}
    <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
        <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
            <i class="fa-solid fa-paper-plane text-indigo-500 text-sm"></i>
            <span>Submit New Feedback</span>
        </h3>

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="category" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Category</label>
                <select name="category" id="category" required class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                    <option value="bug">Bug Report / Technical Issue</option>
                    <option value="suggestion">Feature Suggestion / Enhancement</option>
                    <option value="query">Career Roadmap or Resource Query</option>
                    <option value="general">General Platform Feedback</option>
                </select>
            </div>

            <div>
                <label for="message" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Your Message / Report Details</label>
                <textarea name="message" id="message" rows="4" required minlength="5" maxlength="2000" placeholder="Describe the issue, requested feature, or technical query in detail..." class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 placeholder:text-slate-400"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-sweep px-8 py-3.5 rounded-full font-black text-xs text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-neon-purple hover:scale-105 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-xs text-white"></i>
                    <span class="text-white font-black">Submit Feedback</span>
                </button>
            </div>
        </form>
    </div>

    {{-- Feedback History (Privacy-guarded) --}}
    <div class="space-y-4">
        <h3 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
            <i class="fa-solid fa-clock-rotate-left text-purple-500 text-sm"></i>
            <span>Your Previous Submissions</span>
        </h3>

        @if($feedbacks->isEmpty())
            <div class="p-8 text-center rounded-2xl bg-slate-100/60 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/5 text-slate-500 text-xs">
                You haven't submitted any feedback yet.
            </div>
        @else
            <div class="space-y-3">
                @foreach($feedbacks as $fb)
                    <div class="p-5 rounded-2xl bg-white/90 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 space-y-3 shadow-sm">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono bg-indigo-500/15 text-indigo-700 dark:text-indigo-300 border border-indigo-500/25">
                                {{ $fb->category }}
                            </span>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold {{ $fb->status === 'resolved' ? 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400' : 'bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-slate-300' }}">
                                    {{ ucfirst(str_replace('_', ' ', $fb->status)) }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $fb->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">{{ $fb->message }}</p>

                        @if($fb->admin_response)
                            <div class="p-3.5 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/10 border border-indigo-500/20 text-xs space-y-1">
                                <div class="font-bold text-indigo-700 dark:text-indigo-300 flex items-center gap-1.5 text-[11px]">
                                    <i class="fa-solid fa-reply text-[10px]"></i> Administrator Response
                                </div>
                                <p class="text-indigo-950 dark:text-indigo-200 text-xs leading-relaxed">{{ $fb->admin_response }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection
