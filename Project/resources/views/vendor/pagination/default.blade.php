@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="glass-panel rounded-2xl p-4 border border-slate-200/80 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
        <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                <strong class="text-slate-900 dark:text-white">{{ $paginator->firstItem() }}</strong>
                {!! __('to') !!}
                <strong class="text-slate-900 dark:text-white">{{ $paginator->lastItem() }}</strong>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            <strong class="text-slate-900 dark:text-white">{{ $paginator->total() }}</strong>
            {{ isset($itemName) ? $itemName : 'Results' }}
        </p>

        <div class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/40 dark:bg-slate-800/40 text-slate-400 dark:text-slate-600 border border-slate-200/40 dark:border-slate-700/30 cursor-not-allowed select-none flex items-center gap-1.5">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                    <span>Previous</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 transition-all flex items-center gap-1.5 hover:scale-105">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                    <span>Previous</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="hidden sm:flex items-center gap-1.5">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-3 py-2 text-sm font-bold text-slate-400 dark:text-slate-600">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3.5 py-2 text-sm font-bold rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-lg shadow-purple-500/25 border border-purple-400/30 flex items-center justify-center min-w-[38px]">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-3.5 py-2 text-sm font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 transition-all flex items-center justify-center min-w-[38px] hover:scale-105">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/80 dark:bg-slate-800/80 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 transition-all flex items-center gap-1.5 hover:scale-105">
                    <span>Next</span>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </a>
            @else
                <span class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-100/40 dark:bg-slate-800/40 text-slate-400 dark:text-slate-600 border border-slate-200/40 dark:border-slate-700/30 cursor-not-allowed select-none flex items-center gap-1.5">
                    <span>Next</span>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
