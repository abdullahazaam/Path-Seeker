@extends('layouts.app')
@section('title', 'Career Interest Quiz — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8">

    {{-- Quiz Header Banner --}}
    <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 text-center space-y-4 max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/20 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                <i class="fa-solid fa-brain text-purple-600 dark:text-purple-400"></i>
                <span>Domain Alignment &amp; Interest Assessment</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white font-display">
                Career Interest <span class="grad-text">&amp; Alignment</span> Quiz
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                Answer the following questions to evaluate your problem-solving style, tooling preferences, and uncover your ideal career trajectory.
            </p>
        </div>
    </div>

    @if($questions->isEmpty())
        <div class="bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl rounded-3xl p-12 text-center space-y-3 border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
            <div class="w-14 h-14 rounded-2xl bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl mx-auto mb-2">
                <i class="fa-solid fa-clipboard-question"></i>
            </div>
            <p class="text-base font-bold text-slate-900 dark:text-slate-300">No assessment questions found in database.</p>
        </div>
    @else
        <form action="{{ route('quiz.submit') }}" method="POST" class="space-y-6 max-w-7xl mx-auto w-full">
            @csrf
            @foreach($questions as $index => $question)
                <div class="bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl rounded-3xl p-6 sm:p-8 space-y-5 border border-slate-200/80 dark:border-white/10 hover:border-purple-500/40 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-neon-purple">
                            {{ $index + 1 }}
                        </div>
                        <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white pt-1.5 leading-snug font-display">
                            {{ $question->question_text }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-1">
                        @foreach($question->options as $key => $option)
                            <label class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-100/70 dark:bg-white/[0.03] hover:bg-purple-500/[0.08] border border-slate-200/80 dark:border-white/[0.06] hover:border-purple-500/30 cursor-pointer transition-all duration-200 group">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" required
                                       class="mt-1 shrink-0 w-4 h-4 text-purple-600 bg-slate-900 border-slate-700 focus:ring-purple-500 focus:ring-offset-slate-950">
                                <span class="text-sm text-slate-800 dark:text-slate-300 group-hover:text-slate-950 dark:group-hover:text-slate-100 transition-colors leading-relaxed">
                                    <strong class="text-purple-700 dark:text-purple-400 group-hover:text-purple-800 dark:group-hover:text-purple-300 mr-1 font-bold">{{ $key }}.</strong>{{ $option }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="text-center pt-4">
                <button type="submit" class="group inline-flex items-center gap-3 px-10 py-4 text-sm font-black text-white rounded-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple hover:shadow-neon-pink transition-all duration-300 hover:scale-105">
                    <i class="fa-solid fa-calculator text-base text-white"></i>
                    <span class="text-white font-black">Submit &amp; Calculate Alignment</span>
                    <i class="fa-solid fa-arrow-right text-xs text-white group-hover:translate-x-1.5 transition-transform"></i>
                </button>
            </div>
        </form>
    @endif

</div>
@endsection