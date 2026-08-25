@php
    $type = null;
    $message = null;
    $icon = null;
    $borderColor = null;
    $accentColor = null;

    if (session()->has('success')) {
        $type = 'success';
        $message = session('success');
        $icon = 'fa-solid fa-circle-check text-emerald-500';
        $borderColor = 'border-l-4 border-l-emerald-500 border-slate-200 dark:border-slate-800';
        $accentColor = 'text-emerald-600 dark:text-emerald-400';
    } elseif (session()->has('error')) {
        $type = 'error';
        $message = session('error');
        $icon = 'fa-solid fa-circle-exclamation text-rose-500';
        $borderColor = 'border-l-4 border-l-rose-500 border-slate-200 dark:border-slate-800';
        $accentColor = 'text-rose-600 dark:text-rose-400';
    } elseif (session()->has('warning')) {
        $type = 'warning';
        $message = session('warning');
        $icon = 'fa-solid fa-triangle-exclamation text-amber-500';
        $borderColor = 'border-l-4 border-l-amber-500 border-slate-200 dark:border-slate-800';
        $accentColor = 'text-amber-600 dark:text-amber-400';
    } elseif (session()->has('status')) {
        $type = 'info';
        $message = session('status');
        $icon = 'fa-solid fa-circle-info text-sky-500';
        $borderColor = 'border-l-4 border-l-sky-500 border-slate-200 dark:border-slate-800';
        $accentColor = 'text-sky-600 dark:text-sky-400';
    } elseif (session()->has('info')) {
        $type = 'info';
        $message = session('info');
        $icon = 'fa-solid fa-circle-info text-sky-500';
        $borderColor = 'border-l-4 border-l-sky-500 border-slate-200 dark:border-slate-800';
        $accentColor = 'text-sky-600 dark:text-sky-400';
    }
@endphp

@if ($message)
    <div class="relative z-40 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-3">
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 -translate-y-2 scale-98"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-2 scale-98"
             class="bg-white/90 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 border {{ $borderColor }} shadow-2xl  rounded-2xl p-4 flex items-center justify-between gap-4 transition-all">
            
            <div class="flex items-center gap-3.5 flex-grow">
                <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200/80 dark:border-white/10 flex items-center justify-center shrink-0 shadow-sm">
                    <i class="{{ $icon }} text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs uppercase font-black tracking-wider {{ $accentColor }}">
                        {{ ucfirst($type) }}
                    </span>
                    <span class="text-sm font-semibold text-slate-900 dark:text-white leading-snug">
                        {{ $message }}
                    </span>
                </div>
            </div>

            {{-- Close Button --}}
            <button @click="show = false" 
                    type="button" 
                    class="w-8 h-8 rounded-xl bg-slate-100/80 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-400 hover:text-slate-700 dark:hover:text-white border border-slate-200/60 dark:border-white/10 flex items-center justify-center shrink-0 transition-colors cursor-pointer"
                    aria-label="Dismiss Notification">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    </div>
@endif
