@extends('layouts.app')
@section('title', 'Quiz Results — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">

    {{-- Result Hero Card --}}
    <div class="relative rounded-3xl p-8 sm:p-12 text-center space-y-6 bg-gradient-to-br from-indigo-950 via-purple-950 to-obsidian border border-purple-500/30 overflow-hidden shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        <div class="relative z-10 space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 glass-panel rounded-full border border-emerald-500/30 text-xs font-black uppercase tracking-widest text-emerald-300">
                <i class="fa-solid fa-circle-check text-emerald-400"></i>
                <span class="text-white">Assessment Completed Successfully</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-white font-display">
                Your Career Alignment <span class="grad-text">Profile</span>
            </h1>

            <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                Based on your cognitive evaluation responses, here is your primary technological affinity domain and matching industry career tracks.
            </p>

            <div class="flex flex-wrap justify-center gap-5 pt-4">
                <div class="glass-panel px-8 py-5 rounded-2xl border border-indigo-500/30 text-left">
                    <div class="text-[10px] font-black uppercase tracking-widest text-indigo-300 mb-1 flex items-center gap-1.5">
                        <i class="fa-solid fa-bullseye text-indigo-400"></i>
                        <span class="text-indigo-300">Top Matched Domain</span>
                    </div>
                    <div class="text-xl sm:text-2xl font-black text-white font-display">{{ $recommendedDomain }}</div>
                </div>

                <div class="glass-panel px-8 py-5 rounded-2xl border border-purple-500/30 text-left">
                    <div class="text-[10px] font-black uppercase tracking-widest text-purple-300 mb-1 flex items-center gap-1.5">
                        <i class="fa-solid fa-chart-simple text-purple-400"></i>
                        <span class="text-purple-300">Alignment Score</span>
                    </div>
                    <div class="text-xl sm:text-2xl font-black text-white font-display">{{ $score }} / {{ $totalQuestions }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recommended Career Pathways --}}
    <div class="space-y-6">
        <div class="space-y-1">
            <div class="text-xs font-black uppercase tracking-widest text-purple-600 dark:text-purple-400 flex items-center gap-1.5">
                <i class="fa-solid fa-route"></i> Aligned Pathways
            </div>
            <h2 class="text-2xl font-black text-slate-900 dark:text-white font-display">Recommended Career Tracks For You</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($recommendedCareers as $career)
                <div class="bg-white/80 dark:bg-slate-900/50 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 rounded-3xl p-6 flex flex-col justify-between group relative overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] hover:-translate-y-1 hover:shadow-2xl transition-all duration-500 hover:border-purple-500/50">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between gap-2">
                            <span class="text-[11px] font-black uppercase px-3 py-1 rounded-full bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/20">
                                {{ $career->domain }}
                            </span>
                            <span class="text-xs font-black text-emerald-700 dark:text-emerald-400">
                                {{ $career->expected_salary }}
                            </span>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-300 transition-colors font-display">
                            {{ $career->title }}
                        </h3>
                        <p class="text-sm text-slate-700 dark:text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $career->description }}
                        </p>
                        <div class="p-3.5 rounded-2xl bg-slate-100/70 dark:bg-white/[0.05] border border-slate-200/80 dark:border-white/[0.05] text-xs text-slate-800 dark:text-slate-300">
                            <strong class="text-slate-600 dark:text-slate-400">Skills:</strong> {{ $career->required_skills }}
                        </div>
                    </div>
                    <div class="mt-5 pt-4 border-t border-slate-200/80 dark:border-white/10 flex items-center justify-between">
                        <a href="{{ route('careers.show', $career->id) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors group/link">
                            <span>Explore Pathway Details</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover/link:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-8 glass-panel rounded-3xl border border-slate-200/80 dark:border-white/10 text-slate-600 dark:text-slate-500">
                    Explore our career bank for more options.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Question Breakdown --}}
    <div class="bg-white/80 dark:bg-slate-900/50 backdrop-blur-2xl rounded-3xl p-7 sm:p-8 space-y-4 border border-slate-200/80 dark:border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        <h3 class="text-base font-black text-slate-900 dark:text-white flex items-center gap-2.5">
            <i class="fa-solid fa-list-check text-purple-600 dark:text-purple-400"></i>
            <span>Question-by-Question Alignment Breakdown</span>
        </h3>

        <div class="space-y-3">
            @foreach($details as $idx => $d)
                <div class="p-4 rounded-2xl {{ $d['is_correct'] ? 'bg-emerald-500/10 border border-emerald-500/30' : 'bg-slate-100/70 dark:bg-white/[0.02] border border-slate-200/80 dark:border-white/[0.06]' }} transition-all">
                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $idx + 1 }}. {{ $d['question'] }}</p>
                    <div class="text-xs mt-2 flex flex-wrap items-center gap-x-5 gap-y-1">
                        <span class="text-slate-700 dark:text-slate-400">Your answer: <strong class="text-slate-950 dark:text-slate-200">Option {{ $d['user_answer'] }}</strong></span>
                        <span class="text-slate-700 dark:text-slate-400">Key: <strong class="text-slate-950 dark:text-slate-200">Option {{ $d['correct_answer'] }}</strong></span>
                        <span class="font-bold {{ $d['is_correct'] ? 'text-emerald-700 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400' }}">
                            <i class="fa-solid {{ $d['is_correct'] ? 'fa-check' : 'fa-minus' }} text-xs mr-1"></i>
                            {{ $d['is_correct'] ? 'Aligned' : 'Preference Registered' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap justify-center gap-4 pt-2">
        <a href="{{ route('quiz.index') }}" class="px-7 py-3.5 glass-panel rounded-full text-sm font-bold text-slate-800 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-white border border-slate-200/80 dark:border-white/10 hover:border-purple-500/30 transition-all flex items-center gap-2 hover:scale-105">
            <i class="fa-solid fa-rotate-left text-xs"></i>
            <span>Retake Quiz</span>
        </a>
        <a href="{{ route('dashboard') }}" class="px-7 py-3.5 rounded-full font-black text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple hover:shadow-neon-pink transition-all flex items-center gap-2 hover:scale-105">
            <i class="fa-solid fa-gauge-high text-xs text-white"></i>
            <span class="text-white">Back to Dashboard</span>
        </a>
    </div>

</div>
@endsection