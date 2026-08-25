@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 relative overflow-hidden">
        {{-- Ambient decorative glow --}}
        <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-2xl pointer-events-none"></div>

        <p class="relative z-10 text-xs text-slate-600 dark:text-slate-400 font-medium">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                <strong class="text-slate-900 dark:text-white font-bold">{{ $paginator->firstItem() }}</strong>
                {!! __('to') !!}
                <strong class="text-slate-900 dark:text-white font-bold">{{ $paginator->lastItem() }}</strong>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            <strong class="text-slate-900 dark:text-white font-bold">{{ $paginator->total() }}</strong>
            {{ isset($itemName) ? $itemName : 'Results' }}
        </p>

        <div class="relative z-10 flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100/50 dark:bg-white/[0.02] text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-white/5 cursor-not-allowed select-none flex items-center gap-1.5">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Previous</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100 dark:bg-white/[0.04] hover:bg-slate-200 dark:hover:bg-white/[0.08] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-all flex items-center gap-1.5 hover:scale-105 shadow-xs">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Previous</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="hidden sm:flex items-center gap-1.5">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-3 py-2 text-xs font-bold text-slate-400 dark:text-slate-600">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-4 py-2.5 text-xs font-black rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white shadow-lg shadow-purple-500/25 border border-purple-400/30 flex items-center justify-center min-w-[40px]">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100 dark:bg-white/[0.04] hover:bg-slate-200 dark:hover:bg-white/[0.08] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-all flex items-center justify-center min-w-[40px] hover:scale-105 shadow-xs">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100 dark:bg-white/[0.04] hover:bg-slate-200 dark:hover:bg-white/[0.08] text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-all flex items-center gap-1.5 hover:scale-105 shadow-xs">
                    <span>Next</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            @else
                <span class="px-4 py-2.5 text-xs font-bold rounded-2xl bg-slate-100/50 dark:bg-white/[0.02] text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-white/5 cursor-not-allowed select-none flex items-center gap-1.5">
                    <span>Next</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
