@extends('layouts.app')
@section('title', 'Quiz Results — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">

    {{-- Result Hero Card --}}
    <div class="relative rounded-3xl p-8 sm:p-12 text-center space-y-6 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 overflow-hidden shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
        
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-4">
            <div class="flex flex-wrap items-center justify-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-500/25 text-xs font-black uppercase tracking-wider text-emerald-700 dark:text-emerald-300 shadow-sm font-mono">
                    <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400"></i>
                    <span>Assessment Completed</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-500/15 border border-purple-500/25 text-xs font-bold text-purple-700 dark:text-purple-300 font-mono">
                    <i class="fa-solid fa-code-branch text-[10px]"></i>
                    <span>Version {{ $attempt->quiz_version ?? '2026.v1' }}</span>
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white font-display tracking-tight">
                Your Career Alignment <span class="grad-text">Profile</span>
            </h1>

            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base max-w-xl mx-auto leading-relaxed font-normal">
                Deterministic evaluation computed across technical disciplines, preferred workflows, and high-growth industry skill matrices.
            </p>

            {{-- Stat Callouts --}}
            <div class="flex flex-wrap justify-center gap-4 sm:gap-5 pt-4">
                <div class="bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 px-8 py-5 rounded-2xl text-left shadow-sm min-w-[200px]">
                    <div class="text-[10px] font-black uppercase tracking-wider text-indigo-600 dark:text-indigo-400 mb-1 flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-bullseye text-indigo-500"></i>
                        <span>Primary Aligned Domain</span>
                    </div>
                    <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display">{{ $recommendedDomain }}</div>
                </div>

                <div class="bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 px-8 py-5 rounded-2xl text-left shadow-sm min-w-[200px]">
                    <div class="text-[10px] font-black uppercase tracking-wider text-purple-600 dark:text-purple-400 mb-1 flex items-center gap-1.5 font-mono">
                        <i class="fa-solid fa-chart-simple text-purple-500"></i>
                        <span>Total Weighted Points</span>
                    </div>
                    <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display">{{ $score }} Pts</div>
                </div>
            </div>

            {{-- Domain Breakdown Progress Bars --}}
            @if(!empty($domainCounts))
                <div class="pt-6 max-w-2xl mx-auto text-left space-y-3">
                    <div class="text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400 font-mono flex items-center gap-2">
                        <i class="fa-solid fa-chart-pie text-indigo-400"></i>
                        <span>Domain Affinity Distribution</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($domainCounts as $domain => $pct)
                            <div class="p-3.5 rounded-2xl bg-slate-100/80 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/5 space-y-1.5">
                                <div class="flex justify-between items-center text-xs font-bold">
                                    <span class="text-slate-800 dark:text-slate-200 truncate">{{ $domain }}</span>
                                    <span class="font-mono text-indigo-600 dark:text-indigo-400">{{ $pct }}%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Recommended Career Pathways with Explainability --}}
    <div class="space-y-6">
        <div class="space-y-1">
            <div class="text-xs font-black uppercase tracking-wider text-purple-600 dark:text-purple-400 flex items-center gap-1.5 font-mono">
                <i class="fa-solid fa-route"></i>
                <span>Explainable Recommendations</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">Top Aligned Tech Career Tracks</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($recommendedCareers as $career)
                <div class="bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 flex flex-col justify-between group relative overflow-hidden shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 hover:border-purple-500/40">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between gap-2 flex-wrap">
                            <span class="text-[11px] font-black uppercase px-3 py-1 rounded-full bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/20 font-mono shadow-sm">
                                {{ $career['domain'] ?? 'Technology' }}
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs font-black px-2.5 py-1 rounded-full bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25 font-mono">
                                <i class="fa-solid fa-bolt text-[10px]"></i>
                                <span>{{ $career['match_percentage'] ?? 90 }}% Match</span>
                            </span>
                        </div>

                        <div>
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors font-display">
                                {{ $career['title'] }}
                            </h3>
                            <div class="text-xs font-mono font-bold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                {{ $career['expected_salary'] ?? 'Competitive Tech Benchmark' }}
                            </div>
                        </div>

                        {{-- Explainable Reasoning Callout --}}
                        @if(!empty($career['reason']))
                            <div class="p-3.5 rounded-2xl bg-indigo-500/10 dark:bg-indigo-500/10 border border-indigo-500/20 text-xs text-indigo-900 dark:text-indigo-200 leading-relaxed">
                                <strong class="font-bold flex items-center gap-1.5 text-indigo-700 dark:text-indigo-300 mb-1">
                                    <i class="fa-solid fa-wand-magic-sparkles text-[11px]"></i> Why this matched:
                                </strong>
                                <span>{{ $career['reason'] }}</span>
                            </div>
                        @endif

                        @if(!empty($career['required_skills']))
                            <div class="p-3 rounded-xl bg-slate-100/80 dark:bg-slate-950/50 border border-slate-200/80 dark:border-white/10 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <strong class="text-slate-900 dark:text-white font-bold"><i class="fa-solid fa-code text-indigo-500 mr-1.5"></i>Target Skills:</strong> {{ $career['required_skills'] }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-5 pt-4 border-t border-slate-200/80 dark:border-white/10 flex items-center justify-between">
                        <a href="{{ route('careers.show', $career['career_id'] ?? $career['id']) }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors group/link">
                            <span>Explore Pathway &amp; Milestones</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover/link:translate-x-1.5 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-10 rounded-3xl bg-white/90 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 text-slate-500 dark:text-slate-400 text-sm">
                    Explore our career bank for more options.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Question-by-Question Response Audit --}}
    @if(isset($details) && count($details) > 0)
        <div class="bg-white dark:bg-[#080B12] rounded-3xl p-7 sm:p-8 space-y-5 border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
            <div class="flex items-center justify-between border-b border-slate-200/80 dark:border-white/10 pb-4">
                <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white flex items-center gap-2.5 font-display">
                    <i class="fa-solid fa-list-check text-purple-600 dark:text-purple-400"></i>
                    <span>Question Evaluation Audit</span>
                </h3>
                <span class="text-xs font-mono text-slate-400">{{ count($details) }} Questions Evaluated</span>
            </div>

            <div class="space-y-3">
                @foreach($details as $idx => $d)
                    <div class="p-4 rounded-2xl bg-slate-100/80 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/10 transition-all space-y-2">
                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">{{ $idx + 1 }}. {{ $d->question_text ?? $d['question'] }}</p>
                        <div class="text-xs flex flex-wrap items-center justify-between gap-2 text-slate-600 dark:text-slate-400">
                            <div>
                                Selected: <strong class="text-slate-900 dark:text-slate-200">[{{ $d->selected_option ?? $d['user_answer'] }}] {{ $d->selected_option_text ?? '' }}</strong>
                            </div>
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 border border-indigo-500/20 font-mono text-[10px] font-bold">
                                <span>Domain Awarded: {{ $d->domain_awarded ?? 'Software Engineering' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Actions --}}
    <div class="flex flex-wrap justify-center gap-4 pt-2">
        <a href="{{ route('quiz.index') }}" class="btn-secondary px-7 py-3.5 rounded-full text-xs sm:text-sm font-bold transition-all flex items-center gap-2 hover:scale-105 cursor-pointer">
            <i class="fa-solid fa-rotate-left text-xs"></i>
            <span>Retake Assessment</span>
        </a>
        <a href="{{ route('dashboard') }}" class="btn-sweep px-8 py-3.5 rounded-full font-black text-xs sm:text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-md hover:shadow-md transition-all flex items-center gap-2 hover:scale-105 cursor-pointer">
            <i class="fa-solid fa-gauge-high text-xs text-white"></i>
            <span class="text-white font-black">Back to Dashboard</span>
            <i class="fa-solid fa-arrow-right text-xs text-white"></i>
        </a>
    </div>

</div>
@endsection