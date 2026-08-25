@extends('layouts.app')
@section('title', 'Career Interest & Psychological Alignment Quiz — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 space-y-8 md:space-y-10 my-6 md:my-8"
     x-data="{
         submitting: false,
         totalSeconds: 300,
         timeLeft: 300,
         timerRunning: true,
         timerInterval: null,
         answeredCount: 0,
         totalQuestions: {{ $questions->count() }},
         
         // Store selected option keys (e.g., 'A', 'B', 'C', 'D') for each question
         answers: {
             @foreach($questions as $q)
                 '{{ $q->id }}': '{{ array_key_first($q->options ?? ['A' => '']) }}',
             @endforeach
         },
         
         // Store slider index (0 to 3) for each question
         sliderValues: {
             @foreach($questions as $q)
                 '{{ $q->id }}': 0,
             @endforeach
         },

         init() {
             this.updateAnsweredCount();
             this.startTimer();
         },

         startTimer() {
             this.timerInterval = setInterval(() => {
                 if (this.timeLeft > 0) {
                     this.timeLeft--;
                 } else {
                     clearInterval(this.timerInterval);
                     // Time up: optional alert
                 }
             }, 1000);
         },

         get formattedTime() {
             const m = Math.floor(this.timeLeft / 60);
             const s = this.timeLeft % 60;
             return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
         },

         get progressPercent() {
             return Math.min(100, Math.round((this.answeredCount / this.totalQuestions) * 100));
         },

         get timerPercent() {
             return Math.round((this.timeLeft / this.totalSeconds) * 100);
         },

         updateAnsweredCount() {
             let count = 0;
             for (const qId in this.answers) {
                 if (this.answers[qId]) count++;
             }
             this.answeredCount = count;
         },

         setSliderChoice(qId, index, key) {
             this.sliderValues[qId] = index;
             this.answers[qId] = key;
             this.updateAnsweredCount();
         },

         handleSliderChange(qId, val, keysArray) {
             const index = parseInt(val);
             const key = keysArray[index] || keysArray[0];
             this.sliderValues[qId] = index;
             this.answers[qId] = key;
             this.updateAnsweredCount();
         }
     }">

    {{-- Quiz Header Banner with Live Telemetry --}}
    <div class="relative rounded-3xl p-8 sm:p-10 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden">
        {{-- Ambient Corner Glows --}}
        <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 dark:bg-purple-500/15 border border-purple-500/20 text-xs font-semibold text-purple-700 dark:text-purple-300 shadow-sm">
                    <i class="fa-solid fa-brain text-purple-600 dark:text-purple-400"></i>
                    <span>Cognitive Affinity &amp; Likert-Scale Assessment</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display">
                    Career Interest <span class="grad-text">&amp; Psychological</span> Alignment
                </h1>
                <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm leading-relaxed">
                    Evaluate your technical intuition, architectural problem solving, and work preference using interactive sliders and continuous Likert scaling.
                </p>
            </div>

            {{-- 1. VISUAL COUNTDOWN TIMER WIDGET --}}
            <div class="p-5 rounded-2xl bg-slate-100/90 dark:bg-slate-950/60 border border-slate-200/80 dark:border-white/10 text-center shrink-0 space-y-2 shadow-sm min-w-[190px]">
                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 flex items-center justify-center gap-1.5 font-mono">
                    <i class="fa-regular fa-stopwatch text-purple-500" :class="timeLeft < 60 ? 'text-rose-500 animate-pulse' : ''"></i>
                    <span>Assessment Timer</span>
                </div>
                <div class="text-3xl font-black font-mono tracking-wider transition-colors"
                     :class="timeLeft < 60 ? 'text-rose-500 animate-pulse' : (timeLeft < 120 ? 'text-amber-500' : 'text-slate-900 dark:text-white')"
                     x-text="formattedTime">
                    05:00
                </div>
                {{-- Horizontal Countdown Progress Track --}}
                <div class="w-full bg-slate-200 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000"
                         :class="timeLeft < 60 ? 'bg-rose-500' : (timeLeft < 120 ? 'bg-amber-500' : 'bg-gradient-to-r from-indigo-500 to-purple-500')"
                         :style="'width: ' + timerPercent + '%'"></div>
                </div>
                <div class="text-[10px] text-slate-400 font-mono">
                    Recommended: 5 mins
                </div>
            </div>
        </div>

        {{-- Assessment Overall Progress Bar --}}
        <div class="mt-6 pt-4 border-t border-slate-200/60 dark:border-white/[0.06] relative z-10 space-y-2">
            <div class="flex items-center justify-between text-xs font-mono text-slate-600 dark:text-slate-400">
                <span class="flex items-center gap-1.5 font-bold text-slate-900 dark:text-white">
                    <i class="fa-solid fa-list-check text-purple-500"></i> Progress: <span x-text="answeredCount"></span> of <span x-text="totalQuestions"></span> Evaluated
                </span>
                <span class="font-bold text-purple-600 dark:text-purple-400" x-text="progressPercent + '% Completed'"></span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-800/80 h-2 rounded-full overflow-hidden shadow-inner">
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 h-full rounded-full transition-all duration-300 shadow-neon-purple"
                     :style="'width: ' + progressPercent + '%'"></div>
            </div>
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
        <form action="{{ route('quiz.submit') }}" method="POST" class="space-y-6 w-full" @submit="submitting = true">
            @csrf
            <input type="hidden" name="idempotency_token" value="{{ $idempotencyToken }}">
            
            @foreach($questions as $index => $question)
                @php
                    $keys = array_keys($question->options ?? []);
                    $keysJson = json_encode($keys);
                    $likertLabels = [
                        0 => ['tag' => 'Strong Disagreement', 'color' => 'from-rose-500/20 to-rose-500/5 text-rose-700 dark:text-rose-400 border-rose-500/30'],
                        1 => ['tag' => 'Moderate Alignment', 'color' => 'from-amber-500/20 to-amber-500/5 text-amber-700 dark:text-amber-400 border-amber-500/30'],
                        2 => ['tag' => 'High Preference', 'color' => 'from-indigo-500/20 to-indigo-500/5 text-indigo-700 dark:text-indigo-400 border-indigo-500/30'],
                        3 => ['tag' => 'Core Specialization', 'color' => 'from-purple-500/20 to-pink-500/5 text-purple-700 dark:text-purple-300 border-purple-500/30'],
                    ];
                @endphp

                <div class="bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl rounded-3xl p-6 sm:p-8 space-y-6 border border-slate-200/80 dark:border-white/10 hover:border-purple-500/40 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] transition-all duration-300">
                    
                    {{-- Question Header --}}
                    <div class="flex items-start justify-between gap-4 border-b border-slate-100 dark:border-white/5 pb-4">
                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 text-white font-black text-xs flex items-center justify-center shrink-0 shadow-md">
                                Q{{ $index + 1 }}
                            </div>
                            <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white pt-1 leading-snug font-display">
                                {{ $question->question_text }}
                            </h3>
                        </div>

                        {{-- Active Selected Option Indicator --}}
                        <div class="shrink-0">
                            <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25 shadow-xs">
                                Choice <span x-text="answers['{{ $question->id }}']"></span>
                            </span>
                        </div>
                    </div>

                    {{-- 2. INTERACTIVE RANGE SLIDER UI --}}
                    <div class="space-y-3 px-2">
                        <div class="flex items-center justify-between text-xs font-mono text-slate-500 dark:text-slate-400">
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-sliders text-indigo-500"></i> Interactive Alignment Slider</span>
                            <span class="text-[11px]">Level: <strong class="text-purple-600 dark:text-purple-400 font-bold" x-text="parseInt(sliderValues['{{ $question->id }}']) + 1 + '/4'"></strong></span>
                        </div>
                        
                        <div class="relative py-1">
                            <input type="range" 
                                   min="0" 
                                   max="{{ count($keys) - 1 }}" 
                                   step="1"
                                   :value="sliderValues['{{ $question->id }}']"
                                   @input="handleSliderChange('{{ $question->id }}', $event.target.value, {{ $keysJson }})"
                                   class="w-full h-2.5 bg-slate-200 dark:bg-slate-800 rounded-lg appearance-none cursor-pointer accent-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500/40">
                            
                            {{-- Step points under the slider --}}
                            <div class="flex justify-between items-center text-[10px] font-mono text-slate-400 px-1 pt-1.5">
                                @foreach($keys as $kIndex => $key)
                                    <button type="button" 
                                            @click="setSliderChoice('{{ $question->id }}', {{ $kIndex }}, '{{ $key }}')"
                                            class="hover:text-purple-600 transition-colors font-bold"
                                            :class="sliderValues['{{ $question->id }}'] == {{ $kIndex }} ? 'text-purple-600 dark:text-purple-400 font-black' : ''">
                                        {{ $key }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- 2. LIKERT-SCALE OPTION CARDS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 pt-1">
                        @php $optIndex = 0; @endphp
                        @foreach($question->options as $key => $option)
                            @php
                                $likert = $likertLabels[$optIndex % 4];
                            @endphp
                            <div @click="setSliderChoice('{{ $question->id }}', {{ $optIndex }}, '{{ $key }}')"
                                 :class="answers['{{ $question->id }}'] === '{{ $key }}' 
                                    ? 'bg-gradient-to-r from-purple-500/15 via-indigo-500/10 to-transparent border-purple-500 ring-2 ring-purple-500/30 shadow-lg -translate-y-0.5' 
                                    : 'bg-slate-100/70 dark:bg-white/[0.02] border-slate-200/80 dark:border-white/[0.06] hover:border-purple-500/30 hover:bg-slate-100 dark:hover:bg-white/[0.04]'"
                                 class="p-4 rounded-2xl border cursor-pointer transition-all duration-200 flex items-start gap-3.5 relative group">
                                
                                {{-- Radio Selection Indicator --}}
                                <div class="mt-0.5 w-5 h-5 rounded-full border flex items-center justify-center shrink-0 transition-all"
                                     :class="answers['{{ $question->id }}'] === '{{ $key }}' ? 'border-purple-600 bg-purple-600 text-white' : 'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800'">
                                    <i class="fa-solid fa-check text-[10px]" x-show="answers['{{ $question->id }}'] === '{{ $key }}'"></i>
                                </div>

                                <div class="space-y-1.5 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-black uppercase font-mono"
                                              :class="answers['{{ $question->id }}'] === '{{ $key }}' ? 'text-purple-700 dark:text-purple-300' : 'text-slate-500 dark:text-slate-400'">
                                            Option {{ $key }}
                                        </span>
                                        <span class="text-[9px] font-mono px-2 py-0.5 rounded-full border {{ $likert['color'] }}">
                                            {{ $likert['tag'] }}
                                        </span>
                                    </div>
                                    <p class="text-xs sm:text-sm text-slate-800 dark:text-slate-300 group-hover:text-slate-950 dark:group-hover:text-slate-100 transition-colors leading-relaxed">
                                        {{ $option }}
                                    </p>
                                </div>
                            </div>
                            @php $optIndex++; @endphp
                        @endforeach
                    </div>

                    {{-- Bound hidden input to ensure flawless HTML POST form validation --}}
                    <input type="hidden" 
                           name="answers[{{ $question->id }}]" 
                           :value="answers['{{ $question->id }}']" 
                           required>
                </div>
            @endforeach

            {{-- Submit Action Console --}}
            <div class="p-8 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl text-center space-y-4">
                <div class="text-xs text-slate-500 dark:text-slate-400">
                    Clicking submit processes your weighted scores and computes real-time career alignment models.
                </div>
                <div>
                    <button type="submit" 
                            :disabled="submitting"
                            class="group inline-flex items-center gap-3 px-10 py-4 text-sm font-black text-white rounded-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple hover:shadow-neon-pink transition-all duration-300 hover:scale-105 disabled:opacity-75 disabled:cursor-not-allowed cursor-pointer">
                        <template x-if="!submitting">
                            <span class="inline-flex items-center gap-3">
                                <i class="fa-solid fa-calculator text-base text-white"></i>
                                <span class="text-white font-black">Submit &amp; Calculate Alignment</span>
                                <i class="fa-solid fa-arrow-right text-xs text-white group-hover:translate-x-1.5 transition-transform"></i>
                            </span>
                        </template>
                        <template x-if="submitting">
                            <span class="inline-flex items-center gap-3">
                                <i class="fa-solid fa-circle-notch fa-spin text-base text-white"></i>
                                <span class="text-white font-black">Evaluating Psychometrics...</span>
                            </span>
                        </template>
                    </button>
                </div>
            </div>
        </form>
    @endif

</div>
@endsection